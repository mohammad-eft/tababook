<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class phone_code extends Model
{
    protected $fillable = [
        'phoneNumber',
        'code'
    ];
}
