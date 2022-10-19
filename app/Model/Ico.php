<?php namespace App\Model;


use App\FromSky\DomainLayer\Media\Mediable;
use App\FromSky\Sluggable\SluggableTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use App\FromSky\Translatable\GFTranslatableHelper;
use \App\FromSky\DomainLayer\Page\PagePresenter;

class Ico extends Model
{
    use Translatable;
    use Mediable;
    use PagePresenter;
    use GFTranslatableHelper;
    use SluggableTrait;

    protected $table = "ico";
    protected $with = ['translations'];
    //https://icodrops.com/chumbi-valley/
    protected $fillable = [
        'name',
        'slug',
        'token_sale', //14 DEC – 17 DEC
        'token_sale', //14 DEC – 17 DEC
        'short_description',
        'long_description',
        'website',
        'whitepaper',
        'social_links',
        'sale_in', // datetime nhé
        'goal',// mục tiêu
        'type',
        'ico_image',
        'ticker',
        'token_type',
        'token_price',
        'fundraising_goal', // mục tiêu gây quỹ
        'total_token',
        'whitelist', //https://wiki.tino.org/whitelist-trong-coin-la-gi/
        'know_your_customer', //KYC là viết tắt của cụm từ Know Your Customer - Nhận biết khách hàng của bạn. Đây là một quy trình nhằm xác minh danh tính của khách hàng khi tham gia vào các dịch vụ của ngân hàng như mở tài khoản, rút tiền, gửi tiền…
        'cant_paricipate',// các nước không được phép tham gia
        'min_personal_cap', // giới hạn tối thiểu 1 cá nhân tham gia
        'max_personal_cap', // tối đa
        'review_coins_id', // review coin
        'additonal_link',
        'screenshots_id' // ảnh chụp demo
    ];

    protected array $fieldspec = [];


    /*
    |--------------------------------------------------------------------------
    |  Sluggable & Translatable
    |--------------------------------------------------------------------------
    */

    public array $translatedAttributes = [
        'name',
        'short_description',
        'long_description',
        'whitepaper',
        'whitelist', //https://wiki.tino.org/whitelist-trong-coin-la-gi/
        'know_your_customer', //KYC là viết tắt của cụm từ Know Your Customer - Nhận biết khách hàng của bạn. Đây là một quy trình nhằm xác minh danh tính của khách hàng khi tham gia vào các dịch vụ của ngân hàng như mở tài khoản, rút tiền, gửi tiền…
        'cant_paricipate',// các nước không được phép tham gia
        'seo_title',
        'seo_description',
        'seo_no_index'
    ];

    public array $sluggable = ['slug' => ['field' => 'name', 'updatable' => true, 'translatable' => false]];


    /*
    |--------------------------------------------------------------------------
    |  RELATION
    |--------------------------------------------------------------------------
    */



    /*
    |--------------------------------------------------------------------------
    |  DATE ATTRIBUTE
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    |  Fieldspec for admin form
    |--------------------------------------------------------------------------
    */
    function getFieldSpec(): array
    {
        $this->fieldspec['id']               = [
            'type'     => 'integer',
            'minvalue' => 0,
            'pkey'     => 1,
            'required' => 1,
            'label'    => 'id',
            'hidden'   => 1,
            'display'  => 0,
        ];

        $this->fieldspec['name']          = [
            'type'        => 'string',
            'label_key'   => 'name',
            'required'    => 0,
            'label'       => 'Tên ICO',
            'hidden'      => 0,
            'display'     => 1,

        ];

        $this->fieldspec['ico_image']          = [
            'type'        => 'media',
            'label_key'   => 'ico_image',
            'required'    => 0,
            'label'       => 'Ảnh ICO',
            'hidden'    => 0,
            'mediaType' => 'Img',
            'display'   => 1,
            'disk'      => 'media',

        ];

        $this->fieldspec['type']          = [
            'type'        => 'string',
            'label_key'   => 'type',
            'required'    => 0,
            'label'       => 'Loại ( TYPE )',
            'hidden'      => 0,
            'display'     => 1,

        ];

        $this->fieldspec['token_sale']          = [
            'type'        => 'date',
            'label_key'   => 'token_sale',
            'required'    => 0,
            'label'       => 'Ngày mở bán',
            'hidden'      => 0,
            'display'     => 1,
            'cssClass'        => 'datetimepicker',
            'validation'      => 'required|date_format:Y-m-d H:i:s',

        ];

        $this->fieldspec['slug']  = [
            'type'     => 'string',
            'label_key'=>"slug",
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.slug'),
            'display'  => 1,
        ];

        $this->fieldspec['short_description']  = [
            'type'     => 'string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => "Mô tả ngắn",
            'display'  => 1,
        ];

        $this->fieldspec['long_description']  = [
            'type'     => 'text',
            'required' => 0,
            'hidden'   => 0,
            'label'    => "Mô tả chi tiết",
            'display'  => 1,
            'cssClass' => 'wysiwyg',

        ];
        $this->fieldspec['review_coins_id'] = [
            'type'        => 'relation',
            'model'       => 'News',
            'foreign_key' => 'id',
            'label_key'   => 'title',
            'label'       => "Bài Viết Liên kết",
            'nullLabel'   => '--- Không thuộc bài nào ---',
            'hidden'      => 0,
            'required'    => false,
            'display'     => 1,
        ];

        $this->fieldspec['website']          = [
            'type'        => 'string',
            'label_key'   => 'name',
            'required'    => 0,
            'label'       => 'website',
            'hidden'      => 0,
            'display'     => 1,
        ];

        $this->fieldspec['goal']          = [
            'type'        => 'integer',
            'label_key'   => 'name',
            'required'    => 0,
            'label'       => 'Mục tiêu (usd)',
            'hidden'      => 0,
            'display'     => 1,
        ];

        $this->fieldspec['social_links']          = [
            'type'        => 'string',
            'label_key'   => 'name',
            'required'    => 0,
            'label'       => 'Các trang MXH',
            'hidden'      => 0,
            'display'     => 1,
        ];

        $this->fieldspec['whitepaper']  = [
            'type'     => 'text',
            'required' => 0,
            'hidden'   => 0,
            'label'    => "whitepaper",
            'display'  => 1,
        ];

        $this->fieldspec['goal']  = [
            'type'     => 'text',
            'required' => 0,
            'hidden'   => 0,
            'label'    => "Mục tiêu",
            'display'  => 1,
        ];

        $this->fieldspec['whitelist']  = [
            'type'     => 'text',
            'required' => 0,
            'hidden'   => 0,
            'label'    => "Danh sách trắng",
            'display'  => 1,
        ];

        $this->fieldspec['know_your_customer']  = [
            'type'     => 'text',
            'required' => 0,
            'hidden'   => 0,
            'label'    => "KYC",
            'display'  => 1,
        ];
        $this->fieldspec['cant_paricipate']  = [
            'type'     => 'text',
            'required' => 0,
            'hidden'   => 0,
            'label'    => "Không được tham gia",
            'display'  => 1,
            'cssClass' => 'wysiwyg',
        ];



        $this->fieldspec['seo_title'] = [
            'type' => 'string',
            'required' => 'n',
            'hidden' => 0,
            'label' => trans('admin.seo.title'),
            'display' => 1,
        ];
        $this->fieldspec['seo_description'] = [
            'type' => 'text',
            'size' => 600,
            'h' => 300,
            'hidden' => 0,
            'label' => trans('admin.seo.description'),
            'cssClass' => 'no',
            'display' => 1,
        ];

        $this->fieldspec['seo_no_index']    = [
            'type'     => 'boolean',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.seo.no-index'),
            'display'  => 1
        ];

        return $this->fieldspec;
    }

    public function getPermalink($locale = '')
    {
        return url()->to("/".$this->slug . ".icodrops");
    }
}
