<?php

namespace App\FromSky\Svisit\src\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $guarded = [];
    protected $casts = ['list' => 'array'];
    protected $dates = ['expired_at'];

}
