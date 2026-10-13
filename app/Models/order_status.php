<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_status extends Model
{
    protected $fillable = [
        'title',
        'admin_title',
        'color'
    ];
    public function orders(){
        return $this->hasMany(orders::class, 'order_status_id');
    }
}
