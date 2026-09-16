<?php
// Use the current Zhongren fleet visuals instead of legacy brand photos.
$fleetFeatureImages = [
    '专业团队' => '/upload/brand/zhongren-fleet-team.jpg',
    '全程跟进' => '/upload/brand/zhongren-fleet-team.jpg',
    '广泛覆盖' => '/upload/brand/zhongren-fleet-lineup.jpg',
];
foreach ($BDTS['child_id'] as &$feature) {
    if (isset($fleetFeatureImages[$feature['title']])) {
        $feature['image'] = $assetUrl($fleetFeatureImages[$feature['title']]);
    }
}
unset($feature);
// Keep this shared pricing answer aligned with the published price sheet.
foreach ($CJWT['child_id'] as &$question) {
    if (trim($question['title']) === '一站式搬家打包如何收费？') {
        $question['content'] = <<<'HTML'
<p>众人搬家的打包搬家服务按体积计费，普通搬家按车型套餐计费。按报价单举三个例子：</p>
<p><strong>5立方米、10立方米有多大？</strong>可以拿搬家车的货厢作对照：常见小面包货车约2—3立方米；金杯类货运面包车约6—8立方米；4米2厢货约15—20立方米；7米级厢货（如7米6）约35—45立方米；9米级厢货（如9米6）约50—60立方米。这里说的是货厢空间，不是载重量。</p>
<p>直观理解：5立方米约占一辆金杯货运面包车的大半车；10立方米超过一辆普通金杯的货厢空间，约占4米2厢货的半车到三分之二。上述为体积参考，不同车型尺寸、家具形状及堆放空隙会影响实际装载；按立方米报价的服务会在勘测后确认物品体积和费用，不按整辆车的容积收费。</p>
<p>① 半日式搬家：280元/立方米，5立方米起。5立方米为1400元，包含旧家打包收纳、装车、运输、卸车，不含新家还原。</p>
<p>② 日式精品搬家：320元/立方米，10立方米起。10立方米为3200元，在半日式服务基础上，增加新家家具、衣物等物品还原及指定位置摆放。</p>
<p>③ 自己打包、我们搬运：小型厢式货车469元，包含装车、运输、卸车及10公里运输。若运输15公里，超出5公里按7元/公里计算，合计504元。另有大型面包车380元、大型厢式货车569元套餐。</p>
<p>以上算例未计其他增项。无平地搬运费；楼层、超时人工、材料等适用费用见<a href="/pricing.html">完整报价说明</a>。半日式、日式精品搬家免费上门勘测，不下单也免费。作业前书面确认费用，约定范围内不临时加价，公司勘测漏项不向客户加价。</p>
HTML;
    }
}
unset($question);
?>
<div class="center clearfix"><div class="wow fadeInUp" data-wow-delay="0.1s"><div class="plate-top clearfix mt45"><p><?= $CX['title'] ?><span><?= $CX['subtitle'] ?></span></p></div><ul class="tc-service mt20 clearfix"><?php foreach ($CX['child_id'] as $item): ?><li class="boxsh"><div class="top-img"><h1 class="text-center fs-18"><?= $item['title'] ?></h1><p class="text-center mt20 fs-16 main-color cc"><span class="mbxb_price"><?= $item['subtitle'] ?></span></p><div class="car mt20"><div class="img-box text-center"><img class="lazy" data-original="<?= $item['image'] ?>" alt="" src="<?= $item['image'] ?>" style="display: inline-block;"></div><div class="text-box c666"><?= $item['sketch'] ?></div></div></div><div class="a-href"><a href="javascript:" class="getBaojia">获取报价</a><a href="tel:<?= preg_replace('/\D+/', '', (string) $site['phone']) ?>">在线咨询</a></div></li><?php endforeach; ?></ul></div></div>
<div class="center clearfix"><div class="wow fadeInUp"><div class="title-top clearfix mt45"><p><?= $BDTS['title'] ?> <span><?= $BDTS['subtitle'] ?></span></p></div><div class="characteristic mt20 boxsh clearfix"><ul><?php foreach ($BDTS['child_id'] as $item): ?><li><p class="img"><img class="lazy" data-original="<?= $item['image'] ?>" alt="<?= htmlspecialchars($item['title'] . '—众人搬家服务展示', ENT_QUOTES, 'UTF-8') ?>" src="<?= $item['image'] ?>" style="display: block;"></p><p class="txt"><?= $item['title'] ?></p><div class="text-box"><p class="fs-18"><?= $item['title'] ?></p><p class="mt10 fs-14"><?= $item['sketch'] ?></p></div></li><?php endforeach; ?></ul></div></div></div>
<div class="center clearfix"><div class="wow fadeInUp" data-wow-delay="0.1s"><div class="title-top clearfix mt45"><p><?= $CJWT['title'] ?> <span><?= $CJWT['subtitle'] ?></span></p></div><div class="question-box mt20"><ul class="question-ul flex flex-wrap"><?php foreach ($CJWT['child_id'] as $item): ?><li><div class="question-li"><div class="fl"><span class="que-icon">Q</span></div><div class="fl question-title fs-16"><span><?= $item['title'] ?></span></div></div><div class="question-ans mt20"><div class="fl"><span class="ans-icon">A</span></div><div class="fl question-ans-text fs-14 c888 line-h-2"><?= html_entity_decode($item['content'] ?? '') ?></div></div></li><?php endforeach; ?></ul></div></div></div>
<div class="center clearfix"><div class="wow fadeInUp" data-wow-delay="0.1s"><div class="title-top clearfix mt45"><p><?= $why['title'] ?><span><?= $why['subtitle'] ?></span></p></div><div class="reasons pl-0 pr-0 mt20 boxsh over-hidden"><div class="left-content df js fc"><?php foreach (array_slice($why['child_id'], 0, 3) as $item): ?><div class="list list-left df ac"><div class="text text-right flex-1"><h3 class="fs-16 mb10"><?= $item['title'] ?></h3><p class="c888 fs-13 line-h-1-7"><?= $item['sketch'] ?></p></div><span class="ico fr"><img src="<?= $item['icon1'] ?>" class="icon_img icon1" alt=""><img src="<?= $item['icon2'] ?>" class="icon_img icon1_hover" alt=""></span></div><?php endforeach; ?></div><div class="center-content"><div class="top_video"><div class="img_box"><img src="<?= $why['image'] ?>" alt=""><div class="img_c"></div></div></div><div class="bottom_baojia"><img src="/static/home/images/r_img_01.png" alt=""><div class="mt25"><p class="fs-20 df ac">免费获取报价 <span class="hot">HOT</span></p><p class="mt10 mb10">30秒算一算搬家要花多少钱</p><p class="zixun-online getBaojia">立即获取</p></div></div></div><div class="right-content df js fc"><?php foreach (array_slice($why['child_id'], 3, 3) as $item): ?><div class="list list-right df ac"><span class="ico fr"><img src="<?= $item['icon1'] ?>" class="icon_img icon1" alt=""><img src="<?= $item['icon2'] ?>" class="icon_img icon1_hover" alt=""></span><div class="text text-left flex-1"><h3 class="fs-16 mb10"><?= $item['title'] ?></h3><p class="c888 fs-13 line-h-1-7"><?= $item['sketch'] ?></p></div></div><?php endforeach; ?></div></div></div></div>
<div class="center clearfix"><div class="wow fadeInUp" data-wow-delay="0.1s"><div class="title-top clearfix mt45"><p><?= $BZCL['title'] ?> <span><?= $BZCL['subtitle'] ?></span></p><p class="button-bz"><a href="javascript:" class="btn-left swiper-button-disabled" id="bz-btn-prev">‹</a><a href="javascript:" class="btn-right" id="bz-btn-next">›</a></p></div><div class="case-site mt20"><div class="swiper-container case-site-swiper swiper-container-horizontal"><div class="swiper-wrapper"><?php foreach ($BZCL['child_id'] as $item): ?><div class="swiper-slide swiper-slide-active"><div class="slide"><div class="img-box"><img class="lazy" data-original="<?= $item['image'] ?>" alt="" src="<?= $item['image'] ?>" style="display: block;"></div><div class="text-box"><p class="fs-16 mb10 text-center"><?= $item['title'] ?></p><p class="infos"><?= $item['sketch'] ?></p></div></div></div><?php endforeach; ?></div></div></div></div></div>
