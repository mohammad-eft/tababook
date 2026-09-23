<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class contactUs extends Model
{
     protected $fillable=[
      'title',
      'description',
      'phoneNumber',
      'user_id'
    ];
    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
