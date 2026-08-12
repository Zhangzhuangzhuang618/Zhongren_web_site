<?php
declare(strict_types=1);

date_default_timezone_set('Asia/Shanghai');

/**
 * Import public content from https://www.zrbanjia.com into the local SQLite DB.
 *
 * Usage:
 *   php scripts/import_zrbanjia_content.php
 *   php scripts/import_zrbanjia_content.php --dry-run --max-items=3
 */

$projectRoot = dirname(__DIR__);
$baseUrl = 'https://www.zrbanjia.com';
$dbPath = $projectRoot . '/data/demo.sqlite';
$exportDir = $projectRoot . '/migration_exports';
$dryRun = in_array('--dry-run', $argv, true);
$maxItems = 0;
foreach ($argv as $argument) {
    if (strpos($argument, '--max-items=') === 0) {
        $maxItems = max(0, (int) substr($argument, strlen('--max-items=')));
    }
}

if (!is_file($dbPath)) {
    fwrite(STDERR, "Database not found: {$dbPath}\n");
    exit(1);
}

if (!is_dir($exportDir) && !mkdir($exportDir, 0775, true) && !is_dir($exportDir)) {
    fwrite(STDERR, "Cannot create export directory: {$exportDir}\n");
    exit(1);
}

$runId = date('Ymd-His');
$jsonLogPath = $exportDir . "/zrbanjia-content-import-{$runId}.json";
$textLogPath = $exportDir . "/zrbanjia-content-import-{$runId}.log";
$requestCount = 0;
$failures = [];
$mediaLog = [];
$recordLog = [];

function fetchUrl(string $url, bool $binary = false): array
{
    global $requestCount;
    $requestCount++;
    $attempt = 0;
    $lastError = '';
    while ($attempt < 3) {
        $attempt++;
        $handle = curl_init($url);
        curl_setopt_array($handle, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_ENCODING => '',
            CURLOPT_USERAGENT => 'Mozilla/5.0 (compatible; ZhongrenMigration/1.0)',
            CURLOPT_HTTPHEADER => ['Accept: ' . ($binary ? '*/*' : 'text/html,application/xhtml+xml')],
        ]);
        $body = curl_exec($handle);
        $status = (int) curl_getinfo($handle, CURLINFO_HTTP_CODE);
        $contentType = (string) curl_getinfo($handle, CURLINFO_CONTENT_TYPE);
        $lastError = curl_error($handle);
        curl_close($handle);
        if ($body !== false && $status >= 200 && $status < 300) {
            return ['ok' => true, 'body' => $body, 'status' => $status, 'content_type' => $contentType];
        }
        usleep(250000 * $attempt);
    }
    return ['ok' => false, 'body' => '', 'status' => $status ?? 0, 'error' => $lastError];
}

function loadHtml(string $html): array
{
    $document = new DOMDocument('1.0', 'UTF-8');
    $previous = libxml_use_internal_errors(true);
    $document->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_NOWARNING | LIBXML_NOERROR);
    libxml_clear_errors();
    libxml_use_internal_errors($previous);
    return [$document, new DOMXPath($document)];
}

function classQuery(string $class): string
{
    return 'contains(concat(" ", normalize-space(@class), " "), " ' . $class . ' ")';
}

function nodeText(?DOMNode $node): string
{
    if (!$node) {
        return '';
    }
    return trim((string) preg_replace('/\s+/u', ' ', $node->textContent));
}

function firstNode(DOMXPath $xpath, string $query, ?DOMNode $context = null): ?DOMNode
{
    $nodes = $xpath->query($query, $context);
    return ($nodes && $nodes->length > 0) ? $nodes->item(0) : null;
}

function innerHtml(?DOMNode $node): string
{
    if (!$node || !$node->ownerDocument) {
        return '';
    }
    $html = '';
    foreach ($node->childNodes as $child) {
        $html .= $node->ownerDocument->saveHTML($child);
    }
    return trim($html);
}

function metaContent(DOMXPath $xpath, string $name): string
{
    $node = firstNode($xpath, '//meta[translate(@name,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz")="' . strtolower($name) . '"]');
    return $node instanceof DOMElement ? trim($node->getAttribute('content')) : '';
}

function timestampFromText(string $text, int $fallback): int
{
    if (preg_match('/(20\d{2}-\d{2}-\d{2}(?:\s+\d{2}:\d{2}:\d{2})?)/', $text, $matches)) {
        $timestamp = strtotime($matches[1]);
        if ($timestamp !== false) {
            return $timestamp;
        }
    }
    return $fallback;
}

function discoverRecords(string $kind, int $navId, string $listPath, string $detailPattern, int $maxPages): array
{
    global $baseUrl, $failures;
    $records = [];
    $previousIds = '';
    for ($page = 1; $page <= $maxPages; $page++) {
        $url = $baseUrl . $listPath . ($page > 1 ? '?page=' . $page : '');
        $response = fetchUrl($url);
        if (!$response['ok']) {
            $failures[] = ['stage' => 'list', 'kind' => $kind, 'url' => $url, 'status' => $response['status'], 'error' => $response['error'] ?? ''];
            break;
        }
        list($document, $xpath) = loadHtml($response['body']);
        $entryQuery = $kind === 'product'
            ? '//div[' . classQuery('slide-box') . ']'
            : '//div[' . classQuery('news-list') . ']';
        $entries = $xpath->query($entryQuery);
        $pageIds = [];
        if (!$entries) {
            break;
        }
        foreach ($entries as $entry) {
            $link = null;
            foreach ($xpath->query('.//a[@href]', $entry) as $candidate) {
                $href = $candidate instanceof DOMElement ? $candidate->getAttribute('href') : '';
                if (preg_match($detailPattern, $href, $matches)) {
                    $link = $candidate;
                    $id = (int) $matches[1];
                    break;
                }
            }
            if (!$link || empty($id)) {
                continue;
            }
            $pageIds[] = $id;
            $href = $link->getAttribute('href');
            if ($kind === 'product') {
                $titleNode = firstNode($xpath, './/*[' . classQuery('title14') . ']', $entry);
                $sketchNode = firstNode($xpath, './/*[' . classQuery('infos') . ']', $entry);
            } else {
                $titleNode = firstNode($xpath, './/h3//a', $entry);
                $sketchNode = firstNode($xpath, './/p[' . classQuery('line-h-1-7') . ']', $entry);
            }
            $imageNode = firstNode($xpath, './/img', $entry);
            $image = '';
            if ($imageNode instanceof DOMElement) {
                $image = trim($imageNode->getAttribute('data-original')) ?: trim($imageNode->getAttribute('src'));
            }
            $records[$id] = [
                'id' => $id,
                'kind' => $kind,
                'nav_id' => $navId,
                'source_url' => $baseUrl . $href,
                'title' => nodeText($titleNode),
                'sketch' => nodeText($sketchNode),
                'image' => $image,
                'create_time' => timestampFromText(nodeText($entry), time()),
            ];
        }
        sort($pageIds);
        $signature = implode(',', $pageIds);
        if ($signature === '' || $signature === $previousIds) {
            break;
        }
        $previousIds = $signature;
        if ($kind === 'product') {
            break;
        }
        usleep(100000);
    }
    return $records;
}

function enrichRecord(array $record): ?array
{
    global $failures;
    $response = fetchUrl($record['source_url']);
    if (!$response['ok']) {
        $failures[] = ['stage' => 'detail', 'kind' => $record['kind'], 'id' => $record['id'], 'url' => $record['source_url'], 'status' => $response['status'], 'error' => $response['error'] ?? ''];
        return null;
    }
    list($document, $xpath) = loadHtml($response['body']);
    if ($record['kind'] === 'product') {
        $titleNode = firstNode($xpath, '//*[' . classQuery('a-title') . ']');
        $container = firstNode($xpath, '//div[' . classQuery('about-container') . '][.//*[' . classQuery('a-title') . ']]');
        $contentNode = $container ? firstNode($xpath, './/div[' . classQuery('line-h-2') . ']', $container) : null;
    } else {
        $article = firstNode($xpath, '//div[' . classQuery('news-article') . ']');
        $titleNode = $article ? firstNode($xpath, './/div[' . classQuery('title') . ']//h3', $article) : null;
        $contentNode = $article ? firstNode($xpath, './/div[' . classQuery('article-box') . ']', $article) : null;
    }
    $content = innerHtml($contentNode);
    if ($content === '') {
        $failures[] = ['stage' => 'parse', 'kind' => $record['kind'], 'id' => $record['id'], 'url' => $record['source_url'], 'error' => 'content node not found'];
        return null;
    }
    $record['title'] = nodeText($titleNode) ?: $record['title'];
    $record['content'] = $content;
    $record['seo_title'] = trim((string) preg_replace('/_广州众人搬家公司.*$/u', '', nodeText(firstNode($xpath, '//title'))));
    $record['seo_keyword'] = metaContent($xpath, 'keywords');
    $record['seo_content'] = metaContent($xpath, 'description');
    if ($record['sketch'] === '') {
        $record['sketch'] = $record['seo_content'];
    }
    $record['create_time'] = timestampFromText(nodeText(firstNode($xpath, '//div[' . classQuery('news-article') . ']')), $record['create_time']);
    return $record;
}

function existingRows(PDO $db, string $table): array
{
    $rows = [];
    foreach ($db->query("SELECT * FROM {$table}")->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $rows[(int) $row['id']] = $row;
    }
    return $rows;
}

function upsertRecord(PDO $db, string $table, array $record, array $existing): string
{
    $id = (int) $record['id'];
    $isExisting = isset($existing[$id]);
    $current = $isExisting ? $existing[$id] : [];
    $kind = $record['kind'];
    $values = [
        'title' => $record['title'],
        'content' => $record['content'],
        'sketch' => $record['sketch'],
        'seo_title' => $record['seo_title'],
        'seo_keyword' => $record['seo_keyword'],
        'seo_content' => $record['seo_content'],
        'image' => $record['image'] ?: ($current['image'] ?? ''),
        'create_time' => $record['create_time'],
        'update_time' => time(),
        'nav_id' => $record['nav_id'],
        'nav_pid' => $kind === 'article' ? 7 : ($kind === 'case' ? 6 : 0),
        'status' => 1,
        'model' => $kind === 'article' ? 'news' : ($kind === 'case' ? 'cases' : 'products'),
        'link' => $kind === 'article' ? "/detail/news{$id}.html" : ($kind === 'case' ? "/detail_cases{$id}.html" : "/detail/products{$id}.html"),
        'target' => '_self',
        'lang' => 'zh-cn',
    ];
    if ($kind === 'product' && !empty($current['image'])) {
        // Keep the locally approved Zhongren brand mark on service cards.
        $values['image'] = $current['image'];
    }
    if ($isExisting) {
        $sets = [];
        foreach ($values as $column => $value) {
            $sets[] = "{$column} = :{$column}";
        }
        $values['id'] = $id;
        $statement = $db->prepare("UPDATE {$table} SET " . implode(', ', $sets) . ' WHERE id = :id');
        $statement->execute($values);
        return 'updated';
    }
    $values += [
        'id' => $id,
        'state' => 0,
        'states' => 0,
        'sort' => $kind === 'article' ? 1 : 0,
        'browse' => 0,
    ];
    if ($kind === 'article') {
        $values['type'] = 'default';
    }
    $columns = array_keys($values);
    $placeholders = array_map(static function (string $column): string { return ':' . $column; }, $columns);
    $statement = $db->prepare("INSERT INTO {$table} (" . implode(', ', $columns) . ') VALUES (' . implode(', ', $placeholders) . ')');
    $statement->execute($values);
    return 'inserted';
}

function mediaPaths(array $record): array
{
    $paths = [];
    if (!empty($record['image'])) {
        $paths[] = $record['image'];
    }
    if (preg_match_all('/(?:src|data-original)=["\']([^"\']+)["\']/i', $record['content'], $matches)) {
        $paths = array_merge($paths, $matches[1]);
    }
    $valid = [];
    foreach ($paths as $path) {
        $path = html_entity_decode(trim($path), ENT_QUOTES, 'UTF-8');
        if (preg_match('#^https?://#i', $path)) {
            continue;
        }
        $urlPath = parse_url($path, PHP_URL_PATH);
        if (!is_string($urlPath) || strpos($urlPath, '..') !== false) {
            continue;
        }
        if (strpos($urlPath, '/upload/') === 0 || strpos($urlPath, '/ueditor/php/upload/') === 0) {
            $valid[$urlPath] = true;
        }
    }
    return array_keys($valid);
}

function localizeExternalMedia(array $record): array
{
    global $projectRoot, $mediaLog, $failures;
    if (!preg_match_all('/src=["\'](https?:\/\/[^"\']+)["\']/i', $record['content'], $matches)) {
        return $record;
    }
    foreach (array_unique($matches[1]) as $sourceUrl) {
        $host = strtolower((string) parse_url($sourceUrl, PHP_URL_HOST));
        if ($host === 'zrbanjia.com' || $host === 'www.zrbanjia.com') {
            $sourcePath = (string) parse_url($sourceUrl, PHP_URL_PATH);
            $record['content'] = str_replace($sourceUrl, $sourcePath, $record['content']);
            continue;
        }
        $sourcePath = (string) parse_url($sourceUrl, PHP_URL_PATH);
        $extension = strtolower((string) pathinfo($sourcePath, PATHINFO_EXTENSION));
        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'], true)) {
            $extension = 'bin';
        }
        $localPath = '/upload/imported/' . substr(sha1($sourceUrl), 0, 16) . '.' . $extension;
        $destination = $projectRoot . '/public' . $localPath;
        if (!is_file($destination) || filesize($destination) === 0) {
            $response = fetchUrl($sourceUrl, true);
            if (!$response['ok'] || $response['body'] === '') {
                $failures[] = ['stage' => 'external-media', 'kind' => $record['kind'], 'id' => $record['id'], 'url' => $sourceUrl, 'status' => $response['status'], 'error' => $response['error'] ?? 'empty response'];
                $mediaLog[$localPath] = ['status' => 'failed', 'source_url' => $sourceUrl];
                continue;
            }
            $directory = dirname($destination);
            if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
                $failures[] = ['stage' => 'external-media', 'kind' => $record['kind'], 'id' => $record['id'], 'url' => $sourceUrl, 'error' => 'cannot create directory'];
                $mediaLog[$localPath] = ['status' => 'failed', 'source_url' => $sourceUrl];
                continue;
            }
            file_put_contents($destination, $response['body']);
            $mediaLog[$localPath] = ['status' => 'downloaded', 'bytes' => filesize($destination), 'source_url' => $sourceUrl];
        } else {
            $mediaLog[$localPath] = ['status' => 'existing', 'bytes' => filesize($destination), 'source_url' => $sourceUrl];
        }
        $record['content'] = str_replace($sourceUrl, $localPath, $record['content']);
    }
    return $record;
}

function syncMedia(array $record): void
{
    global $baseUrl, $projectRoot, $mediaLog, $failures;
    foreach (mediaPaths($record) as $path) {
        $destination = $projectRoot . '/public' . $path;
        if (is_file($destination) && filesize($destination) > 0) {
            $mediaLog[$path] = ['status' => 'existing', 'bytes' => filesize($destination)];
            continue;
        }
        $response = fetchUrl($baseUrl . $path, true);
        if (!$response['ok'] || $response['body'] === '') {
            $failures[] = ['stage' => 'media', 'kind' => $record['kind'], 'id' => $record['id'], 'url' => $baseUrl . $path, 'status' => $response['status'], 'error' => $response['error'] ?? 'empty response'];
            $mediaLog[$path] = ['status' => 'failed'];
            continue;
        }
        $directory = dirname($destination);
        if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
            $failures[] = ['stage' => 'media', 'kind' => $record['kind'], 'id' => $record['id'], 'url' => $baseUrl . $path, 'error' => 'cannot create directory'];
            $mediaLog[$path] = ['status' => 'failed'];
            continue;
        }
        if (file_put_contents($destination, $response['body']) === false) {
            $failures[] = ['stage' => 'media', 'kind' => $record['kind'], 'id' => $record['id'], 'url' => $baseUrl . $path, 'error' => 'cannot write file'];
            $mediaLog[$path] = ['status' => 'failed'];
            continue;
        }
        $mediaLog[$path] = ['status' => 'downloaded', 'bytes' => filesize($destination)];
    }
}

$db = new PDO('sqlite:' . $dbPath);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$existing = [
    'article' => existingRows($db, 'zw_cms_article'),
    'case' => existingRows($db, 'zw_cms_cases'),
    'product' => existingRows($db, 'zw_cms_product'),
];

$definitions = [
    ['kind' => 'article', 'nav_id' => 11, 'path' => '/news/11.html', 'pattern' => '#^/detail/news(\d+)\.html$#', 'pages' => 60],
    ['kind' => 'article', 'nav_id' => 12, 'path' => '/news/12.html', 'pattern' => '#^/detail/news(\d+)\.html$#', 'pages' => 60],
    ['kind' => 'case', 'nav_id' => 9, 'path' => '/cases/9.html', 'pattern' => '#^/detail_cases(\d+)\.html$#', 'pages' => 20],
    ['kind' => 'case', 'nav_id' => 10, 'path' => '/cases/10.html', 'pattern' => '#^/detail_cases(\d+)\.html$#', 'pages' => 20],
    ['kind' => 'product', 'nav_id' => 2, 'path' => '/products/2.html', 'pattern' => '#^/detail/products(\d+)\.html$#', 'pages' => 1],
    ['kind' => 'product', 'nav_id' => 3, 'path' => '/products/3.html', 'pattern' => '#^/detail/products(\d+)\.html$#', 'pages' => 1],
    ['kind' => 'product', 'nav_id' => 4, 'path' => '/products/4.html', 'pattern' => '#^/detail/products(\d+)\.html$#', 'pages' => 1],
];

$discovered = ['article' => [], 'case' => [], 'product' => []];
foreach ($definitions as $definition) {
    $found = discoverRecords($definition['kind'], $definition['nav_id'], $definition['path'], $definition['pattern'], $definition['pages']);
    foreach ($found as $id => $record) {
        if (isset($existing[$definition['kind']][$id])) {
            $record['nav_id'] = (int) $existing[$definition['kind']][$id]['nav_id'];
        }
        if (!isset($discovered[$definition['kind']][$id])) {
            $discovered[$definition['kind']][$id] = $record;
        }
    }
}

foreach ($discovered as $kind => &$records) {
    ksort($records, SORT_NUMERIC);
    if ($maxItems > 0) {
        $records = array_slice($records, 0, $maxItems, true);
    }
}
unset($records);

$tableMap = ['article' => 'zw_cms_article', 'case' => 'zw_cms_cases', 'product' => 'zw_cms_product'];
$db->beginTransaction();
try {
    foreach ($discovered as $kind => $records) {
        foreach ($records as $record) {
            $enriched = enrichRecord($record);
            if (!$enriched) {
                continue;
            }
            if (!$dryRun) {
                $enriched = localizeExternalMedia($enriched);
            }
            $action = $dryRun ? (isset($existing[$kind][$enriched['id']]) ? 'would-update' : 'would-insert') : upsertRecord($db, $tableMap[$kind], $enriched, $existing[$kind]);
            if (!$dryRun) {
                syncMedia($enriched);
            }
            $recordLog[] = [
                'kind' => $kind,
                'id' => $enriched['id'],
                'action' => $action,
                'title' => $enriched['title'],
                'nav_id' => $enriched['nav_id'],
                'source_url' => $enriched['source_url'],
                'image' => $enriched['image'],
            ];
            usleep(100000);
        }
    }
    if ($dryRun) {
        $db->rollBack();
    } else {
        $db->commit();
    }
} catch (Throwable $exception) {
    if ($db->inTransaction()) {
        $db->rollBack();
    }
    $failures[] = ['stage' => 'database', 'error' => $exception->getMessage()];
}

$counts = [];
foreach ($recordLog as $entry) {
    $key = $entry['kind'] . ':' . $entry['action'];
    $counts[$key] = ($counts[$key] ?? 0) + 1;
}
$downloaded = count(array_filter($mediaLog, static function (array $entry): bool { return $entry['status'] === 'downloaded'; }));
$existingMedia = count(array_filter($mediaLog, static function (array $entry): bool { return $entry['status'] === 'existing'; }));
$failedMedia = count(array_filter($mediaLog, static function (array $entry): bool { return $entry['status'] === 'failed'; }));

$log = [
    'run_id' => $runId,
    'started_at' => date(DATE_ATOM, strtotime($runId) ?: time()),
    'finished_at' => date(DATE_ATOM),
    'dry_run' => $dryRun,
    'source' => $baseUrl,
    'database' => $dbPath,
    'requests' => $requestCount,
    'discovered' => [
        'articles' => count($discovered['article']),
        'cases' => count($discovered['case']),
        'products' => count($discovered['product']),
    ],
    'actions' => $counts,
    'media' => [
        'downloaded' => $downloaded,
        'existing' => $existingMedia,
        'failed' => $failedMedia,
    ],
    'failures' => $failures,
    'records' => $recordLog,
    'media_files' => $mediaLog,
];

file_put_contents($jsonLogPath, json_encode($log, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
$text = [];
$text[] = 'Zrbanjia content migration';
$text[] = 'Run: ' . $runId;
$text[] = 'Source: ' . $baseUrl;
$text[] = 'Database: ' . $dbPath;
$text[] = 'Mode: ' . ($dryRun ? 'dry-run' : 'write');
$text[] = 'Discovered: articles=' . count($discovered['article']) . ', cases=' . count($discovered['case']) . ', products=' . count($discovered['product']);
$text[] = 'Actions: ' . json_encode($counts, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
$text[] = "Media: downloaded={$downloaded}, existing={$existingMedia}, failed={$failedMedia}";
$text[] = 'Failures: ' . count($failures);
$text[] = 'JSON log: ' . $jsonLogPath;
file_put_contents($textLogPath, implode(PHP_EOL, $text) . PHP_EOL);

echo implode(PHP_EOL, $text) . PHP_EOL;
if (!empty($failures)) {
    exit(2);
}
