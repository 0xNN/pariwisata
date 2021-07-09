<?php

namespace App\Http\Controllers;

use App\Models\HotelDetail;
use Illuminate\Http\Request;

class HotelDetailController extends Controller
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
                $name = round(microtime(true)*1000).'-'.$file->getClientOriginalName();
                $file->move(public_path('images'), $name);
                $f = new HotelDetail();
                $f->hotel_id = $request->hotel_id;
                $f->foto = $name;
                $f->save();
            }

            return response()->json($f);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HotelDetail  $hotelDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = HotelDetail::where('hotel_id', $id)->get();
        $foto = array();
        foreach($detail as $data) 
        {
            array_push($foto, $data->foto);
        }
        return response()->json($foto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HotelDetail  $hotelDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(HotelDetail $hotelDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HotelDetail  $hotelDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HotelDetail $hotelDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HotelDetail  $hotelDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(HotelDetail $hotelDetail)
    {
        //
    }
}
