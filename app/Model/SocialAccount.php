<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static firstWhere(array $providerAccount)
 */
class SocialAccount extends Model
{
    use HasFactory;
    protected array $fieldspec = [];
    protected $guarded=[];

    /*
    |--------------------------------------------------------------------------
    |  RELATION
    |--------------------------------------------------------------------------
    */
    public function user() {
        return $this->belongsTo('App\Model\User');
    }

    function getFieldSpec(): array
    {
        return $this->fieldspec;
    }
}
