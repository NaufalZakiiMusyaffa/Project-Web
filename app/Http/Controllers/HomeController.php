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
use DB;

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
        $pemeliharaan     = Pemeliharaan::where('status', '=', 2)->get();
        $transaksiac = TransaksiAutocare::get();
        $notif_pemeliharaan = Pemeliharaan::where('status','=', 1)->count();
        $total_pemeliharaan = Pemeliharaan::count();
        
        $data_pemeliharaan = Pemeliharaan::select(DB::raw("SUM(biaya) as total_biaya"), DB::raw("MONTHNAME(created_at) as month_name"))
                                        ->whereYear('created_at', date('Y'))
                                        ->where('status', '=', 2)
                                        ->groupBy(DB::raw("Month(created_at)"))
                                        ->pluck('total_biaya', 'month_name');
        $labels = $data_pemeliharaan->keys();
        $datas_graphics = $data_pemeliharaan->values();

        $data_transaksi = Transaksi::select(DB::raw("COUNT(*) as jumlah"), DB::raw("MONTHNAME(tgl_pinjam) as month_name"))
                                        ->whereYear('tgl_pinjam', date('Y'))
                                        ->groupBy(DB::raw("Month(tgl_pinjam)"))
                                        ->pluck('jumlah', 'month_name');
        $label_transaksi = $data_transaksi->keys();
        $transaksi_graphics = $data_transaksi->values();

        $data_transaksiac = Transaksi::select(DB::raw("COUNT(*) as jumlah"), DB::raw("MONTHNAME(tgl_pinjam) as month_name"))
                                        ->whereYear('tgl_pinjam', date('Y'))
                                        ->groupBy(DB::raw("Month(tgl_pinjam)"))
                                        ->pluck('jumlah', 'month_name');
        $label_transaksiac = $data_transaksiac->keys();
        $transaksiac_graphics = $data_transaksiac->values();

        $detail_karyawan = Karyawan::selectRaw('COUNT(CASE WHEN jk = "L"  THEN 1 ELSE NULL END) as "male",
                                                COUNT(CASE WHEN jk = "P" THEN 1 ELSE NULL END) as "female"')->get();
        $karyawan_pie[] = ['Laki-Laki','Perempuan'];
        foreach ($detail_karyawan as $key => $value) {
            $karyawan_pie[++$key] = ["Laki-Laki", (int)$value->male];
            $karyawan_pie[++$key] = ["Perempuan", (int)$value->female];
        }

        $detail_aset = Aset::selectRaw('COUNT(CASE WHEN status_aset = "Sedang dipinjam" THEN 1 ELSE NULL END) as "sdp",
                                        COUNT(CASE WHEN status_aset = "Siap digunakan" THEN 1 ELSE NULL END) as "sg",
                                        COUNT(CASE WHEN status_aset = "Digunakan" THEN 1 ELSE NULL END) as "dg",
                                        COUNT(CASE WHEN status_aset = "Rusak(Bisa diperbaiki)" THEN 1 ELSE NULL END) as "r",
                                        COUNT(CASE WHEN status_aset = "Sedang diperbaiki" THEN 1 ELSE NULL END) as "sd",
                                        COUNT(CASE WHEN status_aset = "Rusak Total" THEN 1 ELSE NULL END) as "rt"')->get();
        $aset_pie[] = ['status_aset','jumlah'];
        foreach ($detail_aset as $key => $value) {
            $aset_pie[++$key] = ["Sedang dipinjam", (int)$value->sdp];
            $aset_pie[++$key] = ["Siap digunakan", (int)$value->sg];
            $aset_pie[++$key] = ["Digunakan", (int)$value->dg];
            $aset_pie[++$key] = ["Rusak(Bisa diperbaiki)", (int)$value->r];
            $aset_pie[++$key] = ["Sedang diperbaiki", (int)$value->sd];
            $aset_pie[++$key] = ["Rusak Total", (int)$value->rt];
        }

        $detail_asetac = Autocare::selectRaw('COUNT(CASE WHEN status_kendaraan = "Sedang dipinjam" THEN 1 ELSE NULL END) as "sdp",
                                        COUNT(CASE WHEN status_kendaraan = "Siap digunakan" THEN 1 ELSE NULL END) as "sg",
                                        COUNT(CASE WHEN status_kendaraan = "Digunakan" THEN 1 ELSE NULL END) as "dg",
                                        COUNT(CASE WHEN status_kendaraan = "Ada Kerusakan" THEN 1 ELSE NULL END) as "ak"')->get();
        $asetac_pie[] = ['status_kendaraan','jumlah'];
        foreach ($detail_asetac as $key => $value) {
            $asetac_pie[++$key] = ["Sedang dipinjam", (int)$value->sdp];
            $asetac_pie[++$key] = ["Siap digunakan", (int)$value->sg];
            $asetac_pie[++$key] = ["Digunakan", (int)$value->dg];
            $asetac_pie[++$key] = ["Ada Kerusakan", (int)$value->ak];
        }
        
        if (Auth::user()->level == 'it') {
            $datas = Transaksi::where('status', 'pinjam')
                ->where('karyawan_id', Auth::user()->karyawan_id)->get();
        } else {
            $datas = Transaksi::where('status', 'pinjam')->get();
        }
        $asetacs = Autocare::whereRaw('(DATE_SUB(masaberlaku_stnk, INTERVAL 3 DAY)) >= CURRENT_DATE() AND (DATE_SUB(masaberlaku_stnk, INTERVAL 3 DAY)) <= CURRENT_DATE()')
                                ->where('send_notif',0)->get();
        // dd($asetacs);
        $akuns = User::where('level','autocare')->with('karyawan')->get();
        
        if (count($asetacs) > 0) {
            foreach ($asetacs as $asetac) {           
                foreach ($akuns as $akun) {
                    $inventariske = $asetac->karyawan ? $asetac->karyawan->nama : '-';
                    Autocare::find($asetac->id)->update(['send_notif' => 1]);
                    Mail::to($akun->email)->send(new AsetacNotify($asetac->nama_kendaraan,$asetac->nopol,$inventariske));
                    $curl = curl_init();
                    $token = \config('app.whatsapp_token');
                    $data = [
                        'target' => $akun->karyawan->telepon,
                        'message' => "Kendaraan $asetac->nama_kendaraan dengan Nomor Polisi $asetac->nopol yang diinventariskan kepada ".$inventariske." Masa Berlaku STNK nya tinggal 3 hari lagi"
                    ];
                    curl_setopt(
                        $curl,
                        CURLOPT_HTTPHEADER,
                        array(
                            "Authorization: $token",
                        )
                    );
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                    curl_setopt($curl, CURLOPT_URL, "https://api.fonnte.com/send");
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_exec($curl);
                    curl_close($curl);
                };
            }
        }

        return view('home', compact('transaksi', 'karyawan', 'aset', 'kategori', 'user', 'driver', 'pemeliharaan', 'transaksiac', 'datas', 'notif_pemeliharaan', 'total_pemeliharaan', 'labels', 'datas_graphics', 'karyawan_pie', 'aset_pie', 'asetac_pie', 'label_transaksi', 'transaksi_graphics', 'label_transaksiac', 'transaksiac_graphics'));
    }
}
