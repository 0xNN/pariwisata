<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Paket;
use App\Models\PaketLokasi;
use Illuminate\Http\Request;
use DataTables;

class PaketLokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PaketLokasi::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $button = '<div class="btn-group btn-group-sm" role="group">';
                        $button .= '<button href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="fas fa-edit"></i></button>';
                        $button .= '<button type="button" name="delete" id="'.$row->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>';
                        $button .= '</div>';

                        return $button;
                    })
                    ->editColumn('paket_id', function($row) {
                        return $row->paket->nama_paket;
                    })
                    ->editColumn('lokasi_id', function($row) {
                        return $row->lokasi->nama_lokasi;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        $pakets = Paket::all();
        $lokasis = Lokasi::all();
        return view('paket-lokasi.index', compact(
            'pakets',
            'lokasis'
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

        $post = PaketLokasi::updateOrCreate(['id' => $id],[
            'paket_id' => $request->paket_id,
            'lokasi_id' => $request->lokasi_id
        ]);

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaketLokasi  $paketLokasi
     * @return \Illuminate\Http\Response
     */
    public function show(PaketLokasi $paketLokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaketLokasi  $paketLokasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $post  = PaketLokasi::where($where)->first();

        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaketLokasi  $paketLokasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaketLokasi $paketLokasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaketLokasi  $paketLokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $where = array('id' => $id);
        $post  = PaketLokasi::where($where)->delete();

        return response()->json($post);
    }
}
