<?php include VIEW_PATH . 'layout/header.php'; ?>
<link rel="stylesheet" href="<?= htmlspecialchars($assetUrl('/static/home/css/about.css'), ENT_QUOTES, 'UTF-8') ?>">
<div class="page-banner"><img src="<?= htmlspecialchars($assetUrl($banner), ENT_QUOTES, 'UTF-8') ?>" class="w100 block" alt=""></div>
<div><div class="about_nav_2"><ul class="center clearfix"><?php foreach ($classify as $item): ?><a href="<?= $item['href'] ?: '/about/' . $item['id'] . '.html' ?>" target="<?= $item['target'] ?: '_self' ?>"><li class="df ac jc"><span class="icon" style="background-image: url(<?= $item['icon'] ?>);"></span><span><?= $item['title'] ?></span></li></a><?php endforeach; ?></ul></div></div>
<div>
    <div class="wow fadeInUp" data-wow-delay="0.1s">
        <div class="center">
            <div class="title-top clearfix mt45"><p><?= $page['title'] ?><span><?= $page['subtitle'] ?></span></p></div>
        </div>
        <div class="about-container pd50 center mt20 border-radius-5 fs-14">
            <div class="clearfix">
                <?php if (($page['id'] ?? 0) === 13): ?>
                <div class="fs-24 text-center"><p class="a-title">众人搬家连锁品牌</p></div>
                <?php endif; ?>
                <div class="line-h-2"><?= html_entity_decode($page['content'] ?? '') ?></div>
            </div>

            <?php if (($page['id'] ?? 0) === 13): ?>
            <section class="company-recognition" id="company-recognition" aria-labelledby="company-recognition-title">
                <div class="company-recognition-heading">
                    <h2 id="company-recognition-title">企业资质与社会认可</h2>
                    <p>广东众人搬家起重吊装有限公司获评2024年度中国BNI英才分会《搬家》唯一指定供应商，并为琶洲商会第一届理事会会员。</p>
                </div>
                <div class="company-recognition-grid">
                    <figure class="company-recognition-card">
                        <a href="<?= htmlspecialchars($assetUrl('/upload/recognition/bni-2024-designated-supplier.jpg'), ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer" aria-label="查看中国BNI英才分会搬家唯一指定供应商牌匾原图">
                            <span class="company-recognition-image">
                                <img src="<?= htmlspecialchars($assetUrl('/upload/recognition/bni-2024-designated-supplier.jpg'), ENT_QUOTES, 'UTF-8') ?>" loading="lazy" width="1448" height="1086" alt="2024年度中国BNI英才分会搬家唯一指定供应商牌匾">
                            </span>
                        </a>
                        <figcaption>
                            <strong>中国BNI英才分会《搬家》唯一指定供应商</strong>
                            <span>2024年度</span>
                        </figcaption>
                    </figure>
                    <figure class="company-recognition-card">
                        <a href="<?= htmlspecialchars($assetUrl('/upload/recognition/pazhou-chamber-first-council-member.jpg'), ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer" aria-label="查看琶洲商会第一届理事会会员牌匾原图">
                            <span class="company-recognition-image">
                                <img src="<?= htmlspecialchars($assetUrl('/upload/recognition/pazhou-chamber-first-council-member.jpg'), ENT_QUOTES, 'UTF-8') ?>" loading="lazy" width="1600" height="1200" alt="琶洲商会第一届理事会会员牌匾">
                            </span>
                        </a>
                        <figcaption>
                            <strong>琶洲商会第一届理事会会员</strong>
                            <span>2025年3月</span>
                        </figcaption>
                    </figure>
                </div>
            </section>
            <?php endif; ?>
        </div>
    </div>
</div>
    <?php include VIEW_PATH . 'layout/footer.php'; ?>
