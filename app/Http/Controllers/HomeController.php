<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\AsetacNotify;
use App\Transaksi;
use App\Karyawan;
use App\TransaksiAutocare;
use App\Aset;
use App\Pemeliharaan;
use App\Driver;
use App\User;
use App\Kategori;
use App\Autocare;
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
                ->where('karyawan_id', Auth::user()->karyawan_id)->get();
        } else {
            $datas = Transaksi::where('status', 'pinjam')->get();
        }
        $asetacs = Autocare::whereRaw('(DATE_SUB(masaberlaku_stnk, INTERVAL 3 DAY)) >= CURRENT_DATE() AND (DATE_SUB(masaberlaku_stnk, INTERVAL 3 DAY)) <= CURRENT_DATE()')
                                ->where('send_notif',0)->get();
        
        $akuns = User::where('level','autocare')->get();
        if (count($asetacs) > 0) {
            foreach ($asetacs as $asetac) {           
                foreach ($akuns as $akun) {
                    Autocare::find($asetac->id)->update(['send_notif' => 1]);
                    Mail::to($akun->email)->send(new AsetacNotify($asetac->nama_kendaraan,$asetac->nopol,$asetac->karyawan->nama));
                };
            }
        }

        return view('home', compact('transaksi', 'karyawan', 'aset', 'kategori', 'user', 'driver', 'pemeliharaan', 'transaksiac', 'datas'));
    }
}
