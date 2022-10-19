<?php

namespace App\FromSky\Website\Controllers;


use Input;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

use App\FromSky\Tools\JsonResponseTrait;
use App\FromSky\Website\Requests\AjaxFormRequest;

use App\FromSky\DomainLayer\Store\Action\AddCouponToNewsletter;
use App\FromSky\DomainLayer\Newsletter\Action\NotifyNewSubscriberAction;
use App\FromSky\DomainLayer\Newsletter\Action\AddNewsletterSubscriberAction;


class APIController extends Controller
{
    private array $attributes_bag;
    use JsonResponseTrait;

    /**
     * @return mixed
     */
    public function subscribeNewsletter(AjaxFormRequest $request)
    {
        $validator = Validator::make($request->all(), $request->rules());

        $coupon_code = (new AddCouponToNewsletter())->execute();
        if ($coupon_code) $this->attributes_bag['coupon_code'] = $coupon_code;

        $this->attributes_bag['locale'] = app()->getLocale();

        // merge custom attributes
        $validated = $validator->safe()->merge($this->attributes_bag);

        $newsletter = (new AddNewsletterSubscriberAction($validated->all()))->execute();

//        (new NotifyNewSubscriberAction($newsletter))->execute();

        return $this->responseSuccess(__('website.mail_message.subscribe_newsletter_feedback'))->apiResponse();
    }

    public function dispatchVisisterLog(){
       $model = getModelFromString(request()->input("model",null));
       if($model == null) return abort(404, "notfound!!");
       $obj = $model->find(request()->input('id'));
       if($obj == null) return abort(404,"notfound!!");
//       visits($obj)->seconds(60 * 60)->increment();
       if($obj != null && isset($obj->hits)){
           $obj->hits += 1; $obj->save();
           echo "save";
       }
    }

}
