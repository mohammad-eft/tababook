<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class attribute extends Model
{
    protected $fillable = [
        'product_id',
        'category_id',
        'package_id',
        'key',
    ];

    public function product(){
        return $this->belongsTo(product::class);
    }

    public function category(){
        return $this->belongsTo(category::class);
    }

    public function package(){
        return $this->belongsTo(package::class);
    }

    public function packageAttributes(){
        return $this->hasMany(package_attributes::class);
    }
}
