<?php namespace App\FromSky\Website\Controllers;

use App\FromSky\DomainLayer\News\NewsViewModel;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\FromSky\DomainLayer\Contact\Action\NewContactAction;
use App\FromSky\Website\Requests\WebsiteFormRequest;
use App\FromSky\Notifications\ContactRequest;
use App\FaqCategory;
use App\Model\Category;
use App\Model\Ico;
use App\Model\News;
use App\Model\Page;
use App\Model\Contact;
use App\Model\Product;

use Illuminate\Support\Facades\Notification;
use Validator;
use Input;

class WebsiteFormController extends Controller
{

    /**
     *  Contact Form  Handler
     *
     * @param WebsiteFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getContactUsForm(WebsiteFormRequest $request)
    {
        $validated = $request->safe();                      // get an instance of Illuminate\Support\ValidatedInput.
        (new NewContactAction())->handle($validated->all());// pass all the validated fields
        session()->flash('success', trans('website.message.contact_feedback'));
        return back();
    }

    /**
     *
     *  File upload  Handler
     *  TODO to be improved
     *
     * @param $model
     * @param $media
     */
    private function mediaHandler($model, $media)
    {
        if (request()->hasFile($media) && request()->file($media)->isValid()) {
            $newMedia        = request()->file($media);
            $model_name      = strtolower(class_basename($model));
            $destinationPath = config('fromSky.admin.path.user_upload') . '/' . $model_name; // upload path
            $extension       = $newMedia->getClientOriginalExtension();                      // getting image extension
            $name            = basename($newMedia->getClientOriginalName(), '.' . $extension);
            $fileName        = Str::slug(time() . '_' . $name) . "." . $extension; // renameing image
            $newMedia->move($destinationPath, $fileName);                          // uploading file to given path
            $model->$media = $model_name . '/' . $fileName;
        }
    }

    /**
     * @param null $inputKw
     * @return mixed
     * @throws \Exception
     */
    public  function routerSearch($inputKw = null){
        $kw = request()->input("kw");
        if ($inputKw != null) {
            $kw = $inputKw;
        }
        return $this->routerGetSearch($kw);
    }


    /**
     * @param $keyword
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function routerGetSearch($keyword)
    {
        return (new NewsViewModel(''))->doSearch($keyword);
    }
}
