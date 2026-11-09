<?php include VIEW_PATH . 'layout/header.php'; ?>
<link rel="stylesheet" href="<?= htmlspecialchars($assetUrl('/static/home/css/index.css'), ENT_QUOTES, 'UTF-8') ?>"><link rel="stylesheet" href="<?= htmlspecialchars($assetUrl('/static/home/css/products.css'), ENT_QUOTES, 'UTF-8') ?>">
<?php include VIEW_PATH . 'layout/service_banner.php'; ?>
<section class="center boxsh pd20 mt20" aria-labelledby="product-title">
    <h1 id="product-title" class="fs-24 mb10"><?= htmlspecialchars($detail['title'], ENT_QUOTES, 'UTF-8') ?></h1>
    <?php if ($isOfficeMoving): ?>
    <p class="line-h-2">办公室搬迁要核对承运资质、分项报价和设备防护方案。众人由公司统一勘察、报价和调度，按部门清点物资，确认两端楼层、电梯及可作业时间，商定装卸顺序和验收方式。</p>
    <h2 class="fs-18 mt20 mb10">预约前准备这三项</h2>
    <ul class="line-h-2" style="list-style:disc;padding-left:24px">
        <li>列出工位、家具、电脑和档案；需要拆装或特殊防护的设备单独标记。</li>
        <li>核对两端物业的货梯、车辆进出、施工时段和场地保护要求。</li>
        <li>确认报价是否列清包装、拆装、运输和可能的增项，并约定到场清点和签收责任人。</li>
    </ul>
    <h2 class="fs-18 mt20 mb10">办公室搬迁如何报价？</h2>
    <p class="line-h-2">企业项目按物资清单和现场条件分项报价。勘测后书面列明包装、拆装、装卸、运输和可能的增项，确认后再安排作业。官网居民车型套餐不作为办公室搬迁项目报价。</p>
    <p class="line-h-2"><a href="/detail_cases32.html">查看广汽零部件总部搬迁案例：设备防护、物资编号与交接</a> · <a href="/about/13.html">查看经营资质</a> · <a href="/pricing.html#price-lock">查看费用确认规则</a></p>
    <?php endif; ?>
</section>
<?php include VIEW_PATH . 'layout/direct_service.php'; ?>
<?php if (!$isOfficeMoving): ?>
<p class="center" style="padding:20px 0;line-height:1.8"><a href="/pricing.html" style="color:#c6382c;text-decoration:underline">报价说明 &amp; 常见加价避坑：查看套餐、费用构成、免费勘测与合同锁价承诺 →</a></p>
<p class="center" style="line-height:1.8">服务单位：广东众人搬家起重吊装有限公司。服务覆盖广州及珠三角，具体地址与作业安排在预约时确认。</p>
<div class="wow fadeInUp" data-wow-delay="0.1s"><div class="center"><div class="title-top clearfix mt45"><p>业务介绍<span>Business Introduction</span></p></div></div><div class="about-container pd50 center mt20 border-radius-5 fs-14"><div class="clearfix"><div class="mt30 line-h-2"><?= html_entity_decode($detail['content'] ?? '') ?></div></div></div></div>
<?php include VIEW_PATH . 'layout/product_sections.php'; ?>
<?php endif; ?>
<?php include VIEW_PATH . 'layout/footer.php'; ?>
