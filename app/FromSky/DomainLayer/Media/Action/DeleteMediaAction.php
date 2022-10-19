<?php


namespace App\FromSky\DomainLayer\Media\Action;


use App\Model\Media;

/**
 * Class DeleteMediaAction
 * @package App\FromSky\DomainLayer\Media\Action
 */
class DeleteMediaAction
{

    private Media $media;

    public function __construct(Media $media)
    {
        $this->media = $media;

    }

    function execute()
    {
        if ($this->media->canBeDeleted()) {
            // delete media from db;
            $this->media->delete();
            // delete media from  disk
            return (new DeleteMediaFromDisk($this->media))->execute();
        }

    }
}