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
    Schema::create('pengembalians', function (Blueprint $table) {
        // Primary Key sesuai gaya penamaan projectmu
        $table->string('id_pengembalian')->primary(); 
        
        // Foreign Key menyambung ke tabel penyewaans
        $table->string('id_penyewaan');
        $table->foreign('id_penyewaan')->references('id_penyewaan')->on('penyewaans')->onDelete('cascade');
        
        $table->date('tanggal_dikembalikan');
        $table->string('kondisi_mobil');
        $table->bigInteger('denda')->default(0);
        $table->bigInteger('total_payar')->default(0); // Menyesuaikan input name 'total_payar' / total_bayar
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};
