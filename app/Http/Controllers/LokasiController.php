<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use DataTables;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Lokasi::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $button = '<div class="btn-group btn-group-sm" role="group">';
                        $button .= '<button href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="fas fa-edit"></i></button>';
                        $button .= '<button type="button" name="delete" id="'.$row->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>';
                        $button .= '</div>';

                        return $button;
                    })
                    ->editColumn('foto', function($row) {
                        return '<a target="_blank" href="'.asset('images/').'/'.str_replace('"','',$row->foto).'"><img src="'.asset('images/').'/'.str_replace('"','',$row->foto).'" style="width: 80px; height: 80px"></a>';
                    })
                    ->editColumn('hotel_id', function($row) {
                        return $row->hotel->nama_hotel;                    
                    })
                    ->rawColumns(['action','foto','hotel_id'])
                    ->make(true);
        }

        $hotels = Hotel::all();
        return view('lokasi.index', compact(
            'hotels'
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

        if($id == null) { //jika tambah data
            $name = round(microtime(true)*1000).'-'.$request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('images'), $name);
            $post = Lokasi::create([
                'nama_lokasi' => $request->nama_lokasi,
                'foto' => $name,
                'hotel_id' => $request->hotel_id
            ]);
    
            return response()->json($post);
        } else {
            if($request->file('foto') == null) // Jika edit tanpa foto
            {
                $post = Lokasi::where('id', $id)->update([
                    'nama_lokasi' => $request->nama_lokasi,
                    'hotel_id' => $request->hotel_id
                ]);
        
                return response()->json($post);
            } else { // Jika edit dengan foto baru
                $image = Lokasi::where('id', $id)->first();
                unlink(public_path('images/').'/'.str_replace('"','',$image->foto)); // Hapus foto lama

                $name = round(microtime(true)*1000).'-'.$request->file('foto')->getClientOriginalName();
                $request->file('foto')->move(public_path('images'), $name);
                $post = Lokasi::where('id', $id)->update([
                    'nama_lokasi' => $request->nama_lokasi,
                    'foto' => $name,
                    'hotel_id' => $request->hotel_id
                ]);
        
                return response()->json($post);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show(Lokasi $lokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $post  = Lokasi::where($where)->first();

        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lokasi $lokasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Lokasi::where('id', $id)->first();
        
        unlink(public_path('images/').'/'.str_replace('"','',$image->foto));
        $post = Lokasi::where('id', $id)->delete();

        return response()->json($post);
    }
}
