<?php
/**
 * 环境配置模板。
 * 复制为 app/config/site.php 后，填入数据库与后台账号配置；该文件不应提交到仓库。
 */

return [
    'app' => [
        'debug' => false,
        'default_timezone' => 'Asia/Shanghai',
        'site_name' => '广东众人搬家起重吊装有限公司',
        'site_url' => 'https://www.zrbanjia.com',
        'admin_path' => 'webadmini',
    ],
    'admin' => [
        'username' => 'admin',
        // 在命令行执行 password_hash('你的新密码', PASSWORD_DEFAULT) 后填入结果。
        'password_hash' => '',
    ],
    'geo_publish_api' => [
        'enabled' => filter_var(getenv('GEO_PUBLISH_API_ENABLED') ?: '0', FILTER_VALIDATE_BOOLEAN),
        // 仅配置令牌 SHA-256；原始令牌只保存在 GEO Content OS 的加密平台账号凭证中。
        'token_sha256' => getenv('GEO_PUBLISH_TOKEN_SHA256') ?: '',
        'max_body_bytes' => 1024 * 1024,
        'max_media_bytes' => 10 * 1024 * 1024,
        'media_upload_path' => __DIR__ . '/../../public/upload/',
        'target_nav_id' => (int)(getenv('GEO_PUBLISH_TARGET_NAV_ID') ?: 11),
        'site_url' => 'https://www.zrbanjia.com',
    ],
    // 百度普通收录 API。完整接口地址由百度搜索资源平台生成，含 Token，必须仅保存在服务器环境变量中。
    'baidu_push' => [
        'enabled' => filter_var(getenv('BAIDU_PUSH_ENABLED') ?: '0', FILTER_VALIDATE_BOOLEAN),
        'api_url' => getenv('BAIDU_PUSH_API_URL') ?: '',
        'timeout' => 5,
    ],
    'database' => [
        'type' => 'sqlite',
        'hostname' => '',
        'database' => __DIR__ . '/../../data/demo.sqlite',
        'username' => '',
        'password' => '',
        'hostport' => '',
        'charset' => 'utf8',
        'prefix' => 'zw_',
    ],
    'lang' => ['default' => 'zh-cn', 'list' => ['zh-cn', 'en-us']],
    'cache' => ['type' => 'file', 'path' => __DIR__ . '/../runtime/cache/', 'expire' => 3600],
    'email' => [
        'host' => 'smtp.example.com', 'port' => 465, 'username' => '', 'password' => '',
        'from' => '', 'from_name' => '众人搬家', 'char_set' => 'UTF-8', 'smtp_secure' => 'ssl',
    ],
    'captcha' => ['width' => 150, 'height' => 50, 'length' => 4, 'font_size' => 20],
    'upload' => [
        'path' => __DIR__ . '/../public/upload/', 'max_size' => 10 * 1024 * 1024,
        'ext' => 'jpg,jpeg,png,gif,bmp,webp,mp4,pdf,doc,docx,xls,xlsx,zip,rar',
    ],
    'city_domains' => [
        ['mark' => '广州', 'en_mark' => 'guangzhou', 'domain' => 'guangzhou.zrbanjia.com'],
        ['mark' => '东莞', 'en_mark' => 'dongguan', 'domain' => 'dongguan.zrbanjia.com'],
        ['mark' => '佛山', 'en_mark' => 'foshan', 'domain' => 'foshan.zrbanjia.com'],
        ['mark' => '肇庆', 'en_mark' => 'zhaoqing', 'domain' => 'zhaoqing.zrbanjia.com'],
        ['mark' => '江门', 'en_mark' => 'jiangmen', 'domain' => 'jiangmen.zrbanjia.com'],
    ],
    'service_cities' => [
        '广州' => '18148943200', '东莞' => '18148943200', '佛山' => '18148943200',
        '肇庆' => '18148943200', '江门' => '18148943200',
    ],
];
