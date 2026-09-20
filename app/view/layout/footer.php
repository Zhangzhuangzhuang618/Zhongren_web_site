</main>
<!-- 品牌横幅与服务展示，替换旧宣传图和规模数据 -->
<div class="brand-service-showcase">
    <a href="/products.html" aria-label="了解众人搬家四类服务">
        <img src="<?= htmlspecialchars($assetUrl('/upload/brand/zhongren-service-overview.jpg'), ENT_QUOTES, 'UTF-8') ?>" width="2172" height="724" loading="lazy" alt="众人搬家服务示意：居民搬家装车运输卸车、企业设备物资搬迁、高层吊装现场勘测与方案确认、打包收纳分类整理与包装防护">
    </a>
</div>
<style>
.brand-service-showcase{background:#faf8f4;padding:24px 0;}
.brand-service-showcase a{display:block;max-width:1440px;margin:0 auto;}
.brand-service-showcase a+a{margin-top:20px;}
.brand-service-showcase img{display:block;width:100%;height:auto;}
@media(max-width:600px){.brand-service-showcase{padding:12px 0;}.brand-service-showcase a+a{margin-top:12px;}}
</style>

<!-- 页脚 -->
<footer>
    <p class="center" style="padding:18px 0;line-height:1.8">众人搬家：公司统一接单、报价与派工，长期固定合作班组作业，与众人签约，售后由众人负责。<a href="/about/13.html#dispatch-assurance">查看签约与派工保障</a></p>
    <div class="n-footer wow fadeInUp">
        <div class="n-footer-top">
            <div class="clearfix center">
                <ul class="n-slide-nav">
                    <li class="active">热门城市</li>
                    <li>服务项目</li>
                </ul>
            </div>
            <div class="n-footer-con clearfix center">
                <div class="footer-slide">
                    <a href="https://tianhe.zrbanjia.com/">天河搬家</a>
                    <a href="https://haizhu.zrbanjia.com/">海珠搬家</a>
                    <a href="https://baiyun.zrbanjia.com/">白云搬家</a>
                    <a href="https://panyu.zrbanjia.com/">番禺搬家</a>
                    <a href="https://yuexiu.zrbanjia.com/">越秀搬家</a>
                    <a href="https://liwan.zrbanjia.com/">荔湾搬家</a>
                    <a href="https://huangpu.zrbanjia.com/">黄埔搬家</a>
                    <a href="https://huadu.zrbanjia.com/">花都搬家</a>
                    <a href="https://zengcheng.zrbanjia.com/">增城搬家</a>
                    <a href="https://nansha.zrbanjia.com/">南沙搬家</a>
                    <a href="https://conghua.zrbanjia.com/">从化搬家</a>
                </div>
                <div class="footer-slide">
                    <?php foreach ($footer_services as $service): ?>
                    <a href="<?= $service['link'] ?>" target="<?= $service['target'] ?? '_self' ?>"><?= $service['title'] ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="center platform-shop-entries">
        <section class="douyin-entry" aria-labelledby="douyin-title">
            <a href="/upload/brand/zhongren-douyin-qr.jpg" target="_blank" rel="noopener" aria-label="放大查看众人搬家抖音二维码">
                <img src="/upload/brand/zhongren-douyin-qr.jpg" width="1125" height="1680" loading="lazy" alt="广东众人搬家起重吊装有限公司抖音二维码，抖音号77488260985">
            </a>
            <div>
                <h2 id="douyin-title">关注众人搬家官方抖音</h2>
                <p>广东众人搬家起重吊装有限公司</p>
                <p>抖音号：77488260985</p>
                <p>打开抖音扫一扫，或保存二维码后在抖音中识别。</p>
                <a class="douyin-profile-link" href="https://v.douyin.com/hIRoU80ywdE/" target="_blank" rel="noopener">进入众人搬家抖音主页 →</a>
            </div>
        </section>
        <section class="douyin-entry shop-entry" aria-labelledby="taobao-shop-title">
            <a class="shop-qr taobao-shop-qr" href="/upload/brand/zhongren-taobao-shop-qr.jpg" target="_blank" rel="noopener" aria-label="放大查看淘宝店铺二维码原图">
                <img src="/upload/brand/zhongren-taobao-shop-qr.jpg" alt="淘宝广州众人搬家店铺二维码，使用淘宝扫一扫">
            </a>
            <div><h2 id="taobao-shop-title">淘宝店铺</h2><p>广州众人搬家</p><p>打开淘宝扫一扫，或搜索“广州众人搬家”。</p><a class="douyin-profile-link" href="/upload/brand/zhongren-taobao-shop-qr.jpg" target="_blank" rel="noopener">查看二维码原图 →</a></div>
        </section>
        <section class="douyin-entry shop-entry" aria-labelledby="jd-shop-title">
            <a class="shop-qr jd-shop-qr" href="/upload/brand/zhongren-jd-shop-qr.jpg" target="_blank" rel="noopener" aria-label="放大查看京东店铺二维码原图">
                <img src="/upload/brand/zhongren-jd-shop-qr.jpg" alt="京东众人搬家运输专营店二维码，使用京东扫一扫">
            </a>
            <div><h2 id="jd-shop-title">京东店铺</h2><p>众人搬家运输专营店</p><p>打开京东扫一扫，或搜索“众人搬家运输专营店”。</p><a class="douyin-profile-link" href="/upload/brand/zhongren-jd-shop-qr.jpg" target="_blank" rel="noopener">查看二维码原图 →</a></div>
        </section>
        </div>
        <style>
        .platform-shop-entries{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:24px;}
        .platform-shop-entries .douyin-entry{flex-direction:column;align-items:flex-start;gap:16px;min-width:0;}
        .platform-shop-entries .shop-qr{display:block;position:relative;overflow:hidden;width:180px;height:180px;background:#fff;flex-shrink:0;}
        .platform-shop-entries .shop-qr img{position:absolute;height:auto;max-width:none;}
        .platform-shop-entries .taobao-shop-qr img{width:601.5%;left:-72.5%;top:-710%;}
        .platform-shop-entries .jd-shop-qr img{width:203.2%;left:-51.6%;top:-152.7%;}
        @media(max-width:760px){.platform-shop-entries{grid-template-columns:1fr;}}
        .douyin-entry{display:flex;align-items:center;gap:28px;padding-top:24px;padding-bottom:24px;color:#ccc;border-top:1px solid #383838;}
        .douyin-entry img{display:block;width:160px;height:auto;max-width:none;}
        .douyin-entry h2{font-size:22px;color:#fff;margin-bottom:12px;}
        .douyin-entry p{line-height:1.9;}
        .douyin-entry .douyin-profile-link{display:inline-block;margin-top:12px;color:#fff;text-decoration:underline;}
        @media(max-width:600px){.douyin-entry{flex-direction:column;align-items:flex-start;gap:16px;}.douyin-entry img{width:180px;}}
        </style>
        <div class="n-footer-bottom center clearfix">
            <div class="n-footer-left">
                <ul class="n-footer-nav clearfix">
                    <?php foreach ($foot_nav as $item): ?>
                    <li><a href="<?= $item['href'] ?: '/' . $item['url_model'] . '/' . $item['id'] . '.html' ?>"><?= $item['title'] ?></a></li>
                    <?php endforeach; ?>
                    <li><a href="/faq.html">常见问题 FAQ</a></li>
                </ul>
                <address style="font-style:normal;line-height:1.9;color:#ccc;margin:16px 0">
                    <p>广东众人搬家起重吊装有限公司</p>
                    <p>注册地址：广州市天河区棠东东路7号101室</p>
                    <p>客户服务热线：<a href="tel:<?= htmlspecialchars(preg_replace('/\D+/', '', (string) ($site['phone2'] ?: '4008372383')), ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($site['phone2_text'] ?: '400-837-2383', ENT_QUOTES, 'UTF-8') ?></a></p>
                    <p>业务咨询：<a href="tel:<?= htmlspecialchars(preg_replace('/\D+/', '', (string) $site['phone']), ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($site['phone'], ENT_QUOTES, 'UTF-8') ?></a> · <a href="/contact/8.html">联系我们</a></p>
                </address>
                <p class="beian">Copyright &copy; 2025 <?= $site['name'] ?> 版权所有
                    <a target="_blank" href="http://beian.miit.gov.cn/"><?= $site['icp'] ?></a>
                </p>
            </div>
            <div class="n-footer-right">
                <div class="n-ewm">
                    <div><img class="lazy" data-original="<?= $site['wechat_code'] ?>" alt="" width="100%"><p>微信咨询</p></div>
                    <div><img class="lazy" data-original="<?= $site['wechat_code2'] ?: $site['wechat_code'] ?>" alt="" width="100%"><p>公众号</p></div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- 右侧悬浮 -->
<div class="rightFix">
    <ul>
        <li>
            <div class="img-box"></div><p>热线电话</p>
            <div class="text-box">
                <p><i>客户服务热线</i><span class="time">08:00 - 24:00</span><span class="tel"><a href="tel:<?= preg_replace('/\D+/', '', (string) $site['phone2']) ?>"><?= $site['phone2_text'] ?></a></span></p>
                <p><i>业务咨询手机</i><span class="time">08:00 - 22:00</span><span class="tel"><a href="tel:<?= preg_replace('/\D+/', '', (string) $site['phone']) ?>"><?= $site['phone'] ?></a></span></p>
            </div>
        </li>
        <li><a href="tel:<?= preg_replace('/\D+/', '', (string) $site['phone']) ?>"><div class="img-box"></div><p>在线咨询</p></a></li>
        <li class="wxkefu">
            <div class="img-box"></div><p>微信咨询</p>
            <div class="text-box">
                <p>扫一扫在线交谈</p>
                <p><img src="<?= $site['wechat_code'] ?>" alt="" width="100%"></p>
            </div>
        </li>
        <li class="getBaojia"><div class="img-box"></div><p>价格咨询</p></li>
    </ul>
    <div class="top"><span></span></div>
</div>

<!-- 底部固定导航（移动端） -->
<div class="app_foot_box"></div>
<div class="fixedBot">
    <a href="/index.html" class="fixed-link"><img src="/static/home/images/icon_home.png" alt=""><div class="fixed-title">官方首页</div></a>
    <a href="/products.html" class="fixed-link"><img src="/static/home/images/icon_product.png" alt=""><div class="fixed-title">产品中心</div></a>
    <a href="tel:<?= preg_replace('/\D+/', '', (string) $site['mobile']) ?>" class="fixed-link"><img src="/static/home/images/icon_tel2.png" alt=""><div class="fixed-title">电话咨询</div></a>
    <a href="javascript:;" class="fixed-link" onclick="goTop()"><img src="/static/home/images/icon_gotop2.png" alt=""><div class="fixed-title">返回顶部</div></a>
</div>

<!-- 报价弹窗 -->
<div class="popup-box">
    <div id="Popup">
        <button type="button" class="close-popup" aria-label="关闭报价弹窗"></button>
        <div class="container">
            <div class="box1">
                <div class="left-box">
                    <h1><span>日式搬家</span>价格估算</h1>
                    <p>本计算器仅用于半日式与日式精品搬家，按物品体积计费，不适用于普通搬家车型套餐。</p>
                    <p>日式搬家面包车、厢式货车含30公里，4.2米厢式货车含50公里。普通搬家380元、469元套餐含10公里，569元套餐含50公里。<a href="/pricing.html">查看普通搬家套餐与完整收费说明</a></p>
                    <div class="inside-box quote-calculator">
                        <div class="quote-layout">
                            <div class="quote-fields">
                            <div class="quote-tabs" role="tablist" aria-label="搬家服务类型">
                                <button type="button" class="is-active" data-quote-type="half" role="tab" aria-selected="true">半日式搬家</button>
                                <button type="button" data-quote-type="japanese" role="tab" aria-selected="false">日式精品搬家</button>
                            </div>
                            <div class="quote-grid">
                                <label class="quote-field">出发地
                                    <select id="quote-from" aria-label="出发地">
                                        <option value="天河区">天河区</option><option value="越秀区">越秀区</option><option value="海珠区">海珠区</option><option value="白云区">白云区</option><option value="番禺区">番禺区</option><option value="黄埔区">黄埔区</option><option value="广州市外">广州市外</option>
                                    </select>
                                </label>
                                <label class="quote-field">目的地
                                    <select id="quote-to" aria-label="目的地">
                                        <option value="天河区">天河区</option><option value="越秀区">越秀区</option><option value="海珠区">海珠区</option><option value="白云区">白云区</option><option value="番禺区">番禺区</option><option value="黄埔区">黄埔区</option><option value="广州市外">广州市外</option>
                                    </select>
                                </label>
                                <label class="quote-field">日式搬家用车（包含里程）
                                    <select id="quote-vehicle" aria-label="日式搬家用车（包含里程）">
                                        <option value="面包车" data-included-km="30">面包车（含 30 公里）</option><option value="厢式货车" data-included-km="30">厢式货车（含 30 公里）</option><option value="4.2米厢式货车" data-included-km="50">4.2 米厢式货车（含 50 公里）</option>
                                    </select>
                                </label>
                                <label class="quote-field">导航距离（公里）
                                    <input type="number" id="quote-distance" value="30" min="0" max="999" step="0.5" inputmode="decimal" aria-label="导航距离">
                                </label>
                            </div>
                            <label class="quote-field quote-volume">预估物品体积（立方米）
                                <input type="number" id="quote-volume" value="5" min="0" max="999" step="0.5" inputmode="decimal" aria-label="预估物品体积">
                            </label>
                            <fieldset class="quote-items"><legend>大件物品（可多选）</legend>
                                <label><input type="checkbox" class="quote-item" data-price="150">双开门冰箱</label><label><input type="checkbox" class="quote-item" data-price="200">嵌入式冰箱</label><label><input type="checkbox" class="quote-item" data-price="150">壁挂电视</label><label><input type="checkbox" class="quote-item" data-price="350">立式钢琴</label><label><input type="checkbox" class="quote-item" data-price="80">跑步机</label>
                            </fieldset>
                            </div>
                            <aside class="quote-summary" aria-label="报价结果与服务说明">
                                <div class="quote-result" aria-live="polite"><span id="quote-price-label">半日式搬家预估价</span><strong>¥<b id="quote-price">1400</b> 起</strong><em id="quote-breakdown">半日式 · 天河区→天河区 · 面包车 · 按 5 立方最低起算</em></div>
                                <div class="quote-service-note"><b id="quote-service-name">半日式搬家服务</b><p id="quote-service-description">包含旧家打包、包装材料与小家具拆装；大型家具或电器拆装另计。</p></div>
                                <a class="pianoBtn" href="tel:<?= preg_replace('/\D+/', '', (string) $site['phone']) ?>">一键拨号，获取准确报价</a>
                                <p class="warning" id="quote-warning">*半日式搬家 280 元/立方，最低按 5 立方起算；最终以客服确认的作业方案为准</p>
                            </aside>
                        </div>
                        <section class="quote-hot-cities" aria-labelledby="quote-hot-cities-title">
                            <h2 id="quote-hot-cities-title">热门服务城市</h2>
                            <div class="quote-city-list"><span>广州市</span><span>深圳市</span><span>珠海市</span><span>汕头市</span><span>佛山市</span><span>韶关市</span><span>湛江市</span><span>肇庆市</span><span>江门市</span><span>茂名市</span><span>惠州市</span><span>梅州市</span><span>汕尾市</span><span>河源市</span><span>阳江市</span><span>清远市</span><span>东莞市</span><span>中山市</span><span>潮州市</span><span>揭阳市</span><span>云浮市</span></div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="ajax-msg"><p class="content-msg"></p><div class="ewm"><img src="<?= $site['wechat_code'] ?>" alt="" width="100%"></div></div>
    </div>
</div>

<script>
function goTop(){ $("html,body").stop().animate({scrollTop: 0}, 1000); }
function updateQuoteCalculator(){
    var from = $('#quote-from').val();
    var to = $('#quote-to').val();
    var quoteType = $('.quote-tabs button.is-active').data('quote-type');
    var isJapanese = quoteType === 'japanese';
    var unitPrice = isJapanese ? 320 : 280;
    var minimumVolume = isJapanese ? 10 : 5;
    var volume = Math.max(0, Number($('#quote-volume').val()) || 0);
    var billedVolume = Math.max(minimumVolume, volume);
    var vehicle = $('#quote-vehicle option:selected');
    var includedKm = Number(vehicle.data('included-km'));
    var distance = Math.max(0, Number($('#quote-distance').val()) || 0);
    var mileageFee = Math.max(0, distance - includedKm) * 7;
    var itemFee = 0;
    $('.quote-item:checked').each(function(){ itemFee += Number($(this).data('price')); });
    var price = billedVolume * unitPrice + mileageFee + itemFee;
    var serviceName = isJapanese ? '日式精品搬家' : '半日式搬家';
    var extras = [];
    if (mileageFee) extras.push('超距¥' + mileageFee);
    if (itemFee) extras.push('大件¥' + itemFee);
    $('#quote-price').text(price);
    $('#quote-price-label').text(serviceName + '预估价');
    $('#quote-breakdown').text(serviceName + ' · ' + from + '→' + to + ' · ' + vehicle.val() + '（含 ' + includedKm + ' 公里）· 按 ' + billedVolume + ' 立方' + (volume < minimumVolume ? '最低起算' : '计费') + (extras.length ? ' · ' + extras.join(' · ') : ''));
    $('#quote-service-name').text(serviceName + '服务');
    $('#quote-service-description').text(isJapanese ? '包含旧家打包、包装材料、小家具拆装及新家还原；大型家具或电器拆装另计。' : '包含旧家打包、包装材料与小家具拆装；大型家具或电器拆装另计。');
    $('#quote-warning').text('*' + serviceName + ' ' + unitPrice + ' 元/立方，最低按 ' + minimumVolume + ' 立方起算；超出车型免费里程按 7 元/公里，大件按所选项目计费，最终以客服确认的作业方案为准');
}
</script>
<script>
$(function(){
    $('#quote-from, #quote-to, #quote-vehicle').on('change', updateQuoteCalculator);
    $('#quote-volume, #quote-distance').on('input', updateQuoteCalculator);
    $('.quote-item').on('change', updateQuoteCalculator);
    $('.quote-tabs button').on('click', function(){
        $('.quote-tabs button').removeClass('is-active').attr('aria-selected', 'false');
        $(this).addClass('is-active').attr('aria-selected', 'true');
        updateQuoteCalculator();
    });
    updateQuoteCalculator();
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var phonePattern = /(^|[^\d])(1[3-9]\d{9})(?!\d)/;
    var walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, {
        acceptNode: function (node) {
            var parent = node.parentElement;
            if (!parent || parent.closest('a, script, style, textarea, option, button')) {
                return NodeFilter.FILTER_REJECT;
            }
            return phonePattern.test(node.nodeValue) ? NodeFilter.FILTER_ACCEPT : NodeFilter.FILTER_REJECT;
        }
    });
    var nodes = [];
    while (walker.nextNode()) nodes.push(walker.currentNode);

    nodes.forEach(function (node) {
        var parts = node.nodeValue.split(/(^|[^\d])(1[3-9]\d{9})(?!\d)/);
        var fragment = document.createDocumentFragment();
        parts.forEach(function (part) {
            if (/^1[3-9]\d{9}$/.test(part)) {
                var link = document.createElement('a');
                link.href = 'tel:' + part;
                link.className = 'phone-link';
                link.textContent = part;
                fragment.appendChild(link);
            } else if (part) {
                fragment.appendChild(document.createTextNode(part));
            }
        });
        node.parentNode.replaceChild(fragment, node);
    });
});
</script>
<script src="<?= htmlspecialchars($assetUrl('/static/home/js/swiper.min.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
<script src="<?= htmlspecialchars($assetUrl('/static/home/js/s.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
<script src="<?= htmlspecialchars($assetUrl('/static/home/js/jquery.lazyload.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
<script src="<?= htmlspecialchars($assetUrl('/static/home/js/wow.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
<script src="<?= htmlspecialchars($assetUrl('/static/home/js/main.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
<script src="<?= htmlspecialchars($assetUrl('/static/home/js/header.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
<script src="<?= htmlspecialchars($assetUrl('/static/home/js/layer.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
<script src="<?= htmlspecialchars($assetUrl('/static/home/js/mediaelement-and-player.min.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
<script src="<?= htmlspecialchars($assetUrl('/static/home/js/acc_ch.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
</body>
</html>
