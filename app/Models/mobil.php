<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mobil extends Model
{
    protected $table = 'mobil';
    protected $primaryKey = 'id_mobil';

    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'id_mobil',
        'plat_nomor',
        'merek',
        'tahun',
        'harga_sewa_sehari',
        'foto',
        'status'
    ];
}
