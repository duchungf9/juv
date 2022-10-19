<?php


namespace App\FromSky\DomainLayer\SocialAccount\Action;


use App\Model\User;

/**
 * Class CreateNewIdentity
 * @package App\FromSky\DomainLayer\SocialAccount\Action
 */
class CreateNewIdentity
{

    private User $user;

    function handle(User $user, $providerUser, $provider)
    {
        $this->user = $user;
        return $this->addIdentity($providerUser, $provider);
    }

    function addIdentity($providerUser, $provider)
    {
        return $this->user->identities()->create([
            'provider_id' => $providerUser->getId(),
            'provider'    => $provider,
            'name'        => $providerUser->getName(),
            'nickname'    => $providerUser->getNickName(),
        ]);
    }
}