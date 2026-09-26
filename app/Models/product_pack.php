<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_pack extends Model
{
    protected $fillable = [
        'product_id',
        'pack_id',
    ];
}
