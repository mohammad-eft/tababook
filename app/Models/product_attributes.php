<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_attributes extends Model
{
    protected $fillable = [
        'product_id',
        // 'attribute_key',
        // 'attribute_value',
        'attribute_id',
        'input_type',
        'value',
    ];

    public function product(){
        return $this->belongsTo(product::class);
    }
    public function attribute(){
        return $this->belongsTo(attribute::class);
    }
}
