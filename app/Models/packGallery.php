<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class packGallery extends Model
{
    protected $fillable = [
        'image',
        'pack_id'
    ];

    public function pack(){
        return $this->belongsTo(pack::class);
    }
}
