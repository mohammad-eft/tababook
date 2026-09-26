<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pack extends Model
{
    protected $fillable = [
        'title',
        'summary',
        'description',
        'primary_price',
        'secondary_price',
        'iamge',
    ];

    public function gallery(){
        return $this->hasMany(packGallery::class);
    }

    public function products(){
        return $this->belongsToMany(product::class);
    }
}
