<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Karyawan;
use App\TransaksiAutocare;
use App\Aset;
use App\Pemeliharaan;
use App\Driver;
use App\User;
use App\Kategori;
use Auth;


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
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $transaksi  = Transaksi::get();
        $karyawan   = Karyawan::get();
        $aset       = Aset::get();
        $kategori   = Kategori::get();
        $user       = User::get();
        $driver     = Driver::get();
        $pemeliharaan     = Pemeliharaan::where('status', '>', 0)->get();
        $transaksiac = TransaksiAutocare::get();

        if (Auth::user()->level == 'it') {
            $datas = Transaksi::where('status', 'pinjam')
                ->where('karyawan_id', Auth::user()->id)->get();
        } else {
            $datas = Transaksi::where('status', 'pinjam')->get();
        }
        return view('home', compact('transaksi', 'karyawan', 'aset', 'kategori', 'user', 'driver', 'pemeliharaan', 'transaksiac', 'datas'));
    }
}
