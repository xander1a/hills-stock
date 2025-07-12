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
    Schema::create('products', function (Blueprint $table) {
        $table->id();

        // Foreign key references - use foreignId() helper
       $table->unsignedBigInteger('main_category_id');
        $table->unsignedBigInteger('brand_id');
        $table->unsignedBigInteger('type_id');
        $table->unsignedBigInteger('user_id');

        // Product info
        $table->string('size_or_code');
        $table->string('name');
        $table->string('category');
        $table->text('description')->nullable();
        $table->decimal('price', 10, 2);
        $table->integer('total_quantity');
        $table->integer('min_stock')->nullable();
        $table->string('image_path')->nullable();
        $table->string('sku')->nullable();
        $table->string('supplier')->nullable();

        $table->timestamps();

        // Indexes
        $table->index(['main_category_id', 'brand_id', 'type_id']);
        $table->index('sku');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
