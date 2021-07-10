<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Paket;
use Illuminate\Http\Request;
use DataTables;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Jadwal::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $button = '<div class="btn-group btn-group-sm" role="group">';

                        if($row->tgl_keberangkatan < date('Y-m-d')) {
                            $button .= '<i class="far fa-frown" style="color: #3C5186"></i>';
                        } else {                            
                            if($row->status_jadwal == 1)
                            {
                                $button .= '<button href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Setuju" class="setuju btn btn-warning btn-sm setuju-post"><i class="fas fa-power-off"></i></button>';
                            } else {
                                $button .= '<button href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Setuju" class="setuju btn btn-success btn-sm setuju-post"><i class="fas fa-plug"></i></button>';
                            }
                            $button .= '<button href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="fas fa-edit"></i></button>';
                            // $button .= '<button type="button" name="delete" id="'.$row->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>';
                        }
                        $button .= '</div>';

                        return $button;
                    })
                    ->editColumn('paket_id', function($row) {
                        return $row->paket->nama_paket.': '.(($row->paket->bus == null) ? $row->paket->pesawat->nama_pesawat : $row->paket->bus->nama_bus);
                    })
                    ->editColumn('tgl_keberangkatan', function($row) {
                        return $this->hari(date('D', strtotime($row->tgl_keberangkatan))).', '.$this->tanggal($row->tgl_keberangkatan).' - '.$row->jam_keberangkatan;
                    })
                    ->editColumn('status_jadwal', function($row) {
                        if($row->tgl_keberangkatan < date('Y-m-d'))
                        {
                            return '<span class="badge badge-danger">Jadwal Sudah Berakhir</span>';
                        } else {
                            if($row->status_jadwal == 1)
                            {
                                return '<span class="badge badge-success">Jadwal Aktif</span>';
                            } else {
                                return '<span class="badge badge-warning">Jadwal Tidak Aktif</span>';
                            }
                        }
                    })
                    ->rawColumns(['action','status_jadwal'])
                    ->make(true);
        }
        $pakets = Paket::all();
        return view('jadwal.index', compact(
            'pakets'
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

        $post = Jadwal::updateOrCreate(['id' => $id],[
            'paket_id' => $request->paket_id,
            'tgl_keberangkatan' => $request->tgl_keberangkatan,
            'jam_keberangkatan' => $request->jam_keberangkatan,
            'status_jadwal' => 1,
        ]);

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Jadwal::whereId($id)->first();

        return response($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cek_jadwal = Jadwal::find($id);
        if($cek_jadwal->status_jadwal == 1)
        {
            $put = Jadwal::whereId($id)->update([
                'status_jadwal' => 2,
            ]);

            return response($put);
        } else {
            $put = Jadwal::whereId($id)->update([
                'status_jadwal' => 1,
            ]);

            return response($put);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        //
    }

    public function tanggal($tanggal)
    {
        $bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
        $split = explode('-', $tanggal);
        return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    }

    public function hari($day)
    {
        switch($day) {
            case 'Sun':
                return 'Minggu';
            case 'Mon':
                return 'Senin';
            case 'Tue':
                return 'Selasa';
            case 'Wed':
                return 'Rabu';
            case 'Thu':
                return 'Kamis';
            case 'Fri':
                return 'Jum\'at';
            case 'Sat':
                return 'Sabtu';
            default:
                return 'Not Found';
        }
    }

    public function get_jadwal_by_paket($id)
    {
        $jadwals = Jadwal::where('paket_id', $id)
                        ->where('status_jadwal',1)
                        ->where('tgl_keberangkatan','>',date('Y-m-d'))
                        ->get();

        $arr = [];
        foreach($jadwals as $data)
        {
            $a['id'] = $data->id;
            $a['text'] = $this->hari(date('D', strtotime($data->tgl_keberangkatan))).', '.$this->tanggal($data->tgl_keberangkatan).' - '.$data->jam_keberangkatan;
            array_push($arr, $a);
        }

        return response()->json([
            'results' => $arr
        ]);
    }
}
