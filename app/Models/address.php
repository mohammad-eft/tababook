<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    protected $fillable = [
        'user_id',
        'city_id',
        'address',
        'postalCode',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function carts(){
        return $this->hasMany(carts::class);
    }

    public function city(){
        return $this->belongsTo(province_cities::class, 'city_id');
    }
}
