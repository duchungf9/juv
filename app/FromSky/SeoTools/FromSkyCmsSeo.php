<?php

namespace App\FromSky\SeoTools;

use SEO;
use SEOMeta;
use Request;
use App\FromSky\Website\Facades\ImgHelper;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Str;

trait fromSkyCmsSeoTrait
{
    /**
     * @var string
     */
    protected string $title;
    /**
     * @var string
     */
    protected string $image;
    /**
     * @var
     */
    protected        $model;
    /**
     * @var string
     */
    protected string $url;
    /**
     * @var array|string[]
     */
    protected array $query_strings = ['page'];

    /**
     *
     */
    public static function bootfromSkyCmsSeoTrait()
    {
        static::created(function ($item) {
        });
    }

    /**
     * @param $model
     * @return $this
     */
    public function setSeo($model): self
    {
        $this->model = $model;
        $this->image = asset('images/logo.png');
        if ($this->model) {

            $this->setTitle();
            $this->setDescription();
            $this->addAlternate();
            $this->setOpenGraphImages();
            $this->setCanonical();
            $this->setNoIndex();

            $this->addOpenGraphProperty('url', Request::url());
        }

        return $this;
    }

    /**
     * @param $model
     */
    public function setPagination($model): void
    {
        $prev_url = preg_replace('/\?page=[1]$/', '', $model->previousPageUrl());
        $next_url = preg_replace('/\?page=[1]$/', '', $model->nextPageUrl());

        SEOMeta::setPrev($prev_url);
        SEOMeta::setNext($next_url);

        // If not first page, add page reference in title.
        if ($model->currentPage() > 1) {
            $separator = config('seotools')['meta']['defaults']['separator'];

            if (method_exists($model, 'lastPage')) {
                SEOMeta::setTitle($this->title . $separator . trans('website.pagination', ['x' => $model->currentPage(), 'y' => $model->lastPage()]));
            } else {
                SEOMeta::setTitle($this->title . $separator . trans('website.simple_pagination', ['x' => $model->currentPage()]));
            }
        }
    }

    /**
     *
     */
    public function setTitle(): void
    {
        $this->title = $this->tagHandler('title') ?? $this->tagHandler('name') ?: '';
        SEO::setTitle($this->title);
    }

    /**
     *
     */
    public function setDescription(): void
    {
        SEO::setDescription(Str::limit($this->tagHandler('description'), config('seotools.lara_setting.description')));
    }

    /**
     *
     */
    public function setNoIndex(): void
    {
        if (data_get($this->model, 'seo_no_index')) {
            SEO::metatags()->addMeta('robots', 'noindex,nofollow');
        }else{
            SEO::metatags()->addMeta('robots', 'index,follow');
        }
        //@todo set tạm để public site
//        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

    }

    /**
     *
     */
    public function setCanonical(): void
    {
        $this->url = ($this->allowedQueryStrings())
            ? Request::fullUrl()
            : Request::url();

        SEO::setCanonical($this->url);
        if(isset($this->model->seo_canonical) && !empty($this->model->seo_canonical)){
            SEO::setCanonical($this->model?->seo_canonical ?? $this->url);
        }
    }

    /**
     *
     */
    public function setOpenGraphImages(): void
    {
        $image_conf = config('fromSky.image.social');
        $fieldspec  = $this->model->getFieldspec();
        if (data_get($fieldspec, 'image') && optional($this->model)->image) {
            $folder      = data_get($fieldspec, 'image.folder', null);
            $this->image = url(ImgHelper::get_cached($this->model->image, $image_conf, $folder));
        }

        $attributes = ['width' => $image_conf['w'], 'height' => $image_conf['h']];
        SEO::opengraph()->addImage($this->image, $attributes);
        SEO::twitter()->addValue('image', $this->image);
    }

    /**
     * @param $property
     * @param $value
     */
    public function addOpenGraphProperty($property, $value): void
    {
        SEO::opengraph()->addProperty($property, $value);
    }

    /**
     * @return $this
     */
    public function addAlternate(): self
    {
        // Add alternate url only when the website has more than one language
        if (count(LaravelLocalization::getSupportedLocales()) > 1) {

            // Is page slug translation is not ignored
            if (!$this->model->ignore_slug_translation) {
                foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                    $url = LaravelLocalization::getLocalizedURL($localeCode, $this->model->getPermalink($localeCode));
                    SEOMeta::addAlternateLanguage($localeCode, $url);
                }
            } else {
                foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                    $url = LaravelLocalization::getLocalizedURL($localeCode);
                    SEOMeta::addAlternateLanguage($localeCode, $url);
                }
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function addCanonical() : self
    {
        return  $this;
    }

    /**
     * @param $tag
     * @return mixed|null
     */
    protected function tagHandler($tag)
    {
        return (optional($this->model)->{'seo_' . $tag} != '')
            ? $this->model->{'seo_' . $tag}
            : optional($this->model)->{$tag};
    }

    /**
     * @return bool
     */
    protected function allowedQueryStrings()
    {
        return !empty(request()->only($this->query_strings));
    }

    /**
     * @param $string
     */
    public function setAllowedQueryStrings($string): void
    {
        $this->query_strings[] = $string;
    }
}
