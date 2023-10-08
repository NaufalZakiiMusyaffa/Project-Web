<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PemeliharaanacNotify;
use App\User;
use App\Autocare;
use App\PemeliharaanAutocare;
use App\Karyawan;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class PemeliharaanAutocareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $datas = PemeliharaanAutocare::get();

        $datapengajuan = PemeliharaanAutocare::where('status', '=', 1)
        ->orderBy('created_at', 'asc')
        ->paginate(1);

        $antriandatapengajuan = PemeliharaanAutocare::where('status', '=', 1)
        ->orderBy('created_at', 'asc')->get();

        return view('pemeliharaanac.index', compact('datas', 'datapengajuan', 'antriandatapengajuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getRow = PemeliharaanAutocare::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "PMH-AST-00001";
        $statusx = "1";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "PMH-AST-0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "PMH-AST-000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "PMH-AST-00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "PMH-AST-0" . '' . ($lastId->id + 1);
            } else {
                $kode = "PMH-AST-" . '' . ($lastId->id + 1);
            }
        }

        $pemeliharaans = PemeliharaanAutocare::where('status', 1)->get();
        $id_asetac = array();
        foreach ($pemeliharaans as $pm) {
            $id_asetac[] = $pm->asetac_id;
        }

        $asetacs = Autocare::where('status_kendaraan', 'Ada Kerusakan')->whereNotIn('id', $id_asetac)->get();

        $users = User::get();
        return view('pemeliharaanac.create', compact('asetacs', 'kode', 'statusx', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_pemeliharaan' => 'required|string|max:255',
            'asetac_id' => 'required',
        ]);
        
        $dt = Carbon::now();

        if ($request->file('gambar')) {
            $file = $request->file('gambar');
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $acak;
            $request->file('gambar')->move("images/pemeliharaan", $fileName);
            $gambar = $fileName;
        } else {
            $gambar = null;
        }

        if ($request->file('video')) {
            $fileVideo = $request->file('video');
            $random  = $fileVideo->getClientOriginalExtension();
            $fileVideoName = rand(11111, 99999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $random;
            $request->file('video')->move("video/pemeliharaan", $fileVideoName);
            $video = $fileVideoName;
        } else {
            $video = null;
        }

        $pemeliharaanac = PemeliharaanAutocare::create([
            'kode_pemeliharaan' => $request->get('kode_pemeliharaan'),
            'asetac_id'         => $request->get('asetac_id'),
            'keterangan'        => $request->get('keterangan'),
            'biaya'             => $request->get('biaya'),
            'status'            => $request->get('status'),
            'yang_mengajukan'   => Auth::user()->karyawan->nama,
            'gambar'            => $gambar,
            'video'             => $video
        ]);

        $pemeliharaanac->asetac->where('id', $pemeliharaanac->asetac_id)
            ->update([
                'status_kendaraan' => ($pemeliharaanac->asetac->status_kendaraan),
            ]);

        $akuns = User::where('level','manager')->with('karyawan')->get();
        foreach ($akuns as $akun) {
            Mail::to($akun->email)->send(new PemeliharaanacNotify());
            $curl = curl_init();
            $token = \config('app.whatsapp_token');
            $data = [
                'target' => $akun->karyawan->telepon,
                'message' => "".Auth::user()->karyawan->nama." Telah mengajukan perbaikan aset Autocare Cek ke Sistem Management Aset untuk melihat detail pengajuannya"
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
        alert()->success('Berhasil.', 'Data telah ditambahkan!');
        return redirect()->route('autocare-maintenance.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = PemeliharaanAutocare::findOrFail($id);
        
        return view('pemeliharaanac.show', compact('data'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pemeliharaanac = PemeliharaanAutocare::find($id);

        PemeliharaanAutocare::find($id)->update([
            'keputusan_oleh'  => Auth::user()->karyawan->nama,
            'status'          => $request->get('status')
        ]);

        if ($request->get('status') == 2) {
            $pemeliharaanac->asetac->where('id', $pemeliharaanac->asetac->id)
                ->update([
                    'status_kendaraan' => 'Sedang diperbaiki',
                ]);
            alert()->success('Berhasil.', 'Data pengajuan telah di setujui');
        } else {
            alert()->info('Pengajuan ditolak');
        }

        return redirect()->route('autocare-maintenance.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pemeliharaanac = PemeliharaanAutocare::find($id);
        $pemeliharaanac->gambar ? unlink(public_path("images/pemeliharaan/".$pemeliharaanac->gambar)) : '';
        PemeliharaanAutocare::find($id)->delete();
        alert()->success('Berhasil.', 'Data telah dihapus!');
        return redirect()->route('autocare-maintenance.index');
    }
}
