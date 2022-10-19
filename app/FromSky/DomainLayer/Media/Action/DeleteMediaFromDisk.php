<?php


namespace App\FromSky\DomainLayer\Media\Action;


use App\Model\Media;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Class DeleteMediaFromDisk
 * @package App\FromSky\DomainLayer\Media\Action
 */
class DeleteMediaFromDisk
{


    private Media $media;
    private $storage;
    private string $disk = 'media';
    private string $path;
    protected $log;

    public function __construct(Media $media, $log = true)
    {
        $this->media = $media;
        $this->init()->resolvePath();
        $this->log = $log;

    }

    function execute()
    {
        return $this->delete();
    }

    protected function init()
    {
        $this->disk    = ($this->media->disk) ? $this->media->disk : $this->disk;
        $this->storage = Storage::disk($this->disk);
        return $this;
    }

    function delete()
    {
        if ($this->storage->exists($this->path)) {
            $this->logDelete();
            return $this->storage->delete($this->path);
        }
        return false;

    }

    protected function resolvePath()
    {
        $this->path = $this->media->collection_name . '/' . $this->media->file_name;
        return $this;
    }

    protected function logDelete()
    {
        if (auth_user('admin') && $this->log) {
            Log::info('Delete media by:', ['user_id' => auth_user('admin')->id, 'media' => $this->media]);
        }
    }

}