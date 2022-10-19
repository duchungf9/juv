<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 * @package App
 */
class Error extends Model
{
    protected $fillable = ['message', 'file', 'line', 'trace'];
    protected array $fieldspec = [];



    public $sluggable            =  [];

    /*
    |--------------------------------------------------------------------------
    |  Fieldspec for admin form
    |--------------------------------------------------------------------------
    */
    function getFieldSpec(): array
    {
        return $this->fieldspec;
    }
}
