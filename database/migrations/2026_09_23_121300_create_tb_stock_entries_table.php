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
        Schema::create('tb_stock_entries', function (Blueprint $table) {
            $table->id();
            $table->string('entry_code')->unique();
            $table->string('supplier_name');
            $table->string('phone_number');
            $table->string('email');
            $table->text('adress');
            $table->enum('status', ['Active', 'Not Active'])->default('Active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_stock_entries');
    }
};
