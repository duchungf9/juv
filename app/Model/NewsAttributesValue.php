<?php namespace App\Model;

use App\FromSky\Translatable\GFTranslatableHelper;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class NewsAttributesValue extends Model
{

    use GFTranslatableHelper;
    use Translatable;

    protected array $fieldspec = [];
    protected $table = "news_attributes_value";
    protected $fillable = ['news_attributes_id', 'news_id', 'title', 'value', 'type', 'value', 'field', 'pub', 'created_by', 'updated_by'];
    protected $with = ['translations'];

    /*
    |--------------------------------------------------------------------------
    |  Sluggable & Translatable
    |--------------------------------------------------------------------------
    */
    public array $translatedAttributes = ['title', 'value','pub'];


    /*
    |--------------------------------------------------------------------------
    |  RELATIONS
    |--------------------------------------------------------------------------
    */

    public function newsAttributes()
    {
        return $this->belongsTo('App\Model\NewsAttributes', 'news_attributes_id', 'id');
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
            'pkey'     => 1,
            'required' => 1,
            'label'    => 'id',
            'hidden'   => 1,
            'display'  => 0,
        ];

        $this->fieldspec['title'] = [
            'type'     => 'string',
            'required' => 1,
            'hidden'   => 0,
            'label'    => trans('admin.label.title'),
            'display'  => 1,
        ];

        $this->fieldspec['value']  = [
            'type'     => 'string',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.slug'),
            'display'  => 1,
        ];

        $this->fieldspec['pub']   = [
            'type'     => 'boolean',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.publish'),
            'display'  => 1
        ];


        return $this->fieldspec;
    }
}
