<?php
require __DIR__ . '/../app/service/CasePresentation.php';
use app\service\CasePresentation;
function check($condition, $message) { if (!$condition) throw new RuntimeException($message); }
$case = CasePresentation::prepare([
    'title' => '众人搬家案例：珠海市市政府大楼',
    'content' => '<p>服务地点：珠海</p><p>服务类型：办公物资搬迁</p><h2>项目难点</h2><p>通道狭窄</p><h2>众人搬家解决方案</h2><p>分批搬运</p><h2>交付成果</h2><p>完成</p>',
    'sketch' => '这里可查询搬家公司哪家靠谱', 'create_time' => 100, 'update_time' => 200,
]);
check($case['headline'] === '众人搬家案例：珠海市政府大楼', 'title normalization');
check($case['case_fields']['服务地点'] === '珠海', 'location');
check($case['case_fields']['项目难点'] === '通道狭窄', 'section boundary');
check($case['case_fields']['众人搬家解决方案'] === '分批搬运', 'solution boundary');
check($case['display_time'] === 200, 'modified date');
check(!str_contains($case['summary'], '哪家靠谱'), 'template summary');
$imageOnly = CasePresentation::prepare(['title' => '项目甲', 'content' => '<p><img src="/a.jpg"></p>', 'create_time' => 100]);
check($imageOnly['case_fields'] === [], 'no invented fields');
check($imageOnly['display_time'] === 100 && $imageOnly['time_label'] === '内容发布时间', 'creation fallback');
check(CasePresentation::prepare(['title' => '甲'])['display_time'] === 0, 'no epoch fallback');
$sports = CasePresentation::prepare(['title' => '文本体育馆', 'content' => '<p>文体体育馆影音设备高空吊装</p>', 'sketch' => '文本体育馆项目']);
check($sports['title'] === '广西体育中心', 'confirmed sports center name');
check($sports['content'] === '<p>广西体育中心影音设备高空吊装</p>', 'legacy body name');
check($sports['summary'] === '广西体育中心项目', 'legacy summary name');
echo "CasePresentation tests passed\n";
