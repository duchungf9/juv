<?php

namespace App\FromSky\Builders;


/**
 *
 */
class MediaBuilder extends FromSkyCmsBuilder
{


    /**
     * @return MediaBuilder|m.\App\FromSky\Builders\MediaBuilder.where
     */
    public function Images()
    {
        return $this->where('collection_name', 'images');
    }

    /**
     * @return MediaBuilder|m.\App\FromSky\Builders\MediaBuilder.where
     */
    public function Documents()
    {
        return $this->where('collection_name', 'docs');
    }
}
