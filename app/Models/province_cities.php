<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class province_cities extends Model
{
    protected $fillable = [
        'parent',
        'title'
    ];

    public function province(){
        return $this->belongsTo(province_cities::class, 'parent');
    }

    public function cities(){
        return $this->hasMany(province_cities::class, 'parent');
    }

    public function addresses(){
        return $this->hasMany(address::class, 'city_id');
    }
}
