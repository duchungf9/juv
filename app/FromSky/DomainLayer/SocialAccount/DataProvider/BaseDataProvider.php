<?php


namespace App\FromSky\DomainLayer\SocialAccount\DataProvider;


use App\FromSky\DomainLayer\SocialAccount\Contracts\DataProvider;

/**
 * Class BaseDataProvider
 * @package App\FromSky\DomainLayer\SocialAccount\DataProvider
 */
class BaseDataProvider implements DataProvider
{

    /**
     * @param $providerUser
     * @return array
     */
    function mapDataObject($providerUser): array
    {

        return [
            'firstname' => $providerUser->name,
            'lastname'  => '',
            'is_active' => 1,
            'email'     => $providerUser->email
        ];
    }
}