<?php


namespace App\FromSky\DomainLayer\SocialAccount\Contracts;

/**
 * Interface DataProvider
 * @package App\FromSky\DomainLayer\SocialAccount\Contracts
 */
interface DataProvider
{
    function mapDataObject(array $providerUser);
}