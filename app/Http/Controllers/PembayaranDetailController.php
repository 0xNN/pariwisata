<?php

namespace App\Http\Controllers;

use App\Models\PembayaranDetail;
use App\Models\Pemesanan;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use DataTables;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;

class PembayaranDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasfile('bukti_bayar'))
        {
            $name = round(microtime(true)*1000).'-'.$request->file('bukti_bayar')->getClientOriginalName();
            $request->file('bukti_bayar')->move(public_path('images'), $name);
            $f = PembayaranDetail::find($request->id);
            $f->bank_id = $request->bank_id;
            $f->no_rekening = $request->no_rekening;
            $f->bukti_bayar = $name;
            $f->status_dibayar = 2;
            $f->save();

            return response()->json($f);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PembayaranDetail  $pembayaranDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pembayaran_detail = PembayaranDetail::where('pembayaran_id', $id)->get();
        
        return response()->json($pembayaran_detail);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PembayaranDetail  $pembayaranDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PembayaranDetail $pembayaranDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PembayaranDetail  $pembayaranDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $put = PembayaranDetail::where('id', $id)->update([
            'status_dibayar' => 1
        ]);
        
        return response()->json($put);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PembayaranDetail  $pembayaranDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PembayaranDetail $pembayaranDetail)
    {
        //
    }

    public function print($id)
    {
        $perusahaan = Perusahaan::first();
        $pembayaran_detail = PembayaranDetail::where('id', $id)->first();
        $qrcode = base64_encode(QrCode::format('svg')
                        ->size(100)
                        ->errorCorrection('H')
                        ->generate($pembayaran_detail->pembayaran->kode_pembayaran.'-'.$pembayaran_detail->pembayaran_ke));

        $pemesanan = Pemesanan::where('id', $pembayaran_detail->pembayaran->pemesanan_id)->first();
        $pdf = PDF::loadView('pembayaran.detail.print', compact(
            'perusahaan',
            'pembayaran_detail',
            'qrcode',
            'pemesanan'
        ))->setPaper('a4','landscape');

        $path = public_path('pdf/');
        $filename = $pembayaran_detail->pembayaran->kode_pembayaran.'-'.$pembayaran_detail->pembayaran_ke.'.'.'pdf';
        $pdf->save($path.'/'.$filename);

        $pdf = public_path('pdf/'.$filename);
        return response()->make(file_get_contents($pdf), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);
    }
}
