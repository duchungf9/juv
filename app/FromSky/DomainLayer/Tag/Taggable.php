<?php


namespace App\FromSky\DomainLayer\Tag;

/**
 * Trait Taggable
 * @package App\FromSky\DomainLayer\Tag
 */
trait Taggable
{
    public function tags()
    {
        return $this->belongsToMany('App\Model\Tag');
    }

    public function saveTags($values)
    {
        if (!empty($values)) {
            $values = array_filter($values);
            $this->tags()->sync($values);
        } else {
            $this->tags()->detach();
        }
    }
}