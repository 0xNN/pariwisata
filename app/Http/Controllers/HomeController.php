<?php

namespace App\Http\Controllers;
use App\Models\Paket;
use App\Models\User;
use App\Models\Pemesanan;
use App\Models\Lokasi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if(auth()->user()->is_admin == 1) {
            $total_paket = $this->total_paket();
            $total_user = $this->total_user();
            $total_pemesanan = $this->total_pemesanan();
            $total_lokasi = $this->total_lokasi();

            return view('dashboard', compact(
                'total_paket',
                'total_user',
                'total_pemesanan',
                'total_lokasi'
            ));
        } else {
            return view('dashboard');
        }
    }

    public function total_paket()
    {
        $count = Paket::count();

        return $count;
    }

    public function total_user()
    {
        $count = User::whereNull('is_admin')->count();
        
        return $count;
    }

    public function total_pemesanan()
    {
        $count = Pemesanan::count();

        return $count;
    }

    public function total_lokasi()
    {
        $count = Lokasi::count();

        return $count;
    }
}
