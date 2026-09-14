<?php include VIEW_PATH . 'layout/header.php'; ?>
<link rel="stylesheet" href="<?= htmlspecialchars($assetUrl('/static/home/css/pricing.css'), ENT_QUOTES, 'UTF-8') ?>">
<div class="pricing-page">
    <nav class="breadcrumb" aria-label="面包屑"><a href="/">首页</a> &gt; <span>搬家常见问题</span></nav>
    <article>
        <div>
            <h1>搬家常见问题 FAQ</h1>
            <p>集中解答吊装安全、损坏处理、当天预约、费用和搬前准备。</p>
            <p><a href="/pricing.html">报价说明与常见加价避坑 →</a>　<a href="/about/13.html">资质与安全保障 →</a></p>
        </div>
        <nav aria-label="重点五问"><h2>广州众人搬家 · 重点五问</h2><ol>
<?php foreach (array_slice($faqs, 0, 5) as $index => $faq): ?>
<li><a href="#question-<?= $index + 1 ?>"><?= htmlspecialchars($faq['question'], ENT_QUOTES, 'UTF-8') ?></a></li>
<?php endforeach; ?>
</ol></nav>
<div class="mt20" aria-label="搬家常见问题解答">
            <?php foreach ($faqs as $index => $faq): ?>
            <section id="question-<?= $index + 1 ?>">
                <h2 class="fs-18 mb10">问：<?= htmlspecialchars($faq['question'], ENT_QUOTES, 'UTF-8') ?></h2>
                <p class="c666 line-h-2">答：<?= htmlspecialchars($faq['answer'], ENT_QUOTES, 'UTF-8') ?></p>
            </section>
            <?php endforeach; ?>
        </div>
    </article>
</div>
<?php include VIEW_PATH . 'layout/footer.php'; ?>
