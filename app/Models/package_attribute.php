<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class package_attribute extends Model
{
    protected $fillable = [
        'product_id',
        'package_id',
        'attribute_id',
        'value',
    ];

    public function product(){
        return $this->belongsTo(product::class);
    }
    public function package(){
        return $this->belongsTo(package::class);
    }
    public function attribute(){
        return $this->belongsTo(attribute::class);
    }
}
