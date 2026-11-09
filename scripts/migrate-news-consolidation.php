<?php
declare(strict_types=1);

$path = $argv[1] ?? '';
$mode = $argv[2] ?? '';
if (PHP_SAPI !== 'cli' || !is_file($path) || !in_array($mode, ['--check', '--apply'], true)) {
    fwrite(STDERR, "Usage: php scripts/migrate-news-consolidation.php /path/to/site.sqlite --check|--apply\n");
    exit(2);
}
if (!class_exists(DOMDocument::class)) {
    fwrite(STDERR, "PHP CLI requires the DOM extension to verify the original article text.\n");
    exit(2);
}

function publishedTextHash(string $content): string
{
    // Match the public article template's entity decoding before extracting text.
    $dom = new DOMDocument();
    $dom->loadHTML('<?xml encoding="UTF-8"><div id="news-body">'
        . html_entity_decode($content) . '</div>', LIBXML_NONET | LIBXML_NOERROR | LIBXML_NOWARNING);
    $body = $dom->getElementById('news-body');
    return hash('sha256', trim(preg_replace('/\s+/u', ' ', $body ? $body->textContent : '') ?? ''));
}

$groups = require __DIR__ . '/../database/migrations/005_news_consolidation.php';
$db = new PDO('sqlite:' . $path, null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
$db->exec('PRAGMA busy_timeout = 5000');
$db->exec($mode === '--apply' ? 'BEGIN IMMEDIATE' : 'BEGIN');

try {
    $find = $db->prepare('SELECT id, title, status, delete_time, content, link, target FROM zw_cms_article WHERE id = ?');
    $ready = [];
    $redirects = [];
    foreach ($groups as $mainId => $group) {
        $destination = '/detail/news' . $mainId . '.html';
        $rows = [];
        $alreadyMerged = true;
        foreach ($group['sources'] as $id => $hash) {
            $find->execute([$id]);
            $row = $find->fetch();
            if (!$row || $row['delete_time'] !== null) {
                throw new RuntimeException("Article #{$id} is missing or deleted; no changes made.");
            }
            $rows[$id] = $row;
            if ($id !== $mainId) {
                $redirects['/detail/news' . $id . '.html'] = $destination;
                $alreadyMerged = $alreadyMerged && (int) $row['status'] === 0
                    && $row['target'] === 'merged_article' && $row['link'] === $destination;
            }
        }
        if ($alreadyMerged && (int) $rows[$mainId]['status'] === 1 && $rows[$mainId]['target'] !== 'merged_article') {
            echo "#{$mainId}: already applied.\n";
            continue;
        }
        foreach ($group['sources'] as $id => $hash) {
            $row = $rows[$id];
            if ((int) $row['status'] !== 1 || $row['target'] === 'merged_article'
                || !hash_equals($hash, publishedTextHash((string) $row['content']))) {
                throw new RuntimeException("Article #{$id} differs from the reviewed publication; no changes made.");
            }
        }
        $ready[$mainId] = $group;
        echo "#{$mainId}: ready (" . (count($group['sources']) - 1) . " old URLs).\n";
    }

    if ($mode === '--apply' && $ready) {
        $publish = $db->prepare('UPDATE zw_cms_article SET title = ?, seo_title = ?, sketch = ?, seo_content = ?, content = ?, update_time = ? WHERE id = ?');
        $archive = $db->prepare("UPDATE zw_cms_article SET status = 0, link = ?, target = 'merged_article' WHERE id = ?");
        $now = time();
        foreach ($ready as $mainId => $group) {
            $publish->execute([$group['title'], $group['title'], $group['summary'], $group['summary'], $group['body'], $now, $mainId]);
            foreach (array_keys($group['sources']) as $id) {
                if ($id !== $mainId) $archive->execute(['/detail/news' . $mainId . '.html', $id]);
            }
        }

        // Existing dynamic lists already omit unpublished rows. Update direct article links if present.
        $update = $db->prepare('UPDATE zw_cms_article SET content = ?, link = ? WHERE id = ?');
        $pages = $db->query("SELECT id, content, link FROM zw_cms_article WHERE status = 1 AND delete_time IS NULL AND (content LIKE '%/detail/news%' OR link LIKE '%/detail/news%')")->fetchAll();
        foreach ($pages as $row) {
            $content = (string) $row['content'];
            $changed = preg_replace_callback(
                '~(\bhref\s*=\s*)(["\x27])(?:https?://(?:www\.)?zrbanjia\.com)?(/detail/news\d+\.html)([?#][^"\x27]*)?\2~i',
                static function (array $m) use ($redirects): string {
                    return isset($redirects[$m[3]])
                        ? $m[1] . $m[2] . $redirects[$m[3]] . ($m[4] ?? '') . $m[2] : $m[0];
                },
                $content
            );
            $link = $row['link'];
            $path = preg_replace('~^https?://(?:www\.)?zrbanjia\.com~i', '', (string) $link);
            $newLink = $redirects[$path] ?? $link;
            if ($changed !== null && ($changed !== $content || $link !== $newLink)) {
                $update->execute([$changed, $newLink, $row['id']]);
            }
        }
        $db->exec('COMMIT');
        echo 'Applied ' . count($ready) . " groups. Source bodies remain in the database.\n";
    } else {
        $db->exec('ROLLBACK');
        echo "No database writes.\n";
    }
} catch (Throwable $error) {
    $db->exec('ROLLBACK');
    fwrite(STDERR, $error->getMessage() . "\n");
    exit(1);
}
