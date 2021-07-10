<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;
use PDF;

class LaporanController extends Controller
{
    public function pemesanan()
    {
        $pemesanans = Pemesanan::all();
        $pdf = PDF::loadView('laporan.pemesanan', compact(
            'pemesanans'
        ))->setPaper('a4','landscape');

        $path = public_path('pdf/');
        $filename = 'Laporan-'.round(microtime(true)*1000).'.'.'pdf';
        $pdf->save($path.'/'.$filename);

        $pdf = public_path('pdf/'.$filename);
        return response()->make(file_get_contents($pdf), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);
    }
}
