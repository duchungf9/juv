<?php


namespace App\FromSky\DomainLayer\Media\Resource;


use App\FromSky\Website\Facades\ImgHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'title'             => (string)$this->title,
            'media_type'        => (string)$this->collection_name,
            'media_category_id' => (int)$this->media_category_id,
            'category'          => (string)$this->category,
            'file_ext'          => (string)$this->file_ext,
            'icon'              => (string)$this->file_ext,
            'cover_image'       => ($this->collection_name == 'images') ? ImgHelper::get_cached($this->file_name, array('h' => '150', 'c' => 'contain', 'q' => '60')) : ''
        ];
    }
}