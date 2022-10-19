<?php


namespace App\FromSky\DomainLayer\Media;


use Illuminate\Support\Str;

trait Mediable
{

    public function media()
    {
        return $this->morphMany('App\Model\Media', 'model');
    }

    public function gallery()
    {
        return $this->media()->where('collection_name', 'images');
    }

    public function imageMedia()
    {
        return $this->belongsTo('App\Model\Media', 'image_media_id', 'id');
    }

    public function docMedia()
    {
        return $this->belongsTo('App\Model\Media', 'doc_media_id', 'id');
    }

    public function hasImageMedia()
    {

        return $this->imageMedia()->count();
    }

    public function hasDocMedia()
    {
        return $this->imageMedia()->count();
    }

    public function hasGallery()
    {
        return $this->gallery()->count();
    }

    public function getMediaFolder()
    {
        return $this->media_folder ?: Str::of(class_basename($this))->lower()->plural();
    }

}