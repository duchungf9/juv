<?php


/*
|--------------------------------------------------------------------------
|  Admin role helper
|--------------------------------------------------------------------------
*/

//This method is used to check if the  current admin user is SU
function isSu()
{
    return cmsUserHasRole('su');
}

//This method is used to check the admin role
function cmsUserHasRole($role)
{
    return (auth_user('admin')->hasRole($role)) ? 1 : 0;
}

//This method is used to check if current user is Owner
function cmsUserIsOwner($model_id, $user_id)
{
    return (cmsUserHasRole(['su', 'admin']) || $model_id == $user_id) ? 1 : 0;
}

//Get the current_auth_user
function auth_user($guard = '')
{
    return ($guard != '') ? auth($guard)->user() : auth()->user();
}

function cmsUserValidateRoles($data)
{
    return (data_get($data, 'roles', false) == false) ? true : cmsUserHasRole($data['roles']);
}


function cmsUserValidateActionRoles($action_list)
{
    return collect($action_list)->filter(function ($_item, $key) {
        return ((cmsUserValidateRoles($_item))) ? $_item : '';
    });
}



