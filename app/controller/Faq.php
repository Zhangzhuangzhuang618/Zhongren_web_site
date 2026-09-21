<?php
namespace app\controller;

class Faq extends BaseController
{
    public function index(): void
    {
        $faqs = require CONFIG_PATH . 'faq.php';
        $schemaItems = [];
        foreach ($faqs as $faq) {
            $schemaItems[] = [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']],
            ];
        }

        $this->render('faq/index', [
            'faqs' => $faqs,
            'p_active' => 6,
            'canonical_url' => $this->siteUrl('/faq.html'),
            'page_title' => '广州搬家常见问题｜会加价吗、损坏怎么办、如何预约｜众人搬家',
            'page_description' => '众人搬家FAQ集中解答吊装风险防护、物品损坏处理、当天上门预约、居民搬家套餐、免费勘测、合同锁价及搬前准备等常见问题。',
            'page_keywords' => '广州搬家常见问题,广州搬家费用,搬家流程,搬家打包,搬家公司选择',
            'structured_data' => array_merge([[
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => $schemaItems,
            ]], $this->breadcrumbSchema([
                ['name' => '首页', 'url' => '/'],
                ['name' => '搬家常见问题', 'url' => '/faq.html'],
            ])),
        ]);
    }
}
