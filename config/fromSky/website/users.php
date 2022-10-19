<?php

use App\FromSky\DomainLayer\User\UserFeatures;

return [
    'features' => [
       UserFeatures::profileAvatar(),
       //UserFeatures::accountDeletion(), to be implemented
    ]
];
