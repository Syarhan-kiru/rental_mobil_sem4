<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;

    protected $table = 'penyewaan';
    protected $primaryKey = 'id_penyewaan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'id_penyewaan',
        'kode_user',
        'id_pelanggan',
        'id_mobil',
        'tanggal_sewa',
        'tanggal_kembali',
        'total_harga',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'kode_user', 'kode_user');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'id_mobil', 'id_mobil');
    }
}