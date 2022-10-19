<?php namespace App\Model;

use App\FromSky\Builders\FromSkyCmsBuilder;
use App\FromSky\Builders\ProductBuilder;
use App\FromSky\DomainLayer\Category\CategoryPresenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\FromSky\Translatable\GFTranslatableHelper;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


/**
 * @mixin Builder
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder|static query()
 * @method static static make(array $attributes = [])
 * @method static static create(array $attributes = [])
 * @method static static forceCreate(array $attributes)
 * @method static firstOrNew(array $attributes = [], array $values = [])
 * @method static firstOrFail($columns = ['*'])
 * @method static firstOrCreate(array $attributes, array $values = [])
 * @method static firstOr($columns = ['*'], \Closure $callback = null)
 * @method static firstWhere($column, $operator = null, $value = null, $boolean = 'and')
 * @method static updateOrCreate(array $attributes, array $values = [])
 * @method null|static first($columns = ['*'])
 * @method static static findOrFail($id, $columns = ['*'])
 * @method static static findOrNew($id, $columns = ['*'])
 * @method static null|static find($id, $columns = ['*'])
 *
 * @property-read int $id
 *
 *
 * @method static findBySlug($slug, string $getLocale)
 */
class Category extends Model
{
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
    use Translatable;
    use GFTranslatableHelper;
    use CategoryPresenter;

    protected $with = ['translations'];

    protected       $fillable  = ['title', 'description', 'abstract', 'slug', 'sort', 'pub', 'parent_id', 'created_by', 'updated_by'];
    protected array $fieldspec = [];

    /*
    |--------------------------------------------------------------------------
    |  Sluggable & Translatable
    |--------------------------------------------------------------------------
    */
    public array $translatedAttributes = ['title', 'slug', 'description', 'seo_title', 'seo_description'];
    public array $sluggable            = ['slug' => ['field' => 'title', 'updatable' => false, 'translatable' => true]];

    /*
    |--------------------------------------------------------------------------
    |  RELATION
    |--------------------------------------------------------------------------
    */

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function news()
    {
        return $this->hasMany('App\Model\News', 'category_id');
    }

    public function media()
    {
        return $this->morphMany('App\Model\Media', 'model');
    }

    /*public function products()
    {
        return $this->hasMany('App\Model\Product');
    }*/

    /*
    |--------------------------------------------------------------------------
    |  Builder & Repo
    |--------------------------------------------------------------------------
    */
    function newEloquentBuilder($query)
    {
        return new FromSkyCmsBuilder($query);
    }

    /*
    |--------------------------------------------------------------------------
    |  Fieldspec for admin form
    |--------------------------------------------------------------------------
    */
    function getFieldSpec()
    {
        $this->fieldspec['id'] = [
            'type'     => 'integer',
            'minvalue' => 0,
            'pkey'     => 'y',
            'required' => true,
            'label'    => trans('admin.label.id'),
            'hidden'   => 1,
            'display'  => 0,
        ];
        /*$this->fieldspec['parent_id'] = [
            'type'        => 'relation',
            'model'       => 'category',
            'foreign_key' => 'id',
            'label_key'   => 'title',
            'required'    => 0,
            'label'       => trans('admin.label.category'),
            'hidden'      => 0,
            'display'     => 1,
        ];*/

        $this->fieldspec['parent_id'] = [
            'type'        => 'relation_tree',
            'tree_field'  => 'parent_id',
            'order_field' => 'sort',
            'model'       => 'category',
            'foreign_key' => 'id',
            'label_key'   => 'title',
            'required'    => 1,
            'label'       => trans('admin.label.parent'),
            'hidden'      => 0,
            'display'     => 1,
        ];

        /* $this->fieldspec['model_type'] = [
             'type'        => 'select',
             'pkey'        => 0,
             'required'    => 0,
             'hidden'      => 0,
             'label'       => trans('admin.label.type_category'),
             'display'     => 1,
             'select_data' => [
                 News::class       => trans('admin.models.news'),
                 Widget::class => trans('admin.models.widgets'),
             ]
         ];*/

        $this->fieldspec['title'] = [
            'type'     => 'string',
            'pkey'     => 0,
            'required' => 1,
            'hidden'   => 0,
            'label'    => trans('admin.label.title'),
            'display'  => 1,

        ];
        $this->fieldspec['slug']  = [
            'type'     => 'string',
            'pkey'     => 0,
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.slug'),
            'display'  => 1,
        ];

        $this->fieldspec['description'] = [
            'type'     => 'text',
            'size'     => 600,
            'h'        => 300,
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.description'),
            'cssClass' => 'wysiwyg',
            'display'  => 1,
        ];

        $this->fieldspec['image'] = [
            'type'      => 'media',
            'pkey'      => 0,
            'required'  => false,
            'hidden'    => 0,
            'label'     => trans('admin.label.image'),
            'mediaType' => 'Img',
            'display'   => 1,
        ];


        $this->fieldspec['sort']            = [
            'type'     => 'integer',
            'required' => 0,
            'label'    => trans('admin.label.position'),
            'hidden'   => 0,
            'display'  => 1,
        ];
        $this->fieldspec['pub']             = [
            'type'     => 'boolean',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.publish'),
            'display'  => 1
        ];
        $this->fieldspec['seo_title']       = [
            'type'     => 'string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.seo.title'),
            'display'  => 1,
        ];
        $this->fieldspec['seo_description'] = [
            'type'     => 'text',
            'size'     => 600,
            'h'        => 300,
            'hidden'   => 0,
            'label'    => trans('admin.seo.description'),
            'cssClass' => 'no',
            'display'  => 1,
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

    function resolveMorphModelClass()
    {
        $model = (request()->has('model')) ? request()->get('model') : 'page';

        return get_class(getModelFromString($model));
    }

    /*
    |--------------------------------------------------------------------------
    |  Scopes & Mutator
    |--------------------------------------------------------------------------
    */

    public function scopePublished($query)
    {

        $query->where('pub', '=', 1)->orderBy('sort', 'ASC');
    }
}
