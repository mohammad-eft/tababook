<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('carts')) {
            return;
        }

        Schema::table('carts', function (Blueprint $table) {
            // این ستون‌ها ممکن است توسط migration قبلی اضافه شده باشند.
            if (!Schema::hasColumn('carts', 'feature_value_id')) {
                $table->foreignId('feature_value_id')
                    ->nullable()
                    ->after('product_id')
                    ->constrained('product_feature_values')
                    ->nullOnDelete();
            }

            if (!Schema::hasColumn('carts', 'selected_features')) {
                $table->json('selected_features')->nullable()->after('feature_value_id');
            }

            if (!Schema::hasColumn('carts', 'unit_price')) {
                $table->unsignedBigInteger('unit_price')->nullable()->after('quantity');
            }

            if (!Schema::hasColumn('carts', 'snapshot_title')) {
                $table->string('snapshot_title')->nullable();
            }

            if (!Schema::hasColumn('carts', 'snapshot_options')) {
                $table->json('snapshot_options')->nullable();
            }

            if (!Schema::hasColumn('carts', 'snapshot_sku')) {
                $table->string('snapshot_sku')->nullable();
            }

            if (!Schema::hasColumn('carts', 'line_total')) {
                $table->unsignedBigInteger('line_total')->nullable();
            }
        });
    }

    public function down(): void
    {
        // عمداً ستون‌های مشترک با migrationهای قبلی حذف نمی‌شوند.
        // حذف آن‌ها ممکن است اطلاعات سفارش‌های ثبت‌شده را از بین ببرد.
    }
};
