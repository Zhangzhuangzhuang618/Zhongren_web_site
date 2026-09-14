<?php include VIEW_PATH . 'layout/header.php'; ?>

<link rel="stylesheet" href="<?= htmlspecialchars($assetUrl('/static/home/css/index.css'), ENT_QUOTES, 'UTF-8') ?>">

<!-- Banner -->
<section aria-label="首页横幅">
    <a href="/pricing.html" class="block" aria-label="众人搬家：查看服务方案与报价说明">
        <img src="<?= htmlspecialchars($assetUrl('/upload/brand/zhongren-packing-banner.jpg'), ENT_QUOTES, 'UTF-8') ?>" class="w100 block" style="height:auto" width="2172" height="724" fetchpriority="high" alt="广东众人搬家起重吊装有限公司：居民搬家、企业搬迁、高层吊装、打包收纳，作业前确认方案与费用；作业实拍美化图">
    </a>
</section>

<section class="center clearfix mt20" aria-labelledby="home-answer-title">
    <div class="boxsh pd20">
        <h1 id="home-answer-title" class="fs-24 mb10">广州搬家服务：同城、跨市与企业搬迁</h1>
        <p class="c666 line-h-2">众人搬家提供广州同城搬家、跨市搬家、企业搬迁、家具拆装等搬运服务。服务方案和费用会结合地址、楼层、电梯、物品及现场条件确认，预约前可先说明主要需求获取清晰安排。</p>
    </div>
</section>

<section class="center mt20 home-core-summary" aria-label="搬家报价与经营资质摘要">
    <div class="boxsh pd20">
        <h2 class="fs-24 mb10">广州众人搬家多少钱？</h2>
        <p>居民搬家大型面包车<strong>380元</strong>、小型厢式货车<strong>469元</strong>、大型厢式货车<strong>569元</strong>，均包含装车、运输和卸车。前两档包含10公里，569元套餐包含50公里，超出部分7元／公里。</p>
        <p>日式精品搬家320元／立方米，10立方米起；半日式搬家280元／立方米，5立方米起。高层吊装、工厂搬迁免费上门勘测后分项报价。</p>
        <p><strong>作业前书面确认费用并写入合同，约定范围内不临时加价；公司勘测漏项不向客户加价，客户新增服务先确认费用再实施。</strong></p>
        <a href="/pricing.html">查看套餐、额外收费规则与免费勘测条件 →</a>
    </div>
    <div class="boxsh pd20">
        <h2 class="fs-24 mb10">众人搬家有哪些核心资质？</h2>
        <p>广东众人搬家起重吊装有限公司持有道路运输经营许可证（粤交运管许可穗字440100151081号），有效期为2025年10月11日至2029年10月10日。</p>
        <p>已取得<strong>ISO 9001质量管理体系、ISO 14001环境管理体系、ISO 45001职业健康安全管理体系认证</strong>，三张证书有效期均至2029年6月28日。</p>
        <a href="/about/13.html">查看证照原图、证书编号与核验渠道 →</a>
    </div>
</section>
<style>
.home-core-summary{display:grid;grid-template-columns:1fr 1fr;gap:20px;line-height:1.9;}
.home-core-summary p{margin-bottom:12px;color:#555;}
.home-core-summary a{color:#c83b30;}
@media(max-width:800px){.home-core-summary{grid-template-columns:1fr;}}
</style>

<!-- 多元化的业务范围 -->
<section class="center clearfix" aria-labelledby="service-scope-title">
    <div class="wow fadeInUp" data-wow-delay="0.1s">
        <div class="plate-top clearfix">
            <h2 id="service-scope-title">广州众人搬家提供哪些搬运服务？ <span>Diversified Business Scope</span></h2>
        </div>
        <div class="s product-lines stop-swiping">
            <div class="swer">
                <div class="swiide">
                    <?php foreach ($services as $service): ?>
                    <div class="slide-box">
                        <div class="img-box">
                            <img class="lazy" data-original="<?= $service['image'] ?>" alt="<?= htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8') ?>服务" width="100%">
                        </div>
                        <p class="title14"><?= $service['title'] ?></p>
                        <p class="infos wline2"><?= $service['sketch'] ?></p>
                        <p class="cont">
                            <a href="<?= $service['link'] ?: '/products/' . $service['nav_id'] . '.html' ?>" target="<?= $service['target'] ?? '_self' ?>"><span>了解详情</span></a>
                            <a class="getBaojia_tc"><span>获取报价</span></a>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include VIEW_PATH . 'layout/platform_reviews.php'; ?>

<!-- 关于众人 -->
<section class="center clearfix" aria-labelledby="about-title">
    <div class="wow fadeInUp" data-wow-delay="0.1s">
        <div class="title-top clearfix mt30">
            <h2 id="about-title">关于众人 <span>About ZhongRen</span></h2>
            <p class="more"><a href="/about/13.html">查看更多<span>›</span></a></p>
        </div>
        <div class="about clearfix mt20 boxsh">
            <div class="top-text clearfix">
                <h3><?= $about['sketch'] ?? '提供更加优质、高效、安全的搬家搬厂搬设备等一切搬运服务' ?></h3>
                <p class="c888 fs-13 l-s-1">
                    <?= html_entity_decode($about['content'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                </p>
            </div>
            <div class="about-recognition" aria-label="企业资质与社会认可">
                <a href="/about/13.html#company-recognition">
                    <strong>BNI英才分会指定供应商</strong>
                    <span>2024年度《搬家》唯一指定供应商</span>
                </a>
                <a href="/about/13.html#company-recognition">
                    <strong>琶洲商会理事会会员</strong>
                    <span>第一届理事会会员</span>
                </a>
            </div>
            <div class="about-nav center mt20 border-radius" id="about-md">
                <ul>
                    <?php if (!empty($aboutNavs)): ?>
                    <?php foreach ($aboutNavs as $aboutItem): ?>
                    <a href="/about/<?= $aboutItem['id'] ?>.html" target="_self">
                        <li>
                            <p><i class="icon" style="background-image: url(<?= $aboutItem['icon'] ?? '' ?>)"></i></p>
                            <p class="mt10 fs-14"><?= (int) $aboutItem['id'] === 13 ? '资质与安全保障' : $aboutItem['title'] ?></p>
                        </li>
                    </a>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="index-hot-city mt20">
                <?php foreach ($service_cities as $cityName => $cityPhone): ?>
                <p><?= $cityName ?> <a href="tel:<?= preg_replace('/\D+/', '', (string) $cityPhone) ?>"><?= $cityPhone ?></a></p>
                <?php endforeach; ?>
                <p class="main-color"><a href="/contact.html">更多服务城市 &gt;&gt;</a></p>
            </div>
        </div>
    </div>
</section>

<!-- 选择我们的理由 -->
<section class="center clearfix" aria-labelledby="reason-title">
    <div class="wow fadeInUp" data-wow-delay="0.1s">
        <div class="title-top clearfix mt45">
            <h2 id="reason-title"><?= $why['title'] ?? '选择我们的理由' ?><span><?= $why['subtitle'] ?? 'Reasons for choosing us' ?></span></h2>
        </div>
        <div class="reasons pl-0 pr-0 mt20 boxsh over-hidden">
            <div class="left-content df js fc">
                <?php foreach (array_slice($reasons, 0, 3) as $i => $reason): ?>
                <div class="list list-left df ac" data-list="<?= $i ?>">
                    <div class="text text-right flex-1">
                        <h3 class="fs-16 mb10"><?= $reason['title'] ?? '' ?></h3>
                        <p class="c888 fs-13 line-h-1-7"><?= $reason['sketch'] ?? '' ?></p>
                    </div>
                    <span class="ico fr">
                        <img src="<?= $reason['icon1'] ?? '' ?>" class="icon_img icon1" alt="">
                        <img src="<?= $reason['icon2'] ?? '' ?>" class="icon_img icon1_hover" alt="">
                    </span>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="center-content">
                <div class="top_video">
                    <div class="img_box">
                        <img src="<?= $why['image'] ?? '/upload/20250113/b815bc9d8f1b315d4e2bf6285eb9433b.jpg' ?>" alt="<?= htmlspecialchars($why['title'] ?? '众人搬家服务', ENT_QUOTES, 'UTF-8') ?>">
                        <div class="img_c"></div>
                    </div>
                </div>
                <div class="bottom_baojia">
                    <img src="/static/home/images/r_img_01.png" alt="">
                    <div class="mt25">
                        <p class="fs-20 df ac">免费获取报价 <span class="hot">HOT</span></p>
                        <p class="mt10 mb10">30秒算一算搬家要花多少钱</p>
                        <p class="zixun-online getBaojia">立即获取</p>
                    </div>
                </div>
            </div>
            <div class="right-content df js fc">
                <?php foreach (array_slice($reasons, 3, 3) as $i => $reason): ?>
                <div class="list list-right df ac" data-list="<?= $i + 3 ?>">
                    <span class="ico fr">
                        <img src="<?= $reason['icon1'] ?? '' ?>" class="icon_img icon1" alt="">
                        <img src="<?= $reason['icon2'] ?? '' ?>" class="icon_img icon1_hover" alt="">
                    </span>
                    <div class="text text-left flex-1">
                        <h3 class="fs-16 mb10"><?= $reason['title'] ?? '' ?></h3>
                        <p class="c888 fs-13 line-h-1-7"><?= $reason['sketch'] ?? '' ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- 客户评价 -->
<section class="center clearfix" aria-labelledby="case-title">
    <div class="wow fadeInUp" data-wow-delay="0.1s">
        <div class="title-top clearfix mt45">
            <h2 id="case-title">客户评价 <span>Customer Evaluation</span></h2>
            <div class="right Customer">
                <ul id="index_case_tab">
                    <?php foreach ($caseTabs as $index => $tab): ?>
                    <li class="case-tab <?= $index === 0 ? 'active' : '' ?>"><?= $tab['name'] ?></li>
                    <?php endforeach; ?>
                    <li><a href="/cases.html">更多</a></li>
                </ul>
                <div class="border3"></div>
            </div>
        </div>
        <div class="evalu clearfix mt20 boxsh">
            <div class="evalu-1" id="index_case_tab_item">
                <?php foreach ($caseTabs as $tabIndex => $tab): ?>
                <div class="evalu-list">
                    <ul>
                        <?php foreach ($tab['list'] as $case): ?>
                        <li>
                            <div class="img-box">
                                <div class="img">
                                    <img class="lazy" data-original="<?= $case['image'] ?>" alt="<?= htmlspecialchars($case['title'], ENT_QUOTES, 'UTF-8') ?>服务案例" width="278" height="192">
                                </div>
                            </div>
                            <div class="text-box">
                                <p class="title-3"><a href="<?= $case['link'] ?: '/detail_cases' . $case['id'] . '.html' ?>" target="<?= $case['target'] ?? '_self' ?>"><?= $case['title'] ?></a></p>
                                <p class="infos"><?= $case['sketch'] ?? '' ?></p>
                                <p class="about-more"><a href="<?= $case['link'] ?: '/detail_cases' . $case['id'] . '.html' ?>" target="<?= $case['target'] ?? '_self' ?>" class="more-five">查看详情<span></span></a></p>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- 新闻资讯 -->
<section class="center clearfix" aria-labelledby="news-title">
    <div class="wow fadeInUp" data-wow-delay="0.1s">
        <div class="title-top clearfix mt30">
            <h2 id="news-title">新闻资讯 <span>News and Information</span></h2>
            <p class="more"><a href="/news.html">查看更多<span>›</span></a></p>
        </div>
        <div class="news-box flex flex-jcsb flex-wrap index-news-box fs-14">
            <?php foreach ($newsList as $news): ?>
            <div class="news-list pd20 boxsh flex ai-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="news-left-img">
                    <a href="<?= $news['link'] ?: '/detail/news' . $news['id'] . '.html' ?>" target="<?= $news['target'] ?? '_self' ?>">
                        <img class="lazy" data-original="<?= $news['image'] ?>" alt="<?= htmlspecialchars($news['title'], ENT_QUOTES, 'UTF-8') ?>" width="230" height="162" src="<?= $news['image'] ?>">
                    </a>
                </div>
                <div class="news-right-text">
                    <h3 class="ellipsis"><a href="<?= $news['link'] ?: '/detail/news' . $news['id'] . '.html' ?>" target="<?= $news['target'] ?? '_self' ?>"><?= $news['title'] ?></a></h3>
                    <p class="mt15 c888 line-h-1-7 wline3"><?= $news['sketch'] ?? '' ?></p>
                    <p class="over-hidden mt20">
                        <span class="c888 fl">更新时间：<?= !empty($news['create_time']) && ctype_digit((string) $news['create_time']) ? date('Y-m-d H:i:s', (int) $news['create_time']) : ($news['create_time'] ?? '') ?></span>
                        <a href="<?= $news['link'] ?: '/detail/news' . $news['id'] . '.html' ?>" target="<?= $news['target'] ?? '_self' ?>" class="danger-color fr">查看详情&gt;&gt;</a>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script src="<?= htmlspecialchars($assetUrl('/static/home/js/index.js'), ENT_QUOTES, 'UTF-8') ?>"></script>

<?php include VIEW_PATH . 'layout/footer.php'; ?>
