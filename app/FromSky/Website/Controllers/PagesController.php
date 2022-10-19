<?php

namespace App\FromSky\Website\Controllers;


use App\Http\Controllers\Controller;

use App\FromSky\DomainLayer\Page\PageViewModel;
use App\Model\Category;
use App\Model\News;
use App\Model\NewsTranslation;
use App\Model\Product;
use App\Model\ReviewCoin;
use Faker\Factory;
use Faker\Guesser\Name;
use Faker\Provider\DateTime;
use Faker\Provider\Text;
use Illuminate\Support\Str;


class PagesController extends Controller
{
    public function home()
    {

        return (new PageViewModel())->handle('home');
    }

    function pages(string $parent, string $child = '')
    {
        return (new PageViewModel())->handle($parent, $child);
    }
}
