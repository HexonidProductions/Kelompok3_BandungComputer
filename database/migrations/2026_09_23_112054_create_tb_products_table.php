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
        Schema::create('tb_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code')->unique();
            $table->string('product_name');
            $table->foreignId('category_id')->constrained('tb_categories')->onDelete('cascade');
            $table->string('image');
            $table->text('description')->nullable();
            $table->bigInteger('buy_price')->unsigned();
            $table->bigInteger('sell_price')->unsigned();
            $table->integer('stock')->unsigned();
            $table->enum('status', ['Available', 'Low stock', 'Out of stock'])->default('Available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_products');
    }
};
