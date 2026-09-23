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
        Schema::create('tb_daily_closings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cashier_id')->constrained('tb_users')->onDelete('cascade');
            $table->bigInteger('physical_cash')->unsigned();
            $table->bigInteger('system_cash')->unsigned();
            $table->bigInteger('discrepancy')->unsigned();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_daily_closings');
    }
};
