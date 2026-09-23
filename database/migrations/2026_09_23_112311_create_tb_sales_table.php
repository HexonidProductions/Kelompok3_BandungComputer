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
        Schema::create('tb_sales', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_number')->unique();
            $table->enum('sale_type', ['Offline', 'Online'])->default('Offline');
            $table->foreignId('cashier_id')->nullable()->constrained('tb_users')->onDelete('set null');
            $table->foreignId('customer_id')->nullable()->constrained('tb_users')->onDelete('set null');
            $table->text('shipping_adress');
            $table->enum('payment_method', ['Cash', 'Bank Transfer', 'QRIS']);
            $table->bigInteger('total_amount')->unsigned();
            $table->bigInteger('shipping_fee')->unsigned()->default(0);
            $table->enum('payment_status', ['Paid', 'Not Paid'])->default('Not Paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_sales');
    }
};
