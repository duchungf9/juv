<?php

namespace App\FromSky\DomainLayer\Website;

use App\FromSky\SeoTools\fromSkyCmsSeoTrait;
use App\Model\Page;

/**
 * Class WebsiteViewModel.
 */
abstract class WebsiteViewModel
{
    use fromSkyCmsSeoTrait;

    protected $currentPage;

    public function __construct(string $page_slug = '')
    {
        if ($page_slug != '') {
            $this->setCurrentPage($page_slug);
        }
    }

    /**
     * Lấy thông tin page theo ngôn ngữ nếu null sẽ lấy theo ngôn ngữ mặc định
     *
     * @param string $slug
     * @return void
     * @throws \Exception
     */
    public function getPage(string $slug)
    {
        return reGet(__METHOD__ . $slug, function () use ($slug) {
            $pageData = Page::findBySlug($slug, app()->getLocale());
            if (is_null($pageData)) {
                $fallback_locale = \Config::get('app.fallback_locale');
                $pageData        = Page::findBySlug($slug, $fallback_locale);
            }
            return $pageData;
        });
    }

    public function handleMissingPage()
    {
        return abort(404, 'This content is missing!');//        return redirect('/');
    }

    /**
     * @return mixed
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @param string $page_slug
     */
    public function setCurrentPage(string $page_slug): void
    {
        $this->currentPage = $this->getPage($page_slug);
    }

    public function handle(string $slug)
    {
        return ($slug === '') ? $this->index() : $this->show($slug);
    }
}
