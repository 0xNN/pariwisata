<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\PembayaranDetail;
use App\Models\Pemesanan;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use DataTables;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth()->user()->is_admin == 1) {
            if ($request->ajax()) {
                $data = Pembayaran::all();
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $button = '<div class="btn-group btn-group-sm" role="group">';
                            if($row->status_pembayaran == 0)
                            {
                                $button .= '<button href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-url="'.route('pembayaran.update', $row->id).'" data-original-title="Edit" class="edit btn btn-success btn-sm edit-post"><i class="fas fa-check"></i></button>';
                            }
                            // $button .= '<button type="button" name="delete" id="'.$row->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>';
                            $button .= '<a href="javascript:void(0)" data-target="#myModal" data-url="'.route('pembayaran_detail.show', $row->id).'" data-toggle="modal" data-id="'.$row->id.'" data-original-title="View" class="view btn btn btn-warning btn-sm view-post"><i class="fas fa-eye"></i></a>';
                            $button .= '<a target="_blank" href="'.route('pembayaran.print', $row->id).'" name="print" id="'.$row->id.'" class="print btn btn-info btn-sm"><i class="fas fa-print"></i></a>';
                            $button .= '</div>';
    
                            return $button;
                        })
                        ->editColumn('status_pembayaran', function($row) {
                            if($row->status_pembayaran == 1) {
                                return '<span class="badge badge-success">lunas</span>';
                            } else {
                                return '<span class="badge badge-warning">belum lunas</span>';
                            }
                        })
                        ->editColumn('pemesanan_id', function($row) {
                            return $row->pemesanan->kode_pemesanan;
                        })
                        ->rawColumns(['action','status_pembayaran'])
                        ->make(true);
            }
    
            return view('pembayaran.admin.index');
        } else {
            if ($request->ajax()) {
                $data = Pemesanan::where('user_id', auth()->user()->id)->get();
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->editColumn('paket_id', function($row) {
                            return $row->paket->nama_paket;
                        })
                        ->editColumn('kode_pembayaran', function($row) {
                            return '<a target="_blank" href="'.route('pembayaran.print', $row->pembayaran->id).'"><span class="badge badge-danger">'.$row->pembayaran->kode_pembayaran.'</span></a>';
                        })
                        ->editColumn('kode_pemesanan', function($row) {
                            return '<a target="_blank" href="'.route('pemesanan.print', $row->id).'"><span class="badge badge-primary">'.$row->kode_pemesanan.'</span></a>';
                        })
                        ->editColumn('status', function($row) {
                            if($row->status == 1) {
                                return '<span class="badge badge-success">selesai</span>';
                            } else {
                                return '<span class="badge badge-warning">proses</span>';
                            }
                        })
                        ->rawColumns(['action','status','kode_pembayaran','kode_pemesanan'])
                        ->make(true);
            }
    
            return view('pembayaran.user.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $put = Pembayaran::where('id', $id)->update([
            'status_pembayaran' => 1
        ]);

        return response($put);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        //
    }

    public function print($id)
    {
        $perusahaan = Perusahaan::first();
        $pembayaran = Pembayaran::where('id', $id)->first();
        $pembayaran_detail = PembayaranDetail::where('pembayaran_id', $pembayaran->id)->get();
        $qrcode = base64_encode(QrCode::format('svg')
                        ->size(100)
                        ->errorCorrection('H')
                        ->generate($pembayaran->kode_pembayaran));

        $total = PembayaranDetail::where('pembayaran_id', $pembayaran->id)
                                    ->where('status_dibayar', 1)
                                    ->sum('dibayar');
        $pdf = PDF::loadView('pembayaran.print', compact(
            'perusahaan',
            'pembayaran',
            'qrcode',
            'pembayaran_detail',
            'total'
        ))->setPaper('a4','landscape');

        $path = public_path('pdf/');
        $filename = $pembayaran->kode_pembayaran.'.'.'pdf';
        $pdf->save($path.'/'.$filename);

        $pdf = public_path('pdf/'.$filename);
        return response()->make(file_get_contents($pdf), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);
    }
}
