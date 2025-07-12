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
        Schema::create('sales_carts', function (Blueprint $table) {
            $table->id();
            $table->string('session_id'); // To group items for one sale session
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->text('notes')->nullable();
            $table->enum('export_type', ['payed', 'debt', 'free'])->default('payed');
            $table->timestamp('sale_date')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            
            // Indexes
            $table->index('session_id');
            $table->index(['session_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_carts');
    }
};