<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class package extends Model
{
    protected $fillable = [
        'product_id',
        'image',
        'description',
        'summary',
        'count',
        'primary_price',
        'secondary_price',
        'show_in_home',
        'package_attribute_ids',
    ];


    public function attributes(){
        return $this->hasMany(attribute::class);
    }

    public function product(){
        return $this->belongsTo(product::class);
    }

    public function packageAttributes(){
        return $this->hasMany(package_attributes::class);
    }
}
