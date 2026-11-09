-- Apply to the active Zhongren SQLite database after taking a backup.
-- Only update the specific service and shared text entries that contain the old copy.
BEGIN;
UPDATE zw_cms_product
SET title = replace(title, '同城公室搬迁', '同城办公室搬迁'),
    seo_title = replace(seo_title, '同城公室搬迁', '同城办公室搬迁'),
    seo_keyword = replace(seo_keyword, '同城公室搬迁', '同城办公室搬迁')
WHERE id = 2
  AND (title LIKE '%同城公室搬迁%' OR seo_title LIKE '%同城公室搬迁%' OR seo_keyword LIKE '%同城公室搬迁%');

UPDATE zw_cms_expand
SET sketch = '班组有居民搬家和企业搬迁经验，可按现场条件安排人员、车辆和防护。'
WHERE id = 5 AND pid = 3 AND sketch LIKE '%口啤%';
UPDATE zw_cms_expand
SET sketch = '从勘测报价、拆装打包到派车搬运和售后，由众人统一对接。'
WHERE id = 7 AND pid = 3 AND sketch LIKE '%卡心%';
UPDATE zw_cms_expand
SET sketch = '按物品分类打包、编号搬运，到达后按约定位置摆放并交接。'
WHERE id = 8 AND pid = 3 AND sketch LIKE '%粗细归置%';
UPDATE zw_cms_expand
SET subtitle = 'Frequently Asked Questions'
WHERE id = 52 AND subtitle = 'Rrequently Ssked Questions';
COMMIT;
