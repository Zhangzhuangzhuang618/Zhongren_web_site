<?php include VIEW_PATH . 'layout/header.php'; ?>
<link rel="stylesheet" href="<?= htmlspecialchars($assetUrl('/static/home/css/about.css'), ENT_QUOTES, 'UTF-8') ?>">

<div class="page-banner">
    <img src="<?= htmlspecialchars($assetUrl('/upload/20240510/bacfd59f43877ced86eca6d241385b84.jpg'), ENT_QUOTES, 'UTF-8') ?>" class="w100 block" alt="">
</div>

<div>
    <div class="about_nav_2">
        <ul class="center clearfix">
        </ul>
    </div>
</div>

<div>
    <div class="wow fadeInUp" data-wow-delay="0.1s">
        <div class="center">
            <div class="title-top clearfix mt45">
                <p>联系众人<span></span></p>
            </div>
        </div>
        <div class="about-container center mt20 border-radius fs-14 line-h-2">
            <div class="contact_main border_ef flex flex-jcsb ai-center flex-wrap radius10">
                <div class="txt map_box flex1">
                    <h4 class=" mx fadeInUp" data-wow-delay="0.1s" data-wow-duration=".8s"><?= $site['name'] ?></h4>
                    <h5 class="en mx fadeInUp" data-wow-delay="0.14s" data-wow-duration=".8s">Guangdong Renren Moving and Lifting Co., Ltd</h5>
                    <p class=" mx fadeInUp" data-wow-delay="0.22s" data-wow-duration=".8s">
                        <i class="icon"><img src="/static/home/images/icon-telephone2.png" alt=""></i>
                        <span>客户服务热线：<a href="tel:<?= preg_replace('/\D+/', '', (string) $site['phone2']) ?>"><?= $site['phone2_text'] ?></a></span>
                    </p>
                    <p class=" mx fadeInUp" data-wow-delay="0.26s" data-wow-duration=".8s">
                        <i class="icon"><img src="/static/home/images/icon_phone.png" alt=""></i>
                        <span>业务咨询手机：<a href="tel:<?= preg_replace('/\D+/', '', (string) $site['phone']) ?>"><?= $site['phone'] ?></a></span>
                    </p>
                    <p class=" mx fadeInUp" data-wow-delay="0.27s" data-wow-duration=".8s">
                        <span>以上均为本公司官方联系电话。</span>
                    </p>
                    <p class=" mx fadeInUp" data-wow-delay="0.28s" data-wow-duration=".8s">
                        <i class="icon"><img src="/static/home/images/icon_email.png" alt=""></i>
                        <span>企业邮箱：<?= $site['email'] ?></span>
                    </p>
                    <p class=" mx fadeInUp" data-wow-delay="0.28s" data-wow-duration=".8s">
                        <i class="icon"><img src="/static/home/images/icon_email.png" alt=""></i>
                        <span>传 真：</span>
                    </p>
                    <p class=" mx fadeInUp" data-wow-delay="0.3s" data-wow-duration=".8s">
                        <i class="icon"><img src="/static/home/images/icon_address34.png" alt=""></i>
                        <span>公司地址：<?= $site['address'] ?></span>
                    </p>
                </div>
                <div class="img ">
                    <img src="<?= htmlspecialchars($assetUrl('/upload/brand/zhongren-fleet-lineup.jpg'), ENT_QUOTES, 'UTF-8') ?>" class="block" alt="众人搬家车队与服务团队展示" width="1494" height="1052" style="width:100%;height:auto;object-fit:contain">
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="wow fadeInUp" data-wow-delay="0.1s">
        <div class="center">
            <div class="title-top clearfix mt45">
                <p>服务城市<span>Service City</span></p>
            </div>
        </div>
        <div class="hot-city-box pd25 bgfff clearfix center mt20">
            <div id="dot-box" class="dot-box mt40 masonry">
                <?php
                $cities = [
                    ['city' => '广州市', 'title' => $site['name'], 'addr' => $site['address'] . "\n客户服务热线：" . $site['phone2_text'] . "\n业务咨询手机：" . $site['phone']],
                ];
                foreach ($cities as $city):
                ?>
                <div class="dot-list masonry-brick" data-city="<?= $city['city'] ?>" data-title="<?= $city['title'] ?>">
                    <h3><?= $city['title'] ?></h3>
                    <div class="text-box"><?= $city['addr'] ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php include VIEW_PATH . 'layout/footer.php'; ?>
