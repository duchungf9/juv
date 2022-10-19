<?php


namespace App\FromSky\DomainLayer\Media;


use App\FromSky\Tools\StringHelper;
use App\FromSky\Website\Facades\ImgHelper;

trait MediaPresenter
{
    public function getPreviewAttribute()
    {
        return ma_get_image_from_repository($this->file_name);
    }


    public function getPreviewThumbAttribute()
    {
        return ($this->file_name) ? ImgHelper::get_cached($this->file_name, config('fromSky.image.admin')) : '';
    }

    public function getCategoryAttribute()
    {
        return optional($this->media_category)->title;
    }

    public function url()
    {
        switch ($this->collection_name) {
            case 'images':
                return ma_get_image_from_repository($this->file_name);
                break;
            case 'docs':
                return ma_get_doc_from_repository($this->file_name);
                break;
        }
    }

    public function path()
    {
        switch ($this->collection_name) {
            case 'images':
                return ma_get_image_path_from_repository($this->file_name);
                break;
            case 'docs':
                return ma_get_doc_path_from_repository($this->file_name);
                break;
        }
    }

    public function getFileSize()
    {
        return StringHelper::humanReadableFileSize($this->size);
    }

}