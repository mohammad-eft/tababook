
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_features', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            $table->foreignId('attribute_id')
                ->constrained('attributes')
                ->restrictOnDelete();

            // ویژگی زیرمجموعه کدام مقدار است؟
            // برای ویژگی اصلی مقدار null خواهد بود.
            $table->unsignedBigInteger('parent_value_id')->nullable();

            // نام و نوع ویژگی در زمان ثبت محصول
            $table->string('name');
            $table->string('type')->nullable();

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['product_id', 'attribute_id']);
            $table->index('parent_value_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_features');
    }
};
