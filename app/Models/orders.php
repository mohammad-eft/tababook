<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $fillable = [
        'address_id',
        'user_id',
        'order_status_id',
        'order_code',
        'date',
        'time'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function carts(){
        return $this->hasMany(carts::class, 'order_id');
    }
}
