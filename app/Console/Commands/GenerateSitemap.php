<?php

namespace App\Console\Commands;

use App\Model\Ico;
use App\Model\News;
use App\Model\Page;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data =  array_merge($this->getPages(),['deptrai'],$this->getICO(),$this->getArticles());
        $_xml = view('sitemap.sitemap',['data'=>$data])->render();
        $sitemapXML = File::put(public_path('/sitemap.xml'), $_xml);
    }

    private function getPages(){
        $pages = Page::wherePub(1)->get(['slug']);
        $pages->transform(function($item){
            return $item->url = "https://".$_ENV['APP_URL'].'/'.$item->slug;
        });
        return $pages->toArray();
    }

    private function getICO(){
        $icos = Ico::select(['slug'])->get();
        $icos->transform(function($item){
            return $item->url = "https://".$_ENV['APP_URL'].'/'.$item->slug.'.icodrops';
        });
        return $icos->toArray();
    }

    private function getArticles(){
        $article =  News::select(['title', 'slug', 'id', 'date', 'category_id', 'image'])->published()->get();
        $article->transform(function($item){
            return $item->url = cache()->remember(__METHOD__.__FUNCTION__.__CLASS__,now()->addDay(1),function() use ($item) {
                return $item->getPermalink();
            });
        });
        return $article->toArray();
    }
}
