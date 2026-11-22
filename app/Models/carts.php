<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class carts extends Model
{
    protected $fillable = [
        'user_id',
        'guest_token',
        'product_id',
        'feature_value_id',
        'product_variant_id',
        'product_variety_id',
        'pack_id',
        'quantity',
        'order_id',
        'snapshot_title',
        'snapshot_options',
        'snapshot_sku',
        'unit_price',
        'line_total',
        'expires_at',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'feature_value_id' => 'integer',
        'product_variant_id' => 'integer',
        'snapshot_options' => 'array',
        'unit_price' => 'integer',
        'line_total' => 'integer',
        'expires_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(product::class);
    }

    public function featureValue(): BelongsTo
    {
        return $this->belongsTo(ProductFeatureValue::class, 'feature_value_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(orders::class, 'order_id');
    }

    public function pack(): BelongsTo
    {
        return $this->belongsTo(pack::class);
    }
}
