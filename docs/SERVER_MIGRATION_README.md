# 众人官网服务器迁移说明

生成时间：2026-08-12（Asia/Shanghai）
数据来源：https://www.zrbanjia.com

## 已提交内容

- `data/demo.public.sqlite`：可公开提交的脱敏业务数据库。
- `scripts/import_zrbanjia_content.php`：可重复运行的线上内容导入脚本。
- `docs/migrations/zrbanjia-content-import-20260811-171129.json`：最终完整导入日志。
- `public/upload/`、`public/ueditor/`：文章、案例和服务使用的本地媒体文件。

脱敏数据库包含 188 篇文章、25 个案例和 20 个服务。客户留言已清空，密码、令牌、对象存储、短信、邮件和小程序等敏感配置值已清空。

## 服务器部署

```bash
cp data/demo.public.sqlite data/demo.sqlite
cp app/config/site.example.php app/config/site.php
composer install --no-dev --optimize-autoloader
```

随后在服务器填写 `app/config/site.php` 中的后台密码哈希及必要接口配置，确保 PHP 对 `data/` 和 `runtime/` 具有读写权限，并清空 `runtime/cache/`。

## 重新抓取线上内容

```bash
php scripts/import_zrbanjia_content.php
```

脚本以线上内容 ID 更新或新增记录，不会重复插入同一条内容，并会把正文图片同步到本地。

## 校验结果

- SQLite 完整性检查：`ok`
- 本次线上同步：183 篇可见文章、25 个案例、19 个线上服务
- 本次检查的 227 条同步记录：缺失本地图片 0，外链图片 0
- 线上列表未发现的原有文章 ID `1、2、4、9、50` 已保留

原始业务数据库和本地迁移备份不会提交到公开仓库。
