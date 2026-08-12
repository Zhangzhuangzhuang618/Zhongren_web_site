-- 002_photo_sketch.sql
-- 真实业务库 (demo.public.sqlite) 的 zw_cms_photo 缺少模型层查询使用的 sketch 列。
-- 部署时对 data/demo.sqlite 执行一次即可：
--   php -r '$db=new PDO("sqlite:data/demo.sqlite"); $db->exec("ALTER TABLE zw_cms_photo ADD COLUMN sketch TEXT DEFAULT \"\"");'
-- 或通过 sqlite3 CLI: ALTER TABLE zw_cms_photo ADD COLUMN sketch TEXT DEFAULT '';
ALTER TABLE zw_cms_photo ADD COLUMN sketch TEXT DEFAULT '';
