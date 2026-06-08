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
    Schema::create('pengembalian', function (Blueprint $table) {
        $table->string('id_pengembalian')->primary(); 
        
        
        $table->string('id_penyewaan');
        $table->foreign('id_penyewaan')->references('id_penyewaan')->on('penyewaan')->onDelete('cascade');
        
        $table->date('tanggal_dikembalikan');
        $table->string('kondisi_mobil');
        $table->bigInteger('denda')->default(0);
        $table->bigInteger('total_bayar')->default(0);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
