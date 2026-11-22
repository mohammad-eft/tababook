<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_feature_values', function (Blueprint $table) {
            $table->boolean('is_default')->default(false)->after('count');
        });
    }

    public function down(): void
    {
        Schema::table('product_feature_values', function (Blueprint $table) {
            $table->dropColumn('is_default');
        });
    }
};
