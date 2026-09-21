<?php
namespace app\controller;

use app\model\CmsArticle;
use app\model\CmsCases;
use app\model\CmsBanner;
use app\model\CmsNav;
use app\model\CmsExpand;

/**
 * 首页控制器
 */
class Index extends BaseController
{
    public function pricing()
    {
        $this->initConfig();
        $this->render('index/pricing', [
            'page_title' => '广州搬家收费标准｜普通与日式套餐、合同锁价｜众人搬家',
            'page_description' => '众人搬家公开居民搬家380元、469元、569元套餐及日式搬家收费，说明楼层费、超里程费、免费上门勘测条件与合同锁价承诺；高层吊装、工厂搬迁勘测后分项报价。',
            'canonical_url' => $this->siteUrl('/pricing.html'),
        ]);
    }

    /**
     * 首页
     */
    public function index(string $city = '')
    {
        $this->initConfig();
        $articleModel = new CmsArticle();
        $casesModel   = new CmsCases();
        $bannerModel  = new CmsBanner();

        // 获取首页轮播图
        $banners = $bannerModel->getBanners('home');

        // 获取服务产品列表
        $expandModel = new CmsExpand();
        $serviceDescriptions = [
            '同城搬家' => '提供快速、专业的搬运服务，确保客户物品安全、高效地送达新居',
            '跨市搬家' => '实现城市间物品的安全、高效转移，满足客户长途搬迁的需求。',
            '出国搬家' => '涵盖全程，从物品打包、运输到清关配送，专业、安全、便捷地助力客户实现跨国搬迁。',
            '日式搬家' => '以细致入微的打包、搬运及还原整理为核心，提供一站式无忧搬家体验',
            '钢琴搬运' => '以专业团队和精细流程为核心，确保钢琴安全、无损地从一地搬运至另一地。',
            '大型工厂搬迁' => '凭借专业团队与高效方案，实现工厂设备、物资的全面、安全、快速迁移。',
            '收纳整理' => '通过专业规划与整理技巧，帮您打造整洁有序的生活或工作环境。',
            '家居拆装' => '以专业团队为核心，提供从拆卸到组装的全程无忧解决方案。',
        ];
        $services = $expandModel->getByParent(75, 'home_services');
        foreach ($services as &$service) {
            $service['sketch'] = $serviceDescriptions[$service['title']] ?? '';
        }
        unset($service);

        // 获取新闻资讯（最新4篇）
        $newsList = $articleModel->getLatest(4);

        // 获取案例（按分类）
        $caseTabs = [
            ['name' => '最新', 'list' => $casesModel->getLatest(4)],
            ['name' => '同城服务', 'list' => $casesModel->getLatest(4, 9)],
            ['name' => '跨市服务', 'list' => $casesModel->getLatest(4, 10)],
        ];

        // 获取"关于我们"的子菜单
        $navModel = new CmsNav();
        $aboutParent = $navModel->findWhere(['url_model' => 'about'], 'id');
        $aboutNavs = $navModel->select(['pid' => $aboutParent['id'] ?? 0, 'status' => 1], '*', 'sort ASC');

        // "选择我们的理由"扩展数据
        $reasons = $expandModel->getByParent(3, 'reasons');
        $reasonOrder = [4, 6, 5, 7, 8, 9];
        usort($reasons, static fn(array $a, array $b): int => array_search((int) $a['id'], $reasonOrder, true) <=> array_search((int) $b['id'], $reasonOrder, true));
        $about = $expandModel->find(1) ?: [];
        $why = $expandModel->find(3) ?: [];

        $this->render('index/index', [
            'banners'    => $banners,
            'services'   => $services,
            'newsList'   => $newsList,
            'caseTabs'   => $caseTabs,
            'aboutNavs'  => $aboutNavs,
            'reasons'    => $reasons,
            'about'      => $about,
            'why'        => $why,
            'page_title' => '广州搬家公司｜日式搬家、居民搬家与企业搬迁｜众人搬家',
            'page_keywords' => $this->siteConfig['seo_keyword'] ?? '',
            'page_description' => '众人搬家提供广州居民搬家、日式打包收纳、企业工厂搬迁与高层吊装服务，居民搬家380元起。官网公开收费明细、合同锁价承诺、资质证照及大众点评、淘宝、京东客户评价。咨询：020-85627757。',
            'canonical_url' => $this->siteUrl('/'),
            'structured_data' => [[
                '@context' => 'https://schema.org',
                '@type' => 'WebSite',
                '@id' => $this->siteUrl('/#website'),
                'url' => $this->siteUrl('/'),
                'name' => $this->siteConfig['company_name'] ?? '广东众人搬家起重吊装有限公司',
                'inLanguage' => 'zh-CN',
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => $this->siteUrl('/search.html?keyword={search_term_string}'),
                    'query-input' => 'required name=search_term_string',
                ],
            ]],
        ]);
    }

    /**
     * 关于我们
     */
    public function about(int $id = 0)
    {
        $navModel = new CmsNav();
        // /about.html 与主导航使用同一资质页面，保留旧入口可访问。
        $page = $navModel->find($id ?: 13);
        if (!$page) {
            $page = $navModel->findWhere(['url_model' => 'about']);
        }

        // 获取关于我们的子页面（获取兄弟页面，即父级下的子页面）
        $parentId = ($page && $page['pid'] > 0) ? $page['pid'] : ($page['id'] ?? 5);
        $children = $navModel->select(['pid' => $parentId, 'status' => 1], '*', 'sort ASC');

        $view = 'index/about';
        $viewData = [
            'page'      => $page ?? [],
            'classify'  => $children,
            'banner'    => ($navModel->find($parentId)['image'] ?? '') ?: '/upload/20240510/bacfd59f43877ced86eca6d241385b84.jpg',
            'p_active'  => 4,
            'page_title'      => $page['seo_title'] ?: $this->seoTitle($page['title'] ?? '关于众人'),
            'page_keywords'   => $page['seo_keyword'] ?? '',
            'page_description'=> $page['seo_content'] ?? '',
        ];

        if ((int) ($page['id'] ?? 0) === 13) {
            $view = 'index/qualifications';
            $viewData['page_title'] = '众人搬家靠谱吗？广州搬家公司资质与安全保障';
            $viewData['page_keywords'] = '众人搬家资质,道路运输经营许可证,ISO 9001,ISO 14001,ISO 45001,广州搬家公司';
            $viewData['page_description'] = '查看广东众人搬家起重吊装有限公司的营业执照、道路运输经营许可证、车辆道路运输证及质量、环境、职业健康安全管理体系认证证书，并了解证照编号、范围、有效期、部分员工团体保险参保证明及安全作业制度。';
            $viewData['canonical_url'] = $this->siteUrl('/about/13.html');
        }

        // 企业文化、员工风采、媒体报道的数据存放在扩展内容表，不能使用通用富文本页渲染。
        $expandModel = new CmsExpand();
        switch ((int) ($page['id'] ?? 0)) {
            case 14:
                $view = 'index/culture';
                $viewData['cultureProfile'] = $expandModel->find(23) ?: [];
                $viewData['serviceConcepts'] = $expandModel->getByParent(15, 'about_service_concepts');
                $viewData['managementConcept'] = $expandModel->find(22) ?: [];
                break;
            case 15:
                $view = 'index/style';
                $viewData['staffPhotos'] = $expandModel->getByParent(24, 'about_staff_photos');
                break;
            case 16:
                $view = 'index/media';
                $viewData['mediaReports'] = $expandModel->getByParent(29, 'about_media_reports');
                break;
            case 18:
                // 空白联系页：复用“联系我们”完整联系模块，统一入口指向 /contact/8.html
                $this->initConfig();
                $view = 'index/contact';
                $viewData['contact'] = $expandModel->find(33) ?: [];
                $viewData['p_active'] = 7;
                $viewData['page_title'] = '联系众人 - ' . $this->siteConfig['company_name'];
                $viewData['canonical_url'] = $this->siteUrl('/contact/8.html');
                break;
        }

        $this->render($view, $viewData);
    }

    /**
     * 联系我们
     */
    public function contact(int $id = 0)
    {
        $this->initConfig();
        $contact = (new CmsExpand())->find(33) ?: [];
        $this->render('index/contact', [
            'p_active'   => 7,
            'contact'    => $contact,
            'page_title' => '联系众人 - ' . $this->siteConfig['company_name'],
            'canonical_url' => $this->siteUrl('/contact/8.html'),
        ]);
    }

    /**
     * 活动页面
     */
    public function event()
    {
        $this->render('index/event', [
            'page_title' => '活动 - 众人搬家',
        ]);
    }

    /**
     * 切换语言
     */
    public function changeLanguage()
    {
        $lang = $this->get('lang', 'zh-cn');
        setcookie('think_lang', $lang, time() + 86400 * 30, '/');
        $this->json(['code' => 1, 'msg' => '切换成功']);
    }

    /**
     * 详情页通用路由
     */
    public function detail(int $id, string $type = 'news')
    {
        switch ($type) {
            case 'news':
                $model = new CmsArticle();
                break;
            case 'product':
                $model = new CmsProduct();
                break;
            case 'case':
                $model = new CmsCases();
                break;
            default:
                $this->redirect('/');
                return;
        }

        $detail = $model->find($id);
        if (!$detail) {
            header('HTTP/1.1 404 Not Found');
            $this->render('error/404', ['page_title' => '404 - 页面未找到']);
            return;
        }

        // 增加浏览量
        if (method_exists($model, 'incrementBrowse')) {
            $model->incrementBrowse($id);
        }

        // 获取相关推荐
        $related = [];
        if (method_exists($model, 'getRelated')) {
            $related = $model->getRelated($detail['nav_id'] ?? 0, $id);
        }

        // 面包屑
        $navModel = new CmsNav();
        $breadcrumb = $navModel->getBreadcrumb($detail['nav_id'] ?? 0);

        $this->render('index/detail', [
            'detail'     => $detail,
            'related'    => $related,
            'breadcrumb' => $breadcrumb,
            'page_title'      => $detail['seo_title'] ?? $detail['title'],
            'page_keywords'   => $detail['seo_keyword'] ?? '',
            'page_description'=> $detail['seo_content'] ?? '',
        ]);
    }
}
