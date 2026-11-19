<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tb_sales', function (Blueprint $table) {
            // Menggunakan text() agar muat menampung detail identitas pembeli, kontak, & rincian DP
            $table->text('note')->nullable()->after('customer_name');
        });

        // Menambahkan opsi 'inden' ke enum payment_status
        DB::statement("ALTER TABLE tb_sales MODIFY COLUMN payment_status ENUM('paid', 'not paid', 'inden') NOT NULL DEFAULT 'not paid'");
    }

    public function down(): void
    {
        Schema::table('tb_sales', function (Blueprint $table) {
            $table->dropColumn('note');
        });

        DB::statement("ALTER TABLE tb_sales MODIFY COLUMN payment_status ENUM('paid', 'not paid') NOT NULL DEFAULT 'not paid'");
    }
};