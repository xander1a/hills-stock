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
       Schema::create('sales', function (Blueprint $table) {
    $table->id();
    $table->string('product_id');
    $table->integer('quantity');
    $table->string('customer_name')->nullable();
    $table->string('payment_method')->nullable();
    $table->string('status')->default('completed'); 
    $table->string('invoice_number')->unique();
    $table->string('transaction_id')->nullable();
    $table->string('seller_id')->nullable();
    $table->decimal('total_price', 10, 2);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
