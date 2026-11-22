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
            if (!Schema::hasColumn('carts', 'feature_value_id')) {
                $table->unsignedBigInteger('feature_value_id')->nullable()->after('product_id');
                $table->index('feature_value_id', 'carts_feature_value_id_index');
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

            if (!Schema::hasColumn('carts', 'unit_price')) {
                $table->unsignedBigInteger('unit_price')->nullable();
            }

            if (!Schema::hasColumn('carts', 'line_total')) {
                $table->unsignedBigInteger('line_total')->nullable();
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('carts')) {
            return;
        }

        Schema::table('carts', function (Blueprint $table) {
            $columns = [
                'feature_value_id',
                'snapshot_title',
                'snapshot_options',
                'snapshot_sku',
                'unit_price',
                'line_total',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('carts', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
