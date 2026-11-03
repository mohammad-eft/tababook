<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->text('summary')->nullable();
            $table->integer('count')->default(1);
            $table->integer('primary_price')->nullable();
            $table->integer('secondary_price')->nullable();
            $table->tinyInteger('show_in_home')->default(0);
            $table->text('package_attribute_ids')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
