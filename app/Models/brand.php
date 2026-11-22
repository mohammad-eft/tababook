<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\product;

class brand extends Model
{
    public $fillable=[
        'title',
        'description',
        'logo_path',
        'is_active',
        'show_in_home',
    ];
    public function products(){
        return $this->hasMany(product::class);
    }
}
