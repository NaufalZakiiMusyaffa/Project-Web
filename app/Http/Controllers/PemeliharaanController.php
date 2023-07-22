<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PemeliharaanNotify;
use App\User;
use App\Aset;
use App\Pemeliharaan;
use App\Karyawan;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class PemeliharaanController extends Controller
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

        $datas = Pemeliharaan::get();

        $datapengajuan = Pemeliharaan::where('status', '=', 1)
        ->orderBy('created_at', 'asc')
        ->paginate(1);

        $antriandatapengajuan = Pemeliharaan::where('status', '=', 1)
        ->orderBy('created_at', 'asc')->get();

        return view('pemeliharaan.index', compact('datas', 'datapengajuan', 'antriandatapengajuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $getRow = Pemeliharaan::orderBy('id', 'DESC')->get();
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

        $pemeliharaans = Pemeliharaan::where('status', 1)->orWhere('status', 2)->get();
        $id_aset = array();
        foreach ($pemeliharaans as $pm) {
            $id_aset[] = $pm->aset_id;
        }

        $asets = Aset::where('status_aset', 'Rusak(Bisa diperbaiki)')->whereNotIn('id', $id_aset)->get();

        $users = User::get();
        return view('pemeliharaan.create', compact('asets', 'kode', 'statusx', 'users'));
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
            'aset_id' => 'required',
        ]);

        if ($request->file('gambar')) {
            $file = $request->file('gambar');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $acak;
            $request->file('gambar')->move("images/pemeliharaan", $fileName);
            $gambar = $fileName;
        } else {
            $gambar = NULL;
        }


        $pemeliharaan = Pemeliharaan::create([
            'kode_pemeliharaan' => $request->get('kode_pemeliharaan'),
            'aset_id'           => $request->get('aset_id'),
            'keterangan'        => $request->get('keterangan'),
            'biaya'             => $request->get('biaya'),
            'status'            => $request->get('status'),
            'yang_mengajukan'   => Auth::user()->karyawan->nama,
            'gambar'            => $gambar
        ]);

        $pemeliharaan->aset->where('id', $pemeliharaan->aset_id)
            ->update([
                'status_aset' => ($pemeliharaan->aset->status_aset),
            ]);

        $akuns = User::where('level','manager')->with('karyawan')->get();
        foreach ($akuns as $akun) {
            Mail::to($akun->email)->send(new PemeliharaanNotify());
            $curl = curl_init();
            $token = \config('app.whatsapp_token');
            $data = [
                'target' => $akun->karyawan->telepon,
                'message' => "".Auth::user()->karyawan->nama." telah mengajukan perbaikan"
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
        return redirect()->route('pemeliharaan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = Pemeliharaan::findOrFail($id);


        return view('pemeliharaan.show', compact('data'));
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

        $pemeliharaan = Pemeliharaan::find($id);

        Pemeliharaan::find($id)->update([
            'keputusan_oleh'  => Auth::user()->karyawan->nama,
            'status' => $request->get('status')
        ]);

        if ($request->get('status') == 2) {
            $pemeliharaan->aset->where('id', $pemeliharaan->aset->id)
                ->update([
                    'status_aset' => 'Sedang diperbaiki',
                ]);
        }

        alert()->success('Berhasil.', 'Data pengajuan telah di setujui');
        return redirect()->route('pemeliharaan.index');
    }

    /**
     * tolak the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tolak(Request $request, $id)
    {

        $pemeliharaan = Pemeliharaan::find($id);

        Pemeliharaan::find($id)->update([
            'keputusan_oleh'  => $request->get('keputusan_oleh'),
            'status' => '0'
        ]);

        $pemeliharaan->aset->where('id', $pemeliharaan->aset->id)
            ->update([
                'status_aset' => ($pemeliharaan->aset->status_aset),
            ]);

        alert()->info('Pengajuan ditolak');
        return redirect()->route('pemeliharaan.index');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pemeliharaan::find($id)->delete();
        alert()->success('Berhasil.', 'Data telah dihapus!');
        return redirect()->route('pemeliharaan.index');
    }
}
