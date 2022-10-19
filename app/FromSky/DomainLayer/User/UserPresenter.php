<?php


namespace App\FromSky\DomainLayer\User;


use App\FromSky\Definition\Definition;
use Illuminate\Support\Facades\Storage;

trait UserPresenter
{
    function getNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    function getAvatarUrl()
    {
        $path = config('fromSky.admin.path.users_repository') . '/' . $this->avatar;
        return asset($path);
    }

    function hasAvatar()
    {
        return Storage::disk(Definition::USER_STORAGE_DISK)->exists($this->avatar);
    }
}