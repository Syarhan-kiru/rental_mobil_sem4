<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';
    protected $primaryKey = 'id_pengembalian';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pengembalian',
        'id_penyewaan',
        'tanggal_dikembalikan',
        'kondisi_mobil',
        'denda',
        'total_bayar'
    ];

    // Relasi balik ke Penyewaan agar bisa tahu data Mobil & Pelanggan di View Index
    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class, 'id_penyewaan', 'id_penyewaan');
    }
}