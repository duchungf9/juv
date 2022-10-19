<?php
namespace App\View\Components\Website\Home;

use App\Model\Widget;
use Illuminate\View\Component;
use App\Model\Media;
/**
 *
 */
class Video extends Component
{
    public $videos;
    public function render()
    {
        $video_collections = Media::where("collection_name","videos")->wherePub(1)->take(10)->orderBy("created_at","DESC")->get();
        return view('components.website.home.videos',['video_collections'=>$video_collections]);
    }
}

