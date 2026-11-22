<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductFeatureValue extends Model
{
    protected $fillable = [
        'product_feature_id',
        'name',
        'original_price',
        'special_price',
        'count',
        'is_default',
        'sort_order',
    ];

    protected $casts = [
        'original_price' => 'integer',
        'special_price' => 'integer',
        'count' => 'integer',
        'is_default' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function feature(): BelongsTo
    {
        return $this->belongsTo(ProductFeature::class, 'product_feature_id');
    }

    // ویژگی‌هایی که زیرمجموعه این مقدار هستند.
    public function childFeatures(): HasMany
    {
        return $this->hasMany(
            ProductFeature::class,
            'parent_value_id'
        )->orderBy('sort_order');
    }
}