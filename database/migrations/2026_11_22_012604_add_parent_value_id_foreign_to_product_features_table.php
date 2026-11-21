
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_features', function (Blueprint $table) {
            $table->foreign('parent_value_id')
                ->references('id')
                ->on('product_feature_values')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('product_features', function (Blueprint $table) {
            $table->dropForeign(['parent_value_id']);
        });
    }
};
