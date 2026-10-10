<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $fillable = [
        'name',
        'family',
        'phoneNumber',
        'email',
        'nationalCode',
    ];
}
