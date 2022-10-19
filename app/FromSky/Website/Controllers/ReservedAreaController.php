<?php

namespace App\FromSky\Website\Controllers;


use App\FromSky\DomainLayer\Store\Facades\StoreFeatures;
use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Input;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\Model\Address;
use App\Model\Country;

use App\FromSky\SeoTools\fromSkyCmsSeoTrait;
use App\FromSky\DomainLayer\Store\Facades\StoreHelper;
use App\FromSky\Website\Requests\WebsiteFormRequest;
use App\FromSky\Website\Requests\UpdateUserProfileRequest;
use App\FromSky\Website\Repos\Page\PageRepositoryInterface;

class ReservedAreaController extends Controller
{
    use fromSkyCmsSeoTrait;

    /**
     * @string
     */
    protected string $template;
    /**
     * @var PageRepositoryInterface
     */
    protected PageRepositoryInterface $articleRepo;


    /**
     * @param PageRepositoryInterface $page
     *
     */

    public function __construct(PageRepositoryInterface $page)
    {
        $this->articleRepo = $page;
    }

    /**
     * @return Factory|\Illuminate\View\View
     */
    public function dashboard(): View
    {
        $page = $this->articleRepo->getBySlug('dashboard');
        $this->setSeo($page);
        $user      = Auth::user();
        $addresses = $user->addresses;
        if (StoreFeatures::isStoreEnabled()) {
            return view('fromsky_store::order.index', compact('page', 'addresses'));
        }
        return view('website.users.dashboard', compact('page', 'addresses'));
    }


    public function profile(): View
    {

        $page = $this->articleRepo->getBySlug('profile');
        $this->setSeo($page);
        return view('website.users.profile', compact('page'));
    }

    public function update_profile(UpdateUserProfileRequest $request): View
    {
        $validated = $request->validated();
        auth_user()->update($validated);
        $page = $this->articleRepo->getBySlug('profile');
        $this->setSeo($page);
        session()->flash('success', trans('users.profile.update_profile_success'));
        return view('website.users.profile', compact('page'));
    }


    public function addressNew()
    {
        $previous  = url()->previous();
        $countries = Country::list()->get();
        return view('website.users.address_new', compact('countries', 'previous'));
    }

    public function addressCreate(WebsiteFormRequest $request)
    {
        $user = Auth::user();

        $address = Address::create([
            'user_id'    => $user->id,
            'street'     => $request->street,
            'number'     => $request->number,
            'zip_code'   => $request->zip_code,
            'city'       => $request->city,
            'province'   => $request->province,
            'country_id' => $request->country_id,
            'phone'      => $request->phone,
            'mobile'     => $request->mobile,
            'email'      => $request->email,
            'vat'        => $request->vat
        ]);

        if ($request->previous)
            return Redirect::to($request->previous);
        else
            return Redirect::to('/users/dashboard');
    }
}
