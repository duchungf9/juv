<?php namespace App\Model;

use App\FromSky\Translatable\GFTranslatableHelper;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;


class NewsAttributes extends Model
{

    use GFTranslatableHelper;
    use Translatable;

    protected       $table     = "news_attributes";
    protected       $with      = ['translations', 'newsAttributesValue'];
    protected       $fillable  = ['review_coin_id','news_id', 'title', 'type', 'default', 'field', 'pub', 'sort', 'created_by', 'updated_by'];
    protected array $fieldspec = [];

    /*
    |--------------------------------------------------------------------------
    |  Sluggable & Translatable
    |--------------------------------------------------------------------------
    */
    public array $translatedAttributes = [
        'title', 'default'];

    /*
    |--------------------------------------------------------------------------
    |  RELATIONS
    |--------------------------------------------------------------------------
    */

    public function newsAttributesValue()
    {
        return $this->hasMany('App\Model\NewsAttributesValue');
    }


    /*
    |--------------------------------------------------------------------------
    |  Fieldspec for admin form
    |--------------------------------------------------------------------------
    */
    function getFieldSpec(): array
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

        $this->fieldspec['news_id'] = [
            'type'        => 'relation',
            'model'       => 'News',
            //            'filter'      => ['model_type' => News::class],
            'foreign_key' => 'id',
            'label_key'   => 'title',
            'label'       => trans('admin.models.news'),
            'nullLabel'   => '--- Không thuộc bài nào ---',
            'hidden'      => 0,
            'required'    => false,
            'display'     => 1,
        ];

        $this->fieldspec['title'] = [
            'type'     => 'string',
            'pkey'     => 0,
            'required' => 1,
            'hidden'   => 0,
            'label'    => trans('admin.label.title'),
            'display'  => 1,

        ];

        $this->fieldspec['field'] = [
            'type'     => 'string',
            'pkey'     => 0,
            'required' => 1,
            'hidden'   => 0,
            'label'    => trans('admin.label.review_spec_key'),
            'display'  => 1,
        ];

        $this->fieldspec['type'] = [
            'type'        => 'select',
            'pkey'        => 0,
            'required'    => 1,
            'hidden'      => 0,
            'label'       => trans('admin.label.review_spec_type'),
            'display'     => 1,
            'select_data' => [
                'text'     => 'Text',
                'integer'  => 'Integer',
                'editor'   => 'Editor',
                'datetime' => 'Datetime',
                'date'     => 'Date',
                'readonly' => 'Read only',
                'string'   => 'String',
                'boolean'  => 'Boolean',
                'media'    => 'Media',
                'password' => 'Password',
            ]
        ];


        $this->fieldspec['default'] = [
            'type'     => 'text',
            'size'     => 600,
            'h'        => 300,
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.review_spec_default'),
            'cssClass' => 'wysiwyg',
            'display'  => 1,
        ];


        $this->fieldspec['sort']  = [
            'type'     => 'integer',
            'required' => 0,
            'label'    => 'Order',
            'hidden'   => 0,
            'display'  => 1,
        ];


        $this->fieldspec['pub'] = [
            'type'     => 'boolean',
            'required' => 1,
            'hidden'   => 0,
            'label'    => trans('admin.label.publish'),
            'display'  => 1
        ];

        return $this->fieldspec;
    }
}
