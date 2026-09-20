-- Correct the verified published article without replacing the production database.
-- Idempotent: only the exact outdated sentence in article 478 is changed.
UPDATE zw_cms_article
SET content = replace(content,
    '两者涉及家具或电器拆装时，拆装额外收费。',
    '半日式与日式精品搬家均包含包装材料与小家具拆装；大型家具或电器（含空调）拆装另计，具体项目与费用在作业前书面确认。')
WHERE id = 478
  AND content LIKE '%两者涉及家具或电器拆装时，拆装额外收费。%';
