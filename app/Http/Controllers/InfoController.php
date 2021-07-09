<?php

namespace App\Http\Controllers;

use App\Models\BusDetail;
use App\Models\Paket;
use App\Models\PaketLokasi;
use App\Models\PesawatDetail;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index($id)
    {
        $paket = Paket::where('id', $id)->first();
        $paket_lokasis = PaketLokasi::where('paket_id', $paket->id)->get();

        if($paket->bus_id == null) {
            $details = PesawatDetail::where('pesawat_id', $paket->pesawat->id)->get();
        } else {
            $details = BusDetail::where('bus_id', $paket->bus->id)->get();
        }
        
        return view('info.index', compact(
            'paket',
            'details',
            'paket_lokasis'
        ));
    }
}
