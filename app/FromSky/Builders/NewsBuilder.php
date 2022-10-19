<?php

namespace App\FromSky\Builders;

use App\Model\News;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

/**
 *
 */
class NewsBuilder extends FromSkyCmsBuilder
{
    /**
     * @param int $limit
     * @return mixed
     */
    public function latestPublished(int $limit = 5): mixed
    {
        return $this->published()->translatedContent()->latest('date')->limit($limit);
    }

    /**
     * @return FromSkyCmsBuilder|NewsBuilder
     */
    public function published(): NewsBuilder|FromSkyCmsBuilder
    {
        return $this->where('pub', 1)->where('date', '<=', Carbon::now());
    }

    /*
     *
     */
    /**
     * @return FromSkyCmsBuilder|NewsBuilder
     */
    public function findPublished(): NewsBuilder|FromSkyCmsBuilder
    {
        return $this->published()->latest('date');
    }

    /**
     * @param $tag
     * @return NewsBuilder|Builder
     */
    public function findByTag($tag): Builder|NewsBuilder
    {
        return $this->whereRelation('tags', 'slug', 'like', '%' . $tag . '%');
    }


    /**
     * @param      $tag
     * @param null $limit
     * @return LengthAwarePaginator
     * @throws \Exception
     */
    public function itemList($tag, $limit = null): LengthAwarePaginator
    {
        $limit ?? config('fromSky.website.option.pagination.news_index');
        $model = $this;
        return reGet(__METHOD__.$limit.$tag??'default',function () use($tag,$model,$limit){
            return $model->findPublished()
                 ->when($tag, function ($query, $tag) {
                     return $query->findByTag($tag);
                 })->paginate($limit);
        });
    }


    /**
     * @param $tag
     */
    function findByTags($tag)
    {
        $tag = 'laravel';

        // before
        News::whereHas('tags', function ($query) use ($tag) {
            $query->where('slug', 'like', '%' . $tag . '%');
        });

        // after
        News::whereRelation('tags', 'slug', 'like', '%' . $tag . '%');
    }
}
