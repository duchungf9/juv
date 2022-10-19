<?php

namespace App\FromSky\DomainLayer\SocialAccount\Action;


use App\Model\User;
use Illuminate\Support\Str;

/**
 * Class CreateUserAction
 * @package App\FromSky\DomainLayer\SocialAccount\Action
 */
class CreateUserAction
{
    /**
     * @var
     */
    private $providerUser;
    /**
     * @var string
     */
    private string $provider;

    /**
     * @param $providerUser
     * @param $provider
     * @return mixed
     */
    function handle($providerUser, $provider)
    {
        $this->providerUser = $providerUser;
        $this->provider     = $provider;
        return $this->addNewUser();
    }


    /**
     * @return mixed
     */
    function addNewUser()
    {
        return User::forceCreate($this->dataProviderBag());
    }

    /**
     * @return mixed
     */
    function dataProviderBag()
    {
        return $this->resolveDataProviderBag();
    }


    /**
     * @return mixed
     */
    function resolveDataProviderBag()
    {
        $dataProviderClassName = ($this->dataProviderExist($this->provider))
            ? $this->resolveDataProviderNamespace($this->provider)
            : $this->resolveDataProviderNamespace('base');

        return (new $dataProviderClassName())->mapDataObject($this->providerUser);
    }

    /**
     * @param $provider
     * @return bool
     */
    function dataProviderExist($provider)
    {
        return class_exists($this->resolveDataProviderNamespace($provider));
    }


    /**
     * @param $provider
     * @return string
     */
    function resolveDataProviderNamespace($provider)
    {
        return "App\FromSky\DomainLayer\SocialAccount\DataProvider\\" . ucfirst(Str::camel($provider)) . "DataProvider";
    }

}