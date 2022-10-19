<?php namespace App\FromSky\Website\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\FromSky\Website\Repos\Page\PageRepositoryInterface;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    use \App\FromSky\SeoTools\fromSkyCmsSeoTrait;

    protected $articleRepo;

    public function __construct(PageRepositoryInterface $page)
    {
        $this->middleware('guest');
        $this->articleRepo = $page;
    }

    public function showLinkRequestForm()
    {
        $page = $this->articleRepo->getBySlug(config('fromSky.website.option.auth.default_page'));

        $this->setSeo($page);
        \SEO::setTitle(trans('message.password_forgot'));
        return view('website.auth.password', compact('page'));
    }
}
