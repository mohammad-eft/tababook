<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    protected $fillable = [
        'product_id',
        'attribute_id',
        'parent_value_id',
        'name',
        'type',
        'sort_order',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(product::class);
    }

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(attribute::class);
    }

    // مقادیر متعلق به این ویژگی
    public function values(): HasMany
    {
        return $this
            ->hasMany(ProductFeatureValue::class)
            ->orderBy('sort_order');
    }

    // مقدار والد این ویژگی؛ برای ویژگی ریشه null است.
    public function parentValue(): BelongsTo
    {
        return $this->belongsTo(
            ProductFeatureValue::class,
            'parent_value_id'
        );
    }

    // ویژگی‌هایی که زیرمجموعه یکی از مقادیر این ویژگی هستند.

    public function childFeatures()
    {
        return $this->hasManyThrough(
            self::class,
            ProductFeatureValue::class,
            'product_feature_id',
            'parent_value_id',
            'id',
            'id'
        )->orderBy('sort_order');
    }
}
