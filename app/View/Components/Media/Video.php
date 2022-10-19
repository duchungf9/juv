<?php

namespace App\View\Components\Media;

use Illuminate\View\Component;

class Video extends EmbedComponent
{
    public $video;
    public $ratio;
    public $extra_class;
    public $url;

    /**
     * Video constructor.
     * @param $video
     * @param string $ratio
     * @param string $classExtra
     */
    public function __construct($video, $ratio = '16x9', $classExtra = "")
    {
        //
        $this->video = $video;
        $this->ratio = $ratio;
        $this->extra_class = $classExtra;
        $this->url = $this->getUrl();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.media.video');
    }

    public  function getUrl(): string
    {
        return 'https://www.youtube-nocookie.com/embed/' . $this->video . '?rel=0';
    }
}
