<?php

namespace App\FromSky\Website\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\FromSky\Tools\JsonResponseTrait;
use App\FromSky\DomainLayer\User\Action\setAvatarAction;
use App\FromSky\DomainLayer\User\Action\deleteAvatarAction;


class UserAvatarApiController extends Controller
{

    use JsonResponseTrait;

    /**
     * @return mixed
     */

    /**
     *  Upload Avatar action
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function create(Request $request)
    {
        $request->input('avatar');
        $user   = auth_user();
        $path   = $request->file('avatar')->store($user->id, 'users');
        $result = (new setAvatarAction($user))->execute($path);
        if ($result) {
            return $this->responseSuccess()->apiResponse();
        }
        return $this->responseWithError()->apiResponse();
    }

    /*
     *  delete avatar action
     */
    function delete()
    {
        $user   = auth_user();
        $result = (new deleteAvatarAction($user))->execute();
        if ($result) {
            return $this->responseSuccess()->apiResponse();
        }
        return $this->responseWithError()->apiResponse();
    }

}