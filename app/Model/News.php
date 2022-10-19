<?php namespace App\Model;

//use App\FromSky\Translatable\DynamicsAttributesHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


use App\FromSky\Builders\NewsBuilder;
use \App\FromSky\DomainLayer\News\NewsPresenter;

use App\FromSky\DomainLayer\Tag\Taggable;
use App\FromSky\DomainLayer\Block\Blockable;
use App\FromSky\DomainLayer\Media\Mediable;

use Astrotomic\Translatable\Translatable;
use App\FromSky\Translatable\GFTranslatableHelper;

/**
 * @method static itemList(string $tag)
 * @method static findBySlug(string $slug, string $getLocale)
 * @property mixed $category_id
 */
class News extends Model
{
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
    use Translatable;
    use GFTranslatableHelper;
//    use DynamicsAttributesHelper;

    use Mediable;
    use Taggable;
    use Blockable;
    use NewsPresenter;

    protected $with = ['translations'];
    public array $cloneable_relations = ['translations', 'tags'];
    public array $clone_exempt_attributes = ['slug'];

    protected $fillable = ['category_id', 'title', 'subtitle', 'description','seo_canonical',
        'video', 'doc', 'image_media_id', 'images','hits','is_home','is_pin',
        'date', 'date_start', 'sort', 'pub', 'created_by', 'updated_by'];
    protected array $fieldspec = [];

    /*
    |--------------------------------------------------------------------------
    |  Sluggable & Translatablee
    |--------------------------------------------------------------------------
    */
    public array $translatedAttributes = ['title', 'subtitle', 'slug', 'description', 'seo_title', 'seo_description','seo_keywords','seo_no_index'];
    public array $sluggable = ['slug' => ['field' => 'title', 'updatable' => false]];

    /*
    |--------------------------------------------------------------------------
    |  RELATIONS
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo('App\Model\Category', 'category_id', 'id');
//        return $this->belongsTo('App\Model\Category', 'category_id', 'id')->where('model_type', News::class);
    }

    public function getAllCategories()
    {
        return $this->hasMany('App\Model\Category');
    }

    /*
    |--------------------------------------------------------------------------
    |  Builder & Repo
    |--------------------------------------------------------------------------
    */
    function newEloquentBuilder($query): NewsBuilder
    {
        return new NewsBuilder($query);
    }

    /*
    |--------------------------------------------------------------------------
    |  DATE ATTRIBUTE
    |--------------------------------------------------------------------------
    */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value);

    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
        //return Carbon::parse($value)->format('d-m-Y H:i:s');
    }

    public function setDateStartAttribute($value)
    {
        $this->attributes['date_start'] = Carbon::parse($value);
    }

    public function getDateStartAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getFormattedDate()
    {
        //return Carbon::parse($this->attributes['date'])->formatLocalized('%d %B %Y');
        return Carbon::parse($this->attributes['date'])->format('Y-m-d H:i:s');
    }

    /**
     * Lấy lượt view của mỗi bài viết.
     * @return mixed
     * @throws \Exception
     */
    public function getHitsAttribute(){
//        dd($this);
        return $this?->hits ?? 0;
    }


    /*
    |--------------------------------------------------------------------------
    |  Fieldspec for admin form
    |--------------------------------------------------------------------------
    */
    function getFieldSpec(): array
    {

        $this->fieldspec['id']          = [
            'type'     => 'integer',
            'minvalue' => 0,
            'pkey'     => 1,
            'required' => 1,
            'label'    => 'id',
            'hidden'   => 1,
            'display'  => 0,
        ];
        $this->fieldspec['date']        = [
            'type'            => 'string',
            'required'        => 1,
            'hidden'          => 0,
            'label'           => __('admin.label.date_publish'),
            'display'         => 1,
            //'cssClass'      => 'datetimepicker',
            'cssClass'        => 'datetimepicker',
            'cssClassElement' => 'col-sm-2',
            'row-item'        => 'start'
        ];
        $this->fieldspec['date_start']  = [
            'type'            => 'date',
            'required'        => 1,
            'hidden'          => 0,
            'label'           => __('admin.label.date_start'),
            'display'         => 1,
            'cssClass'        => 'datetimepicker',
            'cssClassElement' => 'col-sm-2',
            'row-item'        => 'stop',
            'validation'      => 'required|date_format:Y-m-d H:i:s',
        ];
//        $this->fieldspec['category_id'] = [
//            'type'        => 'relation',
//            'model'       => 'Category',
////          'filter'      => ['model_type' => News::class],
//            'foreign_key' => 'id',
//            'label_key'   => 'title',
//            'label'       => trans('admin.label.category'),
//            'hidden'      => 0,
//            'required'    => true,
//            'display'     => 1,
//        ];
        $this->fieldspec['category_id'] = [
            'type' => 'relation_tree',
            'tree_field' => 'parent_id',
            'order_field' => 'sort',
            'model' => 'Category',
            'foreign_key' => 'id',
            'label_key' => 'title',
            'label' => trans('admin.label.category'),
            'hidden' => 0,
            'required'    => true,
            'display' => 1,
        ];

        $this->fieldspec['title']       = [
            'type'     => 'string',
            'required' => 1,
            'hidden'   => 0,
            'label'    => 'Title',
            'display'  => 1,
        ];


        $this->fieldspec['subtitle']    = [
            'type'     => 'string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.subtitle'),
            'display'  => 1,

        ];
        $this->fieldspec['slug']        = [
            'type'     => 'string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => 'Slug',
            'display'  => 1,
        ];
        $this->fieldspec['description'] = [
            'type'     => 'text',
            'size'     => 600,
            'h'        => 300,
            'required' => 1,
            'hidden'   => 0,
            'label'    => 'Description',
            'cssClass' => 'wysiwyg',
            'display'  => 1,
        ];
        $this->fieldspec['tag']         = [
            'type'          => 'relation',
            'model'         => 'Tag',
            'relation_name' => 'tags',
            'foreign_key'   => 'id',
            'label_key'     => 'title',
            'label'         => 'Tags',
            'required'      => 1,
            'display'       => 1,
            'hidden'        => 0,
            'multiple'      => 1
        ];
        $this->fieldspec['link']        = [
            'type'     => 'string',
            'size'     => 600,
            'required' => 1,
            'hidden'   => 0,
            'label'    => 'External url',
            'display'  => 0,
        ];

        $this->fieldspec['image'] = [
            'type'      => 'media',
            'required'  => 0,
            'hidden'    => 0,
            'label'     => trans('admin.label.image'),
            'mediaType' => 'Img',
            'display'   => 1,
            'disk'      => 'media',

        ];

        /*$this->fieldspec['image_media_id'] = [
            'type'       => 'fileManager',
            'required'   => false,
            'hidden'     => 0,
            'label'      => 'Image File Manager',
            'mediaType'  => 'images',
            'collection' => 'images',
            'display'    => 1,
        ];*/

        $this->fieldspec['doc']   = [
            'type'        => 'media',
            'required'    => 0,
            'hidden'      => 0,
            'label'       => trans('admin.label.doc'),
            'lang'        => 0,
            'mediaType'   => 'Doc',
            'display'     => 1,
            'uploadifive' => 1,
            'accept'      => '.pdf,.txt'
        ];
        $this->fieldspec['video'] = [
            'type'     => 'string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => "YouTube video code",
            'display'  => 1,
        ];
        $this->fieldspec['sort']  = [
            'type'     => 'integer',
            'required' => 0,
            'label'    => 'Order',
            'hidden'   => 0,
            'display'  => 1,
        ];
        $this->fieldspec['pub']   = [
            'type'     => 'boolean',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.publish'),
            'display'  => 1,
            'roles'=> ['su','admin']
        ];

        $this->fieldspec['is_home']   = [
            'type'     => 'boolean',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.publish_home'),
            'display'  => 1,
            'roles'=> ['su','admin']
        ];

        $this->fieldspec['is_pin']   = [
            'type'     => 'boolean',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.publish_pin'),
            'display'  => 1,
            'roles'=> ['su','admin']
        ];

        $this->fieldspec['created_by'] = [
            'type'        => 'relationLogRecord',
            'model'       => 'AdminUser',
            'foreign_key' => 'id',
            'label_key'   => 'email',
            'field_date'  => 'created_at',
            'label'       => trans('admin.label.created_by'),
            'hidden'      => 0,
            'required'    => false,
            'display'     => 1,
        ];
        $this->fieldspec['updated_by'] = [
            'type'        => 'relationLogRecord',
            'model'       => 'AdminUser',//
            'foreign_key' => 'id',
            'label_key'   => 'email',
            'field_date'  => 'updated_at',
            'label'       => trans('admin.label.updated_by'),
            'hidden'      => 0,
            'required'    => false,
            'display'     => 1,
        ];

        $this->fieldspec['seo_title']       = [
            'type'     => 'seo_string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.seo.title'),
            'display'  => 1,
            'max'      => 65
        ];
        $this->fieldspec['seo_description'] = [
            'type'     => 'seo_text',
            'size'     => 600,
            'h'        => 300,
            'hidden'   => 0,
            'label'    => trans('admin.seo.description'),
            'cssClass' => 'no',
            'display'  => 1,
        ];
        $this->fieldspec['seo_keywords']       = [
            'type'     => 'seo_text',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.seo.keywords'),
            'display'  => 1,
            'max'      => 255
        ];

        $this->fieldspec['seo_no_index']    = [
            'type'     => 'boolean',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.seo.no-index'),
            'display'  => 1
        ];
        $this->fieldspec['seo_canonical']    = [
            'type'     => 'string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => "Canonical",
            'display'  => 1
        ];
        /**
         * Another table attrib
         */
//        if(request()->is('*/edit/*')){
//            $this->getFieldSpecOfAttr();
//        }

        return $this->fieldspec;
    }


}
