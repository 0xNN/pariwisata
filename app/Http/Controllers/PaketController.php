<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Paket;
use App\Models\Pesawat;
use Illuminate\Http\Request;
use DataTables;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Paket::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $button = '<div class="btn-group btn-group-sm" role="group">';
                        $button .= '<button href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="fas fa-edit"></i></button>';
                        $button .= '<button type="button" name="delete" id="'.$row->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>';
                        $button .= '</div>';

                        return $button;
                    })
                    ->editColumn('bus_id', function($row) {
                        return ($row->bus_id == null) ? '': $row->bus->nama_bus;
                    })
                    ->editColumn('pesawat_id', function($row) {
                        return ($row->pesawat_id == null) ? '': $row->pesawat->nama_pesawat;
                    })
                    ->editColumn('harga_paket', function($row) {
                        if($row->bus_id == null) {
                            return 'Rp '.number_format($row->harga_paket, 0,'','.').',-+ Tiket Pesawat/PAX';
                        } else {
                            return 'Rp '.number_format($row->harga_paket, 0,'','.').',-/ PAX. MIN: '.$row->bus->minimum_pack.' PAX';
                        }
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        $buses = Bus::all();
        $pesawats = Pesawat::all();
        return view('paket.index', compact(
            'buses',
            'pesawats'
        ));
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
        $id = $request->id;

        $post = Paket::updateOrCreate(['id' => $id],[
            'nama_paket' => $request->nama_paket,
            'keterangan' => $request->keterangan,
            'bus_id' => ($request->bus_id == 'tidak_memilih') ? null: $request->bus_id,
            'pesawat_id' => ($request->pesawat_id == 'tidak_memilih') ? null: $request->pesawat_id,
            'harga_paket' => $request->harga_paket,
        ]);

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $where = array('pakets.id' => $id);
        $post  = Paket::select('pakets.*','minimum_pack','maksimum_pack','nama_bus','nama_pesawat')
                        ->leftjoin('pesawats','pesawats.id','pakets.pesawat_id')
                        ->leftjoin('buses','buses.id','pakets.bus_id')
                        ->where($where)
                        ->first();

        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $post  = Paket::where($where)->first();

        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paket $paket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Paket::where('id', $id)->delete();

        return response()->json($post);
    }
}
