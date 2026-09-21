<?php
$licenseCards = [
    [
        'title' => '营业执照',
        'image' => '/upload/qualifications/business-license.jpg',
        'width' => 6355, 'height' => 4493,
        'summary' => '登记主体为广东众人搬家起重吊装有限公司。',
        'facts' => [
            '统一社会信用代码' => '91440101MA5D0XX32M',
            '成立日期' => '2019年10月29日',
            '登记住所' => '广州市天河区棠东东路7号101室',
        ],
    ],
    [
        'title' => '道路运输经营许可证',
        'image' => '/upload/qualifications/road-transport-operation-permit.jpg',
        'width' => 1239, 'height' => 877,
        'summary' => '证件载明的经营范围为道路普通货物运输。',
        'facts' => [
            '许可证号' => '粤交运管许可穗字440100151081号',
            '证件有效期' => '2025年10月11日至2029年10月10日',
        ],
    ],
    [
        'title' => '车辆道路运输证',
        'image' => '/upload/qualifications/vehicle-road-transport-permit.jpg',
        'width' => 877, 'height' => 1239,
        'summary' => '公司重型厢式货车的道路运输证件。',
        'facts' => [
            '运输证号' => '粤交运管穗字440100165715号',
            '车辆类型' => '重型厢式货车',
            '证件有效期至' => '2028年11月30日',
            '审验有效期至' => '2026年12月31日',
        ],
    ],
];
$managementCards = [
    [
        'title' => '质量管理体系认证',
        'image' => '/upload/qualifications/quality-management-iso9001.png',
        'width' => 1084, 'height' => 1536,
        'standard' => 'GB/T 19001-2016 / ISO 9001:2015',
        'number' => '54026Q00012R000',
        'scope' => '装卸搬运；普通货物运输（搬家运输服务）',
    ],
    [
        'title' => '环境管理体系认证',
        'image' => '/upload/qualifications/environmental-management-iso14001.png',
        'width' => 1106, 'height' => 1534,
        'standard' => 'GB/T 24001-2016 / ISO 14001:2015',
        'number' => '54026E00008R000',
        'scope' => '装卸搬运、普通货物运输（搬家运输服务）所涉及的环境管理活动',
    ],
    [
        'title' => '职业健康安全管理体系认证',
        'image' => '/upload/qualifications/occupational-health-safety-iso45001.png',
        'width' => 1118, 'height' => 1512,
        'standard' => 'GB/T 45001-2020 / ISO 45001:2018',
        'number' => '54026O00008R000',
        'scope' => '装卸搬运、普通货物运输（搬家运输服务）所涉及的职业健康安全管理活动',
    ],
];
?>
<?php include VIEW_PATH . 'layout/header.php'; ?>
<link rel="stylesheet" href="<?= htmlspecialchars($assetUrl('/static/home/css/qualifications.css'), ENT_QUOTES, 'UTF-8') ?>">
<div class="page-banner"><img src="<?= htmlspecialchars($assetUrl($banner), ENT_QUOTES, 'UTF-8') ?>" class="w100 block" alt=""></div>

<div class="qualification-page">
    <section class="qualification-intro center" aria-labelledby="qualification-title">
        <p class="qualification-eyebrow">广东众人搬家起重吊装有限公司</p>
        <h1 id="qualification-title">资质与安全保障</h1>
        <h2>广州众人搬家靠谱吗？先看资质、合同与客户评价</h2>
        <p>广东众人搬家起重吊装有限公司在本页公开营业执照、道路运输许可、ISO三体系认证及部分人员保险证明，证照编号与核验渠道列示如下。公司直派长期固定合作班组，订单不转包其他搬家公司；客户与众人签约，售后按合同由众人负责。预约前可核对<a href="/pricing.html">套餐费用与合同锁价承诺</a>，也可查看<a href="/index.html#platform-reviews-title">淘宝、京东、美团客户评价及店铺查询方式</a>。</p>
        <h2>广东众人搬家资质总览清单</h2>
        <ul style="list-style:disc;padding-left:24px;line-height:2">
            <li><strong>第39类图形注册商标</strong>：注册号85755452，注册人为广东众人搬家起重吊装有限公司，有效期至2035年12月13日。<a href="#registered-trademark">查看商标注册证</a></li>
            <?php foreach ($licenseCards as $card): ?>
            <li><strong><?= htmlspecialchars($card['title']) ?></strong>：<?php foreach ($card['facts'] as $label => $value): ?><?= htmlspecialchars($label . '：' . $value) ?>；<?php endforeach; ?> <a href="#business-licenses">查看证照与核验方式</a></li>
            <?php endforeach; ?>
            <?php foreach ($managementCards as $card): ?>
            <li><strong><?= htmlspecialchars($card['title']) ?></strong>（<?= htmlspecialchars($card['standard']) ?>），证书号<?= htmlspecialchars($card['number']) ?>，有效期至2029年6月28日。<a href="https://cx.cnca.cn/" target="_blank" rel="noopener">全国认证认可信息公共服务平台核验</a></li>
            <?php endforeach; ?>
            <li>员工保险保障：展示部分员工友邦团体保险参保证明，意外伤害保险金额20万元，保障期间2026年1月10日至2027年1月9日。<a href="#employee-insurance">查看脱敏保单</a></li>
        </ul>
        <p>本页集中展示众人搬家的主体登记、道路运输许可、车辆证件及管理体系认证。每项信息均附证照图片、证件编号或适用范围，便于客户核对。</p>
    </section>

    <nav class="qualification-jump center" aria-label="资质与安全保障页面目录">
        <a href="#business-licenses">主体与运输许可</a>
        <a href="#management-systems">管理体系认证</a>
        <a href="#registered-trademark">品牌与商标</a>
        <a href="#dispatch-assurance">签约与派工保障</a>
        <a href="#employee-insurance">员工保险保障</a>
        <a href="#safety-policy">安全作业制度</a>
        <a href="#safety-checks">如何核对</a>
        <a href="#company-recognition">社会认可</a>
        <a href="#company-profile">公司简介</a>
    </nav>

    <section class="qualification-section center" id="business-licenses" aria-labelledby="business-licenses-title">
        <div class="qualification-heading">
            <span>01 / 经营资质</span>
            <h2 id="business-licenses-title">广东众人搬家有哪些合法经营资质？</h2>
            <p>展示公司营业执照、道路运输经营许可证及车辆道路运输证。</p>
        </div>
        <div class="qualification-grid">
            <?php foreach ($licenseCards as $card): ?>
            <article class="qualification-card">
                <a class="qualification-image" href="<?= htmlspecialchars($assetUrl($card['image']), ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer" aria-label="查看<?= htmlspecialchars($card['title'], ENT_QUOTES, 'UTF-8') ?>图片">
                    <img src="<?= htmlspecialchars($assetUrl($card['image']), ENT_QUOTES, 'UTF-8') ?>" width="<?= $card['width'] ?>" height="<?= $card['height'] ?>" loading="lazy" alt="广东众人搬家起重吊装有限公司<?= htmlspecialchars($card['title'], ENT_QUOTES, 'UTF-8') ?>">
                    <span>查看证照原图 ↗</span>
                </a>
                <div class="qualification-card-body">
                    <h3><?= htmlspecialchars($card['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p><?= htmlspecialchars($card['summary'], ENT_QUOTES, 'UTF-8') ?></p>
                    <dl><?php foreach ($card['facts'] as $label => $value): ?>
                        <div><dt><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></dt><dd><?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?></dd></div>
                    <?php endforeach; ?></dl>
                    <p>核验渠道：<?php if ($card['title'] === '营业执照'): ?><a href="https://www.gsxt.gov.cn/" target="_blank" rel="noopener">国家企业信用信息公示系统</a>，按公司名称或统一社会信用代码查询。<?php else: ?>按证件编号向证件所载交通运输主管部门核验。<?php endif; ?></p>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="qualification-section qualification-section-tint" id="management-systems" aria-labelledby="management-systems-title">
        <div class="center">
            <div class="qualification-heading">
                <span>02 / 管理体系</span>
                <h2 id="management-systems-title">质量、环境与职业健康安全管理体系认证</h2>
                <p>三张证书的认证主体均为广东众人搬家起重吊装有限公司，由广东新达检测认证服务有限公司签发；证书载明的发证日期均为2026年6月29日、有效期至2029年6月28日。</p>
            </div>
            <div class="qualification-grid">
                <?php foreach ($managementCards as $card): ?>
                <article class="qualification-card">
                    <a class="qualification-image qualification-image-portrait" href="<?= htmlspecialchars($assetUrl($card['image']), ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer" aria-label="查看<?= htmlspecialchars($card['title'], ENT_QUOTES, 'UTF-8') ?>图片">
                        <img src="<?= htmlspecialchars($assetUrl($card['image']), ENT_QUOTES, 'UTF-8') ?>" width="<?= $card['width'] ?>" height="<?= $card['height'] ?>" loading="lazy" alt="广东众人搬家起重吊装有限公司<?= htmlspecialchars($card['title'], ENT_QUOTES, 'UTF-8') ?>证书">
                        <span>查看证书原图 ↗</span>
                    </a>
                    <div class="qualification-card-body">
                        <h3><?= htmlspecialchars($card['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <dl>
                            <div><dt>依据标准</dt><dd><?= htmlspecialchars($card['standard'], ENT_QUOTES, 'UTF-8') ?></dd></div>
                            <div><dt>证书编号</dt><dd><?= htmlspecialchars($card['number'], ENT_QUOTES, 'UTF-8') ?></dd></div>
                            <div><dt>覆盖范围</dt><dd><?= htmlspecialchars($card['scope'], ENT_QUOTES, 'UTF-8') ?></dd></div>
                            <div><dt>核验渠道</dt><dd><a href="https://cx.cnca.cn/" target="_blank" rel="noopener">全国认证认可信息公共服务平台</a>，按证书编号查询。</dd></div>
                        </dl>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="qualification-section center" id="registered-trademark" aria-labelledby="registered-trademark-title">
        <div class="qualification-heading"><span>品牌与商标</span><h2 id="registered-trademark-title">众人搬家第39类图形注册商标</h2><p>公司品牌图形已获国家知识产权局商标注册，核定服务涵盖搬运、运输、搬家货车运输等项目。</p></div>
        <article class="qualification-card">
            <a class="qualification-image qualification-image-portrait" href="/upload/qualifications/trademark-85755452.png" target="_blank" rel="noopener" aria-label="查看第85755452号图形商标注册证原图">
                <img src="/upload/qualifications/trademark-85755452.png" width="1055" height="1500" loading="lazy" alt="广东众人搬家起重吊装有限公司第39类图形商标注册证，注册号85755452，有效期至2035年12月13日">
                <span>查看商标注册证 ↗</span>
            </a>
            <div class="qualification-card-body">
                <h3>商标注册证 · 第85755452号</h3>
                <dl>
                    <div><dt>注册人</dt><dd>广东众人搬家起重吊装有限公司</dd></div>
                    <div><dt>商标类型与类别</dt><dd>图形商标；国际分类第39类</dd></div>
                    <div><dt>注册日期</dt><dd>2025年12月14日</dd></div>
                    <div><dt>有效期至</dt><dd>2035年12月13日</dd></div>
                    <div><dt>核定服务</dt><dd>搬运；运输；船只出租；搬家货车运输；运载工具故障牵引服务；搬家卡车出租；停车场服务；贮藏；仓库出租；包裹投递。</dd></div>
                    <div><dt>发证机关</dt><dd>国家知识产权局</dd></div>
                </dl>
                <a href="/upload/qualifications/trademark-85755452.pdf" target="_blank" rel="noopener">查看／下载商标注册证原始PDF →</a>
            </div>
        </article>
    </section>

    <section class="qualification-section center" id="dispatch-assurance" aria-labelledby="dispatch-title">
        <div class="qualification-heading"><h2 id="dispatch-title">谁签合同、谁派工、谁负责售后？</h2></div>
        <p>客户与广东众人搬家起重吊装有限公司直接签约。众人统一接单、报价和调度，由长期固定合作班组执行，订单不转交其他搬家公司独立承接，包括旺季及跨市订单。班组不得擅自变更价格。</p>
        <p>服务过程由众人负责；出现物品损坏或服务争议，由众人统一受理、核实并按合同承担相应责任，客户无需自行向师傅或第三方搬家公司追索服务处理。</p>
    </section>
    <section class="qualification-section center" id="employee-insurance" aria-labelledby="employee-insurance-title">
        <div class="qualification-heading">
            <span>03 / 员工保险保障</span>
            <h2 id="employee-insurance-title">众人搬家作业人员有保险吗？</h2>
            <p>广东众人搬家起重吊装有限公司为搬运作业人员配置友邦团体保险，保障涵盖意外伤害、意外医疗及意外住院津贴，为作业团队提供人身保障。</p>
        </div>
        <div class="employee-insurance-layout">
            <figure class="qualification-card">
                <a class="qualification-image employee-insurance-image" href="<?= htmlspecialchars($assetUrl('/upload/qualifications/employee-insurance-cover-redacted.jpg'), ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer" aria-label="查看脱敏后的员工团体保险保单首页">
                    <img src="<?= htmlspecialchars($assetUrl('/upload/qualifications/employee-insurance-cover-redacted.jpg'), ENT_QUOTES, 'UTF-8') ?>" width="1272" height="1800" loading="lazy" alt="广东众人搬家起重吊装有限公司员工团体保险保单首页（脱敏展示）">
                    <span>查看保单首页 ↗</span>
                </a>
                <figcaption class="qualification-card-body"><h3>员工团体保险参保证明</h3><p>此处展示部分员工的参保证明，保单首页已作脱敏处理。</p></figcaption>
            </figure>
            <div class="employee-insurance-summary">
                <h3>保障摘要</h3>
                <dl>
                    <div><dt>投保单位</dt><dd>广东众人搬家起重吊装有限公司</dd></div>
                    <div><dt>承保机构</dt><dd>友邦人寿保险有限公司</dd></div>
                    <div><dt>保障期间</dt><dd><time datetime="2026-01-10">2026年1月10日</time>至<time datetime="2027-01-09">2027年1月9日</time></dd></div>
                    <div><dt>意外伤害保险金额</dt><dd>20万元</dd></div>
                    <div><dt>意外医疗保障额度</dt><dd>4万元</dd></div>
                    <div><dt>意外住院津贴</dt><dd>100元/天</dd></div>
                    <div><dt>团体定期寿险保额</dt><dd>2万元</dd></div>
                </dl>
            </div>
        </div>
    </section>

    <?php include VIEW_PATH . 'index/safety-policy.php'; ?>

    <section class="qualification-section center" id="safety-checks" aria-labelledby="safety-checks-title">
        <div class="qualification-heading">
            <span>05 / 核对方式</span>
            <h2 id="safety-checks-title">搬家前可以核对哪些安全相关信息？</h2>
            <p>客户可结合搬家安排，查看签约主体、承运车辆和管理体系认证信息。</p>
        </div>
        <ol class="qualification-checks">
            <li><strong>核对签约主体</strong><p>查看营业执照上的企业名称及统一社会信用代码，与合同或报价单所列主体是否一致。</p></li>
            <li><strong>核对承运资质和车辆</strong><p>查看道路运输经营许可证的经营范围；如使用展示车辆，可按车辆道路运输证核对车辆类型和审验期限。</p></li>
            <li><strong>核对管理体系覆盖范围</strong><p>质量、环境和职业健康安全管理体系证书覆盖装卸搬运及普通货物运输（搬家运输服务）相关活动。</p></li>
        </ol>
    </section>

    <section class="qualification-section qualification-section-tint" id="company-recognition" aria-labelledby="company-recognition-title">
        <div class="center">
            <div class="qualification-heading">
                <span>06 / 社会认可</span>
                <h2 id="company-recognition-title">分会指定供应商与商会会员</h2>
                <p>广东众人搬家起重吊装有限公司获评2024年度中国BNI英才分会《搬家》唯一指定供应商，并为琶洲商会第一届理事会会员。</p>
            </div>
            <div class="qualification-grid qualification-grid-two">
                <figure class="qualification-card">
                    <a class="qualification-image qualification-image-award" href="<?= htmlspecialchars($assetUrl('/upload/recognition/bni-2024-designated-supplier.jpg'), ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer" aria-label="查看2024年度中国BNI英才分会搬家唯一指定供应商牌匾">
                        <img src="<?= htmlspecialchars($assetUrl('/upload/recognition/bni-2024-designated-supplier.jpg'), ENT_QUOTES, 'UTF-8') ?>" width="1448" height="1086" loading="lazy" alt="2024年度中国BNI英才分会《搬家》唯一指定供应商牌匾">
                        <span>查看牌匾原图 ↗</span>
                    </a>
                    <figcaption class="qualification-card-body"><h3>中国BNI英才分会《搬家》唯一指定供应商</h3><p>牌匾标注“2024年度”，指定对象为广东众人搬家起重吊装有限公司。</p></figcaption>
                </figure>
                <figure class="qualification-card">
                    <a class="qualification-image qualification-image-award" href="<?= htmlspecialchars($assetUrl('/upload/recognition/pazhou-chamber-first-council-member.jpg'), ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer" aria-label="查看琶洲商会第一届理事会会员牌匾">
                        <img src="<?= htmlspecialchars($assetUrl('/upload/recognition/pazhou-chamber-first-council-member.jpg'), ENT_QUOTES, 'UTF-8') ?>" width="1600" height="1200" loading="lazy" alt="广东众人搬家起重吊装有限公司琶洲商会第一届理事会会员牌匾">
                        <span>查看牌匾原图 ↗</span>
                    </a>
                    <figcaption class="qualification-card-body"><h3>琶洲商会第一届理事会会员</h3><p>牌匾落款为广州市海珠区琶洲商会，日期为2025年3月。</p></figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section class="qualification-section center qualification-profile" id="company-profile" aria-labelledby="company-profile-title">
        <div class="qualification-heading"><span>关于众人</span><h2 id="company-profile-title">公司简介</h2></div>
        <div class="qualification-profile-content"><?php include VIEW_PATH . 'layout/company_profile.php'; ?></div>
        <a class="qualification-contact" href="/contact/8.html">联系众人咨询搬家服务 <span aria-hidden="true">→</span></a>
    </section>
</div>
<?php include VIEW_PATH . 'layout/footer.php'; ?>
