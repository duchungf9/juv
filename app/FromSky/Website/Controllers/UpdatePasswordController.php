<?php

namespace App\FromSky\Website\Controllers;

use Auth;
use Input;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

use App\FromSky\Website\Repos\Page\PageRepositoryInterface;
use App\FromSky\SeoTools\fromSkyCmsSeoTrait;


class UpdatePasswordController extends Controller

{
    protected PageRepositoryInterface $articleRepo;
    use fromSkyCmsSeoTrait;

    /**
     * @param PageRepositoryInterface $page
     *
     */

    public function __construct(PageRepositoryInterface $page)
    {
        $this->articleRepo = $page;
    }

    /**
     * @param Request $request
     *
     */
    public function update_password(Request $request)
    {

        $user = auth_user();

        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string'],
            'password'         => $this->passwordRules(),
        ])->after(function ($validator) use ($user, $request) {
            if (!isset($request['current_password']) || !Hash::check($request['current_password'], $user->password)) {
                $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            }
        });

        if ($validator->fails()) {
            return redirect(url_locale('/users/profile') . '#update-password')->withErrors($validator);
        };


        $page = $this->articleRepo->getBySlug('profile');

        $user->forceFill([
            'password' => request('password'),
        ])->save();
        session()->flash('success', trans('users.profile.update_password_success'));
        $this->setSeo($page);
        return view('website.users.profile', compact('page'));

    }

    /**
     * @return array
     */
    function passwordRules(): array
    {
        return ['required', 'string', 'confirmed', Password::defaults()];
    }
}
