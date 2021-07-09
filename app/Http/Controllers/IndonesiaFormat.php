<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndonesiaFormat extends Controller
{
    public static function tanggal($tanggal)
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

    public static function hari($day)
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
}
