<?php include VIEW_PATH . 'layout/header.php'; ?>
<link rel="stylesheet" href="<?= htmlspecialchars($assetUrl('/static/home/css/index.css'), ENT_QUOTES, 'UTF-8') ?>"><link rel="stylesheet" href="<?= htmlspecialchars($assetUrl('/static/home/css/products.css'), ENT_QUOTES, 'UTF-8') ?>">
<?php include VIEW_PATH . 'layout/service_banner.php'; ?>
<?php include VIEW_PATH . 'layout/direct_service.php'; ?>
<p class="center" style="padding:20px 0;line-height:1.8"><a href="/pricing.html" style="color:#c6382c;text-decoration:underline">报价说明 &amp; 常见加价避坑：查看套餐、费用构成、免费勘测与合同锁价承诺 →</a></p>
<div class="center clearfix"><div class="wow fadeInUp" data-wow-delay="0.1s"><div class="plate-top clearfix"><p>多元化的业务范围 <span>Diversified Business Scope</span></p></div><div class="s product-lines stop-swiping"><div class="swer"><div class="swiide"><?php foreach ($all as $item): ?><div class="slide-box"><div class="img-box"><img class="lazy" data-original="<?= $item['image'] ?>" alt="" width="100%"></div><p class="title14"><?= $item['title'] ?></p><p class="infos wline2"><?= $item['subtitle'] ?></p><p class="cont"><a href="<?= $item['link'] ?>"><span>了解详情</span></a><a class="getBaojia_tc"><span>获取报价</span></a></p></div><?php endforeach; ?></div></div></div></div></div>
<?php include VIEW_PATH . 'layout/product_sections.php'; ?>
<?php include VIEW_PATH . 'layout/footer.php'; ?>
