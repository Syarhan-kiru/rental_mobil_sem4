<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\mobil;
use App\Models\Penyewaan;

class LaporanController extends Controller
{
    public function lapmobil()
    {
        $mobil = mobil::all();
        $pdf = Pdf::loadView('laporan/lapmobil', compact('mobil'));

        $pdf->setOption([
            'isRemoteEnabled' => true
        ]);

        return $pdf->download('laporan-mobil.pdf');
    }

    public function lappenyewaan()
{
    $penyewaan = Penyewaan::with(['pelanggan', 'mobil', 'user'])->get();
    $pdf = Pdf::loadView('laporan/lappenyewaan', compact('penyewaan'));

    $pdf->setOption([
        'isRemoteEnabled' => true
        ]);

    return $pdf->download('laporan-penyewaan.pdf');
}
}
