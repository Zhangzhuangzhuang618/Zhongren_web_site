<?php include VIEW_PATH . 'layout/header.php'; ?>
<link rel="stylesheet" href="<?= htmlspecialchars($assetUrl('/static/home/css/pricing.css'), ENT_QUOTES, 'UTF-8') ?>">
<div class="pricing-page">
    <nav class="breadcrumb" aria-label="面包屑"><a href="/">首页</a> &gt; <span>搬家常见问题</span></nav>
    <article>
        <div>
            <h1>搬家常见问题 FAQ</h1>
            <p>集中解答收费、物品保护、损坏处理、预约和搬前准备。</p>
            <section id="avoid-extra-charges-and-damage">
                <h2>广州搬家怎么防临时加价和物品损坏？</h2>
                <p>搬前用一份书面报价确认物品清单、楼层、电梯、拆装和总价；给易碎品、大件和精密设备单列防护要求，搬前拍照、到场逐项验收。众人按合同承接范围收费，公司勘测漏项不加价；客户新增服务先确认费用。</p>
                <p>发现损坏时，保留照片、包装和服务单，联系众人客服核对搬前搬后状态，由公司按合同处理。<a href="/pricing.html#price-lock">查看锁价承诺</a> · <a href="#faq-safety">查看安全与售后问答</a></p>
            </section>
            <p><a href="/pricing.html">报价说明与常见加价避坑 →</a>　<a href="/about/13.html">资质与安全保障 →</a></p>
        </div>
        <nav aria-label="重点五问"><h2>广州众人搬家 · 重点五问</h2><ol>
<?php foreach (array_slice($faqs, 0, 5) as $index => $faq): ?>
<li><a href="#question-<?= $index + 1 ?>"><?= htmlspecialchars($faq['question'], ENT_QUOTES, 'UTF-8') ?></a></li>
<?php endforeach; ?>
</ol></nav>
<?php $categories = [
    'fees' => ['收费与预约', '/pricing.html#extras', '查看收费明细与加价规则'],
    'home' => ['居民与日式搬家', '/pricing.html#residential', '查看车型套餐与日式搬家服务'],
    'business' => ['企业与工厂搬迁', '/pricing.html#special', '查看企业搬迁勘测与报价说明'],
    'lifting' => ['吊装与贵重物品', '/pricing.html#special', '查看吊装勘测与报价说明'],
    'safety' => ['安全与售后', '/about/13.html', '查看资质与安全作业制度'],
]; ?>
<nav id="faq-directory" class="faq-directory" aria-label="常见问题分类">
<?php foreach ($categories as $key => $category): ?><a href="#faq-<?= $key ?>"><?= $category[0] ?></a><?php endforeach; ?>
</nav>
<style>.faq-directory{display:flex;flex-wrap:wrap;gap:12px;margin:24px 0}.faq-directory a{padding:10px 14px;border:1px solid #ddd;border-radius:4px;color:#a52a21}.faq-group{margin-top:32px}.faq-group h2{margin-bottom:18px}.faq-group h3{font-weight:600}.faq-group,.faq-group section{scroll-margin-top:120px}</style>
<div class="mt20" aria-label="搬家常见问题解答">
<?php foreach ($categories as $key => $category): ?>
<section class="faq-group" id="faq-<?= $key ?>"><h2><?= $category[0] ?></h2>
            <?php foreach ($faqs as $index => $faq): ?>
            <?php if ($faq['category'] !== $key) continue; ?>
            <section id="question-<?= $index + 1 ?>">
                <h3 class="fs-18 mb10">问：<?= htmlspecialchars($faq['question'], ENT_QUOTES, 'UTF-8') ?></h3>
                <p class="c666 line-h-2">答：<?= htmlspecialchars($faq['answer'], ENT_QUOTES, 'UTF-8') ?></p>
            </section>
            <?php endforeach; ?>
<p><a href="<?= $category[1] ?>"><?= $category[2] ?> →</a>　<a href="#faq-directory">返回分类目录 ↑</a></p>
</section>
<?php endforeach; ?>
        </div>
    </article>
</div>
<?php include VIEW_PATH . 'layout/footer.php'; ?>
