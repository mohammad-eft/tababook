<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_attributes extends Model
{
    protected $fillable = [
        'product_id',
        'attribute_key',
        'attribute_value',
    ];
}
