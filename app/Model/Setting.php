<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * @var array
     */
    protected $fillable  = ['value','key','template','description'];
    public array $clone_exempt_attributes = ['key'];
    /**
     * @var array
     */
    protected array $fieldspec = [];

    /*
    |--------------------------------------------------------------------------
    |  Fieldspec for admin form
    |--------------------------------------------------------------------------
    */
    public function getFieldSpec (): array
    {

        $this->fieldspec['id'] = [
            'type'     => 'integer',
            'minvalue' => 0,
            'pkey'     => 'y',
            'required' =>true,
            'label'    => 'id',
            'hidden'   => 1,
            'display'  => 0,
        ];
        $this->fieldspec['template'] = [
            'type'      => 'string',
            'required'  => false,
            'hidden'    => 0,
            'label'     => 'Template',
            'display'   => 1,
        ];
        $this->fieldspec['key'] = [
            'type'      => 'string',
            'required'  => true,
            'hidden'    => 0,
            'label'     => 'Key',
            'display'   => 1,
        ];
/*        $this->fieldspec['value'] = [
            'type'      => 'string',
            'required'  => 0,
            'hidden'    => 0,
            'label'     => 'Value',
            'display'   => 1,
        ];*/

        $this->fieldspec['value'] = [
            'type'      => 'text',
            'size'      => 600,
            'h'         => 600,
            'required'  => false,
            'hidden'    => 0,
            'label'     => 'Value',
            'cssClass'  => '',
            'display'   => 1,
        ];

        $this->fieldspec['description'] = [
            'type'      => 'text',
            'size'      => 600,
            'h'         => 300,
            'required'  => false,
            'hidden'    => 0,
            'label'     => 'Description',
            'cssClass'  => '',
            'display'   => 1,
        ];
        return $this->fieldspec;
    }
}
