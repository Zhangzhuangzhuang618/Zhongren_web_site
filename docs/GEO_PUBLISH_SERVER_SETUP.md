# 众人官网 GEO 发布接口线上服务器设置说明

适用域名：`https://www.zrbanjia.com`

接口基地址：`https://www.zrbanjia.com/api/geo/v1/`

本文按当前线上环境编写：Nginx、PHP 7.4、SQLite，项目目录假定为
`/var/www/zhongren_guanwang`。如果服务器实际目录不同，请把下文路径替换为真实路径。

## 1. 更新代码并确认版本

```bash
cd /var/www/zhongren_guanwang
git pull --ff-only origin main
git rev-parse --short HEAD
```

代码至少需要包含以下文件：

```text
app/controller/GeoPublishApi.php
app/service/GeoNewsPublisher.php
database/migrations/001_geo_publish_api.sql
scripts/migrate-geo-publish.php
```

## 2. 确认正式数据库路径

```bash
cd /var/www/zhongren_guanwang
php -r '$c=require "app/config/site.php"; echo $c["database"]["database"], PHP_EOL;'
```

如果输出为相对路径或其他路径，后续备份和迁移命令必须使用该真实数据库文件，不能直接套用示例路径。

下文假定数据库为：

```text
/var/www/zhongren_guanwang/data/demo.sqlite
```

## 3. 备份数据库和服务器配置

```bash
sudo install -d -m 700 /var/backups/zhongren
sudo cp -a /var/www/zhongren_guanwang/data/demo.sqlite /var/backups/zhongren/demo.sqlite.before-geo
sudo cp -a /var/www/zhongren_guanwang/app/config/site.php /var/backups/zhongren/site.php.before-geo
```

确认备份存在：

```bash
sudo ls -lh /var/backups/zhongren/demo.sqlite.before-geo /var/backups/zhongren/site.php.before-geo
```

## 4. 执行数据库迁移

```bash
cd /var/www/zhongren_guanwang
php scripts/migrate-geo-publish.php /var/www/zhongren_guanwang/data/demo.sqlite
```

正常输出：

```text
GEO publish API migration completed.
```

该迁移可重复执行。它会创建：

- `zw_geo_publish_receipts`：保存幂等键、文章 ID、URL 和固定发布响应；
- `zw_cms_article_id_uq`：防止文章 ID 重复。

可选核对：

```bash
sqlite3 /var/www/zhongren_guanwang/data/demo.sqlite \
  "SELECT name FROM sqlite_master WHERE name IN ('zw_geo_publish_receipts','zw_cms_article_id_uq');"
```

应返回以上两个名称。

## 5. 核对发布栏目

默认发布栏目 ID 是 `11`。执行：

```bash
sqlite3 /var/www/zhongren_guanwang/data/demo.sqlite \
  "SELECT id,title,url_model,status FROM zw_cms_nav WHERE id=11;"
```

必须满足：

- 能查询到该栏目；
- `url_model` 为 `news`；
- `status` 为 `1`。

如果正式站的新闻栏目不是 11，记录真实 ID，并在第 7 步配置为真实值。

## 6. 生成专用 Bearer Token

不要使用网站后台密码。生成一个仅供 GEO 发布接口使用的高熵令牌：

```bash
sudo sh -c 'umask 077; openssl rand -base64 48 | tr -d "\n" > /root/zhongren-geo-token.txt'
sudo sh -c 'sha256sum /root/zhongren-geo-token.txt | awk "{print \$1}" > /root/zhongren-geo-token.sha256'
```

查看令牌摘要：

```bash
sudo cat /root/zhongren-geo-token.sha256
```

处理规则：

- 原始令牌位于 `/root/zhongren-geo-token.txt`，只录入 GEO Content OS 的加密凭证；
- 官网服务器只配置 SHA-256 摘要；
- 不要把原始令牌写入 Git、`site.php`、Nginx 配置、操作日志或截图；
- 原始令牌交付并验证后，应从服务器移除临时文件。

## 7. 配置 PHP-FPM 环境变量

线上响应显示 PHP 7.4，Debian/Ubuntu 的常见配置文件为：

```text
/etc/php/7.4/fpm/pool.d/www.conf
```

先确认实际 PHP-FPM 服务和配置目录：

```bash
systemctl list-units --type=service | grep php | grep fpm
sudo grep -R "^listen" /etc/php/7.4/fpm/pool.d /etc/php-fpm.d 2>/dev/null
```

编辑实际使用的 FPM 池配置，在 `[www]` 段增加：

```ini
env[GEO_PUBLISH_API_ENABLED] = 1
env[GEO_PUBLISH_TOKEN_SHA256] = 这里填写第6步生成的64位小写摘要
env[GEO_PUBLISH_TARGET_NAV_ID] = 11
```

如果第 5 步确认的新闻栏目不是 11，必须替换为真实栏目 ID。

不要在这里填写原始 Bearer Token，只填写 SHA-256 摘要。

## 8. 核对 Nginx 配置

站点 `server` 块至少应包含：

```nginx
server {
    server_name www.zrbanjia.com zrbanjia.com;
    root /var/www/zhongren_guanwang/public;
    index index.php index.html;

    client_max_body_size 11m;

    location / {
        if (!-e $request_filename) {
            rewrite ^/(.*)$ /index.php?/$1 last;
            break;
        }
    }

    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param HTTP_AUTHORIZATION $http_authorization;
        include fastcgi_params;
    }
}
```

重点核对：

- `root` 必须指向项目的 `public` 目录；
- 必须转发 `HTTP_AUTHORIZATION`，否则 PHP 收不到 Bearer Token；
- `client_max_body_size` 至少为 `11m`，否则接近 10 MB 的媒体文件会被 Nginx 提前拒绝；
- 正式接口只允许通过 HTTPS 对外访问。

如果服务器的 PHP-FPM 使用 Unix Socket，保留服务器原有的 `fastcgi_pass`，不要强行改成 `127.0.0.1:9000`。

## 9. 设置写入权限

以下命令假定 PHP-FPM 用户为 `www-data`。先核对实际用户：

```bash
grep -E '^(user|group)\s*=' /etc/php/7.4/fpm/pool.d/www.conf
```

如果确实是 `www-data`，执行：

```bash
sudo chown www-data:www-data /var/www/zhongren_guanwang/data/demo.sqlite
sudo chmod 660 /var/www/zhongren_guanwang/data/demo.sqlite
sudo chown www-data:www-data /var/www/zhongren_guanwang/data
sudo chmod 750 /var/www/zhongren_guanwang/data
sudo install -d -o www-data -g www-data -m 750 /var/www/zhongren_guanwang/public/upload/geo
```

SQLite 写入日志文件时需要数据库所在目录也可写，因此不能只修改 `demo.sqlite` 文件权限。

## 10. 检查配置并重启服务

```bash
sudo nginx -t
sudo systemctl restart php7.4-fpm
sudo systemctl reload nginx
```

如果实际服务名不是 `php7.4-fpm`，使用第 7 步查询到的服务名。

## 11. 验证接口已启用

### 11.1 无令牌验证

```bash
curl -i https://www.zrbanjia.com/api/geo/v1/capabilities
```

预期为 HTTP 401，并包含：

```json
{"error":{"code":"AUTH_REQUIRED","message":"Bearer token is required."}}
```

如果仍然返回 `GEO publish API is disabled.`，说明 PHP-FPM 没有读取到
`GEO_PUBLISH_API_ENABLED=1`。优先检查是否编辑了错误的 FPM 池配置，随后重启 PHP-FPM。

### 11.2 携带专用令牌验证

为了避免把令牌直接写进 Shell 历史，从受限文件读取：

```bash
sudo sh -c 'TOKEN=$(cat /root/zhongren-geo-token.txt); curl -sS -H "Authorization: Bearer $TOKEN" -H "Accept: application/json" https://www.zrbanjia.com/api/geo/v1/capabilities'
```

必须准确返回：

```json
{"publish":true,"get_status":true,"media_upload":true,"metrics":false}
```

以下结果表示配置不正确：

- `AUTH_INVALID`：服务器配置的摘要与调用令牌不匹配；
- `AUTH_REQUIRED`：Authorization 头没有传给 PHP，或接口仍未启用；
- HTTP 404：线上代码、入口重写或站点 `root` 不正确；
- HTTP 413：Nginx 的请求体限制没有调整。

## 12. 配置 GEO Content OS

在 GEO Content OS 的官网平台账号中填写：

```text
Base URL: https://www.zrbanjia.com/api/geo/v1/
Bearer Token: 第6步生成的原始令牌
```

不要填写后台登录密码，也不要填写令牌的 SHA-256。调用端需要的是原始令牌，官网服务器保存的是摘要。

首次正式发布前，建议先用一篇明确标注为测试的文章完成以下闭环：

1. `POST /media` 返回图片 URL；
2. `POST /publish` 返回 HTTP 201；
3. 返回体包含 `external_id`、`status`、`published_at`、`url`；
4. 再用相同 `Idempotency-Key` 重放，返回 HTTP 200 且没有新增第二篇文章；
5. `GET /status/{external_id}` 返回与首次发布相同的结果；
6. 打开返回的文章 URL，确认正文和图片正常。

## 13. 清理临时令牌文件

确认 GEO Content OS 已安全保存原始令牌、接口联调成功后，再执行：

```bash
sudo shred -u /root/zhongren-geo-token.txt /root/zhongren-geo-token.sha256
```

如果服务器文件系统不支持可靠覆盖，可改为删除文件，并确认令牌只保留在 GEO Content OS 的加密凭证中。

## 14. 紧急停用和回滚

需要立即停止发布时，把 PHP-FPM 池配置改为：

```ini
env[GEO_PUBLISH_API_ENABLED] = 0
```

然后执行：

```bash
sudo systemctl restart php7.4-fpm
```

再次请求 `capabilities`，确认返回 `GEO publish API is disabled.`。

不要删除 `zw_geo_publish_receipts` 表。该表保存已处理请求的幂等事实，删除后旧请求重放可能重复创建文章。

## 最终检查表

- [ ] 线上代码已包含 GEO API 控制器、服务、路由和迁移脚本
- [ ] 正式 SQLite 数据库与 `site.php` 已备份
- [ ] 数据库迁移执行成功
- [ ] 发布栏目存在，`url_model=news` 且 `status=1`
- [ ] 使用独立高熵 Bearer Token，不使用后台密码
- [ ] 官网仅配置 Token SHA-256，GEO Content OS 保存原始 Token
- [ ] PHP-FPM 中 `GEO_PUBLISH_API_ENABLED=1`
- [ ] Nginx 转发 `HTTP_AUTHORIZATION`
- [ ] Nginx 设置 `client_max_body_size 11m`
- [ ] PHP-FPM 对 SQLite 目录和 `public/upload/geo/` 有写权限
- [ ] `nginx -t` 通过，PHP-FPM 已重启，Nginx 已重载
- [ ] 带令牌的 `capabilities` 返回四个准确能力字段
- [ ] 媒体上传、首次发布、幂等重放、状态查询均完成验证
- [ ] 原始令牌未进入 Git、配置文件、日志或截图

