
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_feature_values', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_feature_id')
                ->constrained('product_features')
                ->cascadeOnDelete();

            $table->string('name');

            // قیمت اصلی این مقدار یا ترکیب
            $table->unsignedBigInteger('original_price')->nullable();

            // قیمت ویژه این مقدار یا ترکیب
            $table->unsignedBigInteger('special_price')->nullable();

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index('product_feature_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_feature_values');
    }
};
