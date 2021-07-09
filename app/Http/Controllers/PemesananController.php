<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Bus;
use App\Models\BusDetail;
use App\Models\Note;
use App\Models\Paket;
use App\Models\PaketLokasi;
use App\Models\Pembayaran;
use App\Models\PembayaranDetail;
use App\Models\Pemesanan;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use DataTables;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth()->user()->is_admin == 1)
        {
            if ($request->ajax()) {
                $data = Pemesanan::all();
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $button = '<div class="btn-group btn-group-sm" role="group">';
                            if($row->status == 0) {
                                $button .= '<button href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="setuju btn btn-success btn-sm edit-post"><i class="fas fa-check"></i></button>';
                            }
                            // $button .= '<button type="button" name="delete" id="'.$row->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>';
                            $button .= '<a target="_blank" href="'.route('pemesanan.print', $row->id).'" name="print" id="'.$row->id.'" class="print btn btn-info btn-sm"><i class="fas fa-print"></i></a>';
                            $button .= '</div>';
    
                            return $button;
                        })
                        ->editColumn('status', function($row) {
                            if($row->status == 1) {
                                return '<span class="badge badge-success">selesai</span>';
                            } else {
                                return '<span class="badge badge-warning">proses</span>';
                            }
                        })
                        ->editColumn('paket_id', function($row) {
                            return $row->paket->nama_paket;
                        })
                        ->editColumn('user_id', function($row) {
                            return $row->user->name.' / '.$row->user->institusi;
                        })
                        ->rawColumns(['action','status'])
                        ->make(true);
            }
    
            return view('pemesanan.admin.index');
        } else {
            $harga_termasuk = Note::where('status_termasuk', 1)->get();
            $harga_tidak_termasuk = Note::where('status_termasuk', 2)->get();
            $pakets = Paket::all();
            $bus_details = BusDetail::all();
            $paket_lokasis = PaketLokasi::all();
            $pemesanan = Pemesanan::where('status', 0)
                                    ->where('user_id', auth()->user()->id)
                                    ->orderBy('id','desc')->first();
            $buses = Bus::all();
            return view('pemesanan.user.index', compact(
                'pakets',
                'bus_details',
                'paket_lokasis',
                'harga_termasuk',
                'harga_tidak_termasuk',
                'pemesanan',
                'buses'
            ));
        }
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
        $post = Pemesanan::create([
            'kode_pemesanan' => $request->kode_pemesanan,
            'user_id' => $request->user_id,
            'paket_id' => $request->paket_id,
            'pax' => $request->pax,
            'tgl_pemesanan' => date('Y-m-d'),
            'status' => 0,
        ]);

        $p = Paket::where('id', $request->paket_id)->first();
        $pembayaran = Pembayaran::create([
            'kode_pembayaran' => 'PB'.round(microtime(true)*1000).'NN',
            'pemesanan_id' => $post->id,
            'status_pembayaran' => 0
        ]);

        $total_bayar = $p->harga_paket * $post->pax;
        $bayar[0] = $total_bayar * 30 / 100;
        $bayar[1] = $total_bayar * 50 / 100;
        $bayar[2] = $total_bayar * 20 / 100;

        for($i = 1; $i < 4; $i++)
        {
            PembayaranDetail::create([
                'pembayaran_id' => $pembayaran->id,
                'pembayaran_ke' => $i,
                'dibayar' => $bayar[$i-1],
                'bank_id' => null,
                'no_rekening' => null,
                'bukti_bayar' => null,
                'status_dibayar' => 0
            ]);
        }

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function show(Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $put = Pemesanan::whereId($id)->update([
            'status'=>1,
        ]);

        return response($put);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemesanan $pemesanan)
    {
        //
    }

    public function detail(Request $request, $id)
    {
        $pemesanan = Pemesanan::where('id', $id)->first();
        if ($request->ajax()) {
            $data = PembayaranDetail::where('pembayaran_id', $pemesanan->pembayaran->id)->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $button = '<div class="btn-group btn-group-sm" role="group">';
                        $button .= '<button href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-originial-title="Upload" class="upload btn btn-sm btn-success shadow-sm upload-post" id="tombol-upload"><i class="fas fa-upload"></i></button>';
                        if($row->status_dibayar == 1)
                        {
                            $button .= '<a target="_blank" href="'.route('pembayaran_detail.print', $row->id).'" name="print" id="'.$row->id.'" class="print btn btn-info btn-sm"><i class="fas fa-print"></i></a>';
                        }
                        $button .= '</div>';

                        return $button;
                    })
                    ->editColumn('status_dibayar', function($row) {
                        if($row->status_dibayar == 0)
                        {
                            return '<span class="badge badge-danger">Belum Dibayar</span>';
                        } else if($row->status_dibayar == 1) {
                            return '<span class="badge badge-success">Sudah Dibayar</span>';
                        } else {
                            return '<span class="badge badge-info">Menunggu Persetujuan</span>';
                        }
                    })
                    ->editColumn('dibayar', function($row) {
                        return 'Rp '.number_format($row->dibayar,0,',','.');
                    })
                    ->editColumn('bank_id', function($row) {
                        if($row->bank == null)
                        {
                            return '';
                        } else {
                            return $row->bank->nama_bank;
                        }
                    })
                    ->editColumn('bukti_bayar', function($row) {
                        if($row->bukti_bayar == null)
                        {
                            return '';
                        } else {
                            return '<a target="_blank" href="'.asset('images/').'/'.str_replace('"','',$row->bukti_bayar).'">Link</a>';
                        }
                    })
                    ->editColumn('pembayaran_id', function($row) {
                        return $row->pembayaran->kode_pembayaran;
                    })
                    ->rawColumns(['action','status_dibayar','bukti_bayar'])
                    ->make(true);
        }

        $banks = Bank::all();
        return view('pemesanan.user.detail', compact('pemesanan','banks'));
    }

    public function print($id)
    {
        $perusahaan = Perusahaan::first();
        $pemesanan = Pemesanan::where('id', $id)->first();
        $qrcode = base64_encode(QrCode::format('svg')
                        ->size(100)
                        ->errorCorrection('H')
                        ->generate($pemesanan->kode_pemesanan));

        $pdf = PDF::loadView('pemesanan.print', compact(
            'perusahaan',
            'pemesanan',
            'qrcode'
        ))->setPaper('a4','landscape');

        $path = public_path('pdf/');
        $filename = $pemesanan->kode_pemesanan.'.'.'pdf';
        $pdf->save($path.'/'.$filename);

        $pdf = public_path('pdf/'.$filename);
        return response()->make(file_get_contents($pdf), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);
    }
}
