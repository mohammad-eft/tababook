<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class carts extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'order_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(product::class);
    }
    public function order()
    {
        return $this->belongsTo(orders::class, 'order_id');
    }
}
