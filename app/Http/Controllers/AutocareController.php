<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Autocare;
use App\Kategori;
use App\Karyawan;
use App\TransaksiAutocare;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Excel;
use RealRashid\SweetAlert\Facades\Alert;

class AutocareController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->level == 'it') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        // if(Auth::user()->level == 'it')
        // {
        //     $datas2 = TransaksiAutocare::where('status', 'pinjam')
        //                         ->where('karyawan_id', Auth::user()->id)->get();
        // } else {
        //     $datas2 = TransaksiAutocare::where('status', 'pinjam')->get();
        // }

        $datas = Autocare::get();
        return view('asetac.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        if (Auth::user()->level == 'it') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        $getRow = Autocare::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "ATC00001";
        $siappakai = "Siap digunakan";
        $diinventariskan = "Diinventariskan";
        $rusak = "Ada Kerusakan";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "ATC0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "ATC000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "ATC00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "ATC0" . '' . ($lastId->id + 1);
            } else {
                $kode = "ATC" . '' . ($lastId->id + 1);
            }
        }

        $karyawans = Karyawan::where('id', '>', 0)->get();
        return view('asetac.create', compact('kode', 'siappakai', 'diinventariskan', 'rusak', 'karyawans'));
    }

    public function format()
    {
        $data = [['kode_aset' => null, 'nama_aset' => null, 'kategori' => null, 'merk' => null, 'status_aset' => null, 'spesifikasi' => null, 'tgl_beli' => null, 'harga_beli' => null]];
        $fileName = 'format-aset';


        $export = Excel::create($fileName . date('Y-m-d_H-i-s'), function ($excel) use ($data) {
            $excel->sheet('aset', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        });

        return $export->download('xlsx');
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
            'nama_kendaraan' => 'required|string|max:255',
        ]);

        Autocare::create([
            'kode_aset'           => $request->get('kode_aset'),
            'nama_kendaraan'      => $request->get('nama_kendaraan'),
            'nopol'               => $request->get('nopol'),
            'masaberlaku_stnk'    => $request->get('masaberlaku_stnk'),
            'status_kendaraan'    => $request->get('status_kendaraan'),
            'karyawan_id'         => $request->get('karyawan_id'),
            'send_notif'          => 0  
        ]);

        alert()->success('Berhasil.', 'Data telah ditambahkan!');

        return redirect()->route('asetac.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->level == 'it') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        $karyawans = Karyawan::get();
        $data = Autocare::findOrFail($id);

        return view('asetac.show', compact('karyawans', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->level == 'it') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        $data = Autocare::findOrFail($id);
        $karyawans = Karyawan::where('id', '>', 0)->get();
        return view('asetac.edit', compact('data', 'karyawans'));
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

        Autocare::find($id)->update([
            'kode_aset'           => $request->get('kode_aset'),
            'nama_kendaraan'      => $request->get('nama_kendaraan'),
            'nopol'               => $request->get('nopol'),
            'masaberlaku_stnk'    => $request->get('masaberlaku_stnk'),
            'status_kendaraan'    => $request->get('status_kendaraan'),
            'karyawan_id'         => $request->get('karyawan_id'),
            'send_notif'          => 0
        ]);

        alert()->success('Berhasil.', 'Data telah diubah!');
        return redirect()->route('asetac.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Autocare::find($id)->delete();
        alert()->success('Berhasil.', 'Data telah dihapus!');
        return redirect()->route('asetac.index');
    }
}
