<?php

namespace App\Http\Controllers;

use App\Models\Pesawat;
use App\Models\PesawatDetail;
use Illuminate\Http\Request;
use DataTables;

class PesawatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pesawat::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $button = '<div class="btn-group btn-group-sm" role="group">';
                        $button .= '<button href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="fas fa-edit"></i></button>';
                        $button .= '<button type="button" name="delete" id="'.$row->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>';
                        $button .= '<button href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-originial-title="Upload" class="upload btn btn-sm btn-success shadow-sm upload-post" id="tombol-upload"><i class="fas fa-upload"></i></button>';
                        $button .= '<a href="javascript:void(0)" data-target="#myModal" data-url="'.route('pesawat_detail.show', $row->id).'" data-toggle="modal" data-id="'.$row->id.'" data-original-title="View" class="view btn btn btn-warning btn-sm view-post"><i class="fas fa-eye"></i></a>';
                        $button .= '</div>';

                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('pesawat.index');
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

        $post = Pesawat::updateOrCreate(['id' => $id],[
            'nama_pesawat' => $request->nama_pesawat,
        ]);

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pesawat  $pesawat
     * @return \Illuminate\Http\Response
     */
    public function show(Pesawat $pesawat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pesawat  $pesawat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $post  = Pesawat::where($where)->first();

        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pesawat  $pesawat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesawat $pesawat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pesawat  $pesawat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = PesawatDetail::where('pesawat_id', $id)->get();
        
        foreach($image as $data)
        {
            unlink(public_path('images/').'/'.str_replace('"','',$data->foto));
        }
        $post = Pesawat::where('id', $id)->delete();

        PesawatDetail::where('pesawat_id', $id)->delete();
        return response()->json($post);
    }
}
