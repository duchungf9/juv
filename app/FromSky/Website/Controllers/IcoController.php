<?php

namespace App\FromSky\Website\Controllers;


use App\FromSky\DomainLayer\Category\CategoryViewModel;
use App\Model\Ico;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Validator;
use App\Http\Controllers\Controller;

use App\FromSky\DomainLayer\Faq\FaqViewModel;
use App\FromSky\DomainLayer\News\NewsViewModel;
use App\FromSky\DomainLayer\Page\PageViewModel;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;

/**
 *
 */
class IcoController extends Controller
{
        public function routerList(){
             $list = reGet("ico_list" . request()->input("page", null), function(){
                 return Ico::where("status", 'active')->orderBy("token_sale", "ASC")->where("token_sale","!=",null)->get()->merge(Ico::where("status", 'upcomming')->orderBy("token_sale", "ASC")->where("token_sale","!=",null)->where("token_sale",">=",now())->get());
             });

            return view('website.ico.list', compact('list'));
        }


        public function routerDetail($slug){
            $ico = reget("__ico_detail_".$slug, function() use ($slug) {
                return  Ico::where("slug", $slug)->first();
            },1);


            if($ico == null){
                return abort(404 , "ICO not found");
            }
//            dd($ico->name);
            $other_ico =  reGet('icItem', function () use ($ico) {
                return Ico::where("status", 'active')
                          ->orderBy("token_sale", "ASC")
                          ->where("token_sale", "!=", null)
                    ->where("id","!=", $ico->id)
                          ->limit(6)
                          ->get()
                          ->merge(Ico::where("status", 'upcomming')
                                     ->orderBy("token_sale", "ASC")
                                     ->limit(6)
                                     ->where("token_sale", "!=", null)
                                     ->where("token_sale", ">=", now())->get()
                          );
            });
            return view('website.ico.detail', compact('ico' , 'other_ico'));
        }

}
