<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'summary',
        'primary_price',
        'secondary_price',
        'count',
        'show_in_home',
    ];
    public function media()
    {
        return $this->hasMany(product_media::class);
    }
    public function categories()
    {
        return $this->belongsToMany(category::class, 'category_products');
    }
    public function attributes()
    {
        return $this->hasMany(product_attributes::class);
    }
    public function carts()
    {
        return $this->hasMany(carts::class);
    }
}
