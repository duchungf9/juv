<?php


namespace App\FromSky\DomainLayer\SocialAccount\DataProvider;


use App\FromSky\DomainLayer\SocialAccount\Contracts\DataProvider;

/**
 * Google Data Provider
 * Class GoogleDataProvider
 * @package App\FromSky\DomainLayer\SocialAccount\DataProvider
 */
class GoogleDataProvider implements DataProvider
{

    /**
     * @param $providerUser
     * @return array
     */
    function mapDataObject($providerUser): array
    {

        return [
            'firstname' => data_get($providerUser, 'given_name', $providerUser->name),
            'lastname'  => data_get($providerUser, 'family_name', null),
            'is_active' => 1,
            'email'     => $providerUser->email
        ];
    }
}