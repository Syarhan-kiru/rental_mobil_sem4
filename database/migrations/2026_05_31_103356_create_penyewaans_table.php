<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('penyewaan', function (Blueprint $table) {
            $table->id('id_penyewaan'); // Primary Key
            $table->unsignedBigInteger('kode_user');     // FK ke users
            $table->unsignedBigInteger('id_pelanggan');  // FK ke pelanggan
            $table->unsignedBigInteger('id_mobil');      // FK ke mobil
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali')->nullable();
            $table->integer('total_harga');
            $table->enum('status', ['berjalan', 'selesai'])->default('berjalan');

            // Relasi foreign key
            $table->foreign('kode_user')->references('kode_user')->on('users')->onDelete('cascade');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
            $table->foreign('id_mobil')->references('id_mobil')->on('mobil')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyewaan');
    }
};
