<?php


namespace App\FromSky\DomainLayer\Admin\Resource;

use App\FromSky\Website\Facades\ImgHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminSectionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'    => (string)$this->value,
            'title' => (string)$this->title,
        ];
    }
}