<?php

namespace App\Http\Controllers;

use App\Models\BusDetail;
use Illuminate\Http\Request;

class BusDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if($request->hasfile('foto'))
        {
            foreach($request->file('foto') as $file)
            {
                // dd($file->hasName());
                $name = round(microtime(true)*1000).'-'.$file->getClientOriginalName();
                // dd(str_replace('\"', '', $name));
                $file->move(public_path('images'), $name);
                $f = new BusDetail;
                $f->bus_id = $request->bus_id;
                $f->foto = $name;
                $f->save();
            }

            return response()->json($f);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusDetail  $busDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        $bus_detail = BusDetail::where('bus_id', $id)->get();
        $foto = array();
        foreach($bus_detail as $data) 
        {
            array_push($foto, $data->foto);
        }
        return response()->json($foto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusDetail  $busDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(BusDetail $busDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusDetail  $busDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusDetail $busDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusDetail  $busDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusDetail $busDetail)
    {
        //
    }
}
