<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $fillable = [
        'en_title',
        'fa_title',
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
