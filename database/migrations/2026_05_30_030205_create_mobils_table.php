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
        Schema::create('mobil', function (Blueprint $table) {
            $table->string('id_mobil')->primary();
            $table->string('plat_nomor')->unique();
            $table->string('merek');
            $table->string('tipe');
            $table->integer('tahun');
            $table->integer('harga_sewa_sehari');
            $table->string('foto')->nullable();
            $table->enum('status', ['aktif', 'nonaktif','service','disewa'])->default('aktif');
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobil');
    }
};
