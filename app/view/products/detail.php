<?php include VIEW_PATH . 'layout/header.php'; ?>
<link rel="stylesheet" href="<?= htmlspecialchars($assetUrl('/static/home/css/index.css'), ENT_QUOTES, 'UTF-8') ?>"><link rel="stylesheet" href="<?= htmlspecialchars($assetUrl('/static/home/css/products.css'), ENT_QUOTES, 'UTF-8') ?>">
<?php include VIEW_PATH . 'layout/service_banner.php'; ?>
<p class="center" style="padding:20px 0;line-height:1.8"><a href="/pricing.html" style="color:#c6382c;text-decoration:underline">报价说明 &amp; 常见加价避坑：查看套餐、费用构成、免费勘测与合同锁价承诺 →</a></p>
<p class="center" style="line-height:1.8">服务单位：广东众人搬家起重吊装有限公司。服务覆盖广州及珠三角，具体地址与作业安排在预约时确认。</p>
<div class="wow fadeInUp" data-wow-delay="0.1s"><div class="center"><div class="title-top clearfix mt45"><p>业务介绍<span>Business Introduction</span></p></div></div><div class="about-container pd50 center mt20 border-radius-5 fs-14"><div class="clearfix"><div class="fs-24 text-center"><p class="a-title"><?= $detail['title'] ?></p></div><div class="mt30 line-h-2"><?= html_entity_decode($detail['content'] ?? '') ?></div></div></div></div>
<?php include VIEW_PATH . 'layout/product_sections.php'; ?>
<?php include VIEW_PATH . 'layout/footer.php'; ?>
