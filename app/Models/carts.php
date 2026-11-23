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
        'product_variety_id',
        'pack_id',
        'quantity',
        'order_id',
        'selected_features',
        'snapshot_title',
        'snapshot_options',
        'snapshot_sku',
        'unit_price',
        'line_total',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'integer',
        'line_total' => 'integer',
        'selected_features' => 'array',
        'snapshot_options' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(orders::class, 'order_id');
    }

    public function pack(): BelongsTo
    {
        return $this->belongsTo(pack::class);
    }

    public function featureValue(): BelongsTo
    {
        return $this->belongsTo(ProductFeatureValue::class, 'feature_value_id');
    }
}
