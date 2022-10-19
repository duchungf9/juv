<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;
use App\FromSky\Translatable\GFTranslatableHelper;

class ProductModel extends Model
{

    use Translatable;
    use GFTranslatableHelper;


    public array $translatedAttributes = ['title','description'];
    protected $fillable  = ['product_id','title','description','sort','pub'];
    protected array $fieldspec = [];

    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }
    public function finishing()
    {
        return $this->belongsTo('App\Model\Template');
    }

    /*
    |--------------------------------------------------------------------------
    |  Fieldspec for admin form
    |--------------------------------------------------------------------------
    */
    function getFieldSpec (): array
    {

        $this->fieldspec['id'] = [
            'type'     => 'integer',
            'minvalue' => 0,
            'pkey'     => 'y',
            'required' => 1,
            'label'    => 'id',
            'hidden'   => 1,
            'display'  => 0,
        ];
        $this->fieldspec['product_id'] = [
            'type'        => 'relation',
            'model'       => 'Product',
            'foreign_key' => 'id',
            'label_key'   => 'title',
            'label'       => 'Product',
            'hidden'      => 0,
            'required'    => 1,
            'display'     => 1,

        ];
        $this->fieldspec['title'] = [
            'type'     => 'string',
            'required' => 1,
            'hidden'   => 0,
            'label'    => 'title',
            'display'  => 1,
        ];
        $this->fieldspec['description'] = [
            'type'      => 'text',
            'size'      => 600,
            'h'         => 300,
            'required'  => 0,
            'hidden'    => 0,
            'label'     => 'Description',
            'cssClass'  => 'wysiwyg',
            'display'   => 1,
        ];
        $this->fieldspec['image'] = [
            'type'      => 'media',
            'required'  => 0,
            'hidden'    => 0,
            'label'     => 'Image',
            'mediaType' => 'Img',
            'display'   => 1
        ];

        $this->fieldspec['sort'] = [
            'type'     => 'integer',
            'required' => 0,
            'label'    => 'Order',
            'hidden'   => 0,
            'display'  => 1,
        ];
        $this->fieldspec['pub'] = [
            'type'     => 'boolean',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.publish'),
            'display'  => 1
        ];

        return $this->fieldspec;
    }
}
