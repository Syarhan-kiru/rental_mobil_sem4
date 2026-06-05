<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\mobil; // ✅ import model mobil

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
}
