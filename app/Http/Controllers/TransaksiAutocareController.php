<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Driver;
use App\Autocare;
use App\Karyawan;
use App\TransaksiAutocare;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiAutocareController extends Controller
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
        if (Auth::user()->level == 'it') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        $datas = TransaksiAutocare::get();

        return view('transaksiac.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $getRow = TransaksiAutocare::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "PMJ-ATC-00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "PMJ-ATC-0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "PMJ-ATC-000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "PMJ-ATC-00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "PMJ-ATC-0" . '' . ($lastId->id + 1);
            } else {
                $kode = "PMJ-ATC-" . '' . ($lastId->id + 1);
            }
        }

        $autocares = Autocare::where('status_kendaraan', '=', 1)->get();
        $karyawans = Karyawan::where('id', '>', 0)->get();
        $drivers = Driver::where('status_supir', '=', 1)->get();
        return view('transaksiac.create', compact('kode', 'autocares', 'karyawans', 'drivers'));
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
            'kode_peminjaman' => 'required|string|max:255',
            'tgl_pinjam' => 'required',
            'asetac_id' => 'required',
            'karyawan_id' => 'required',
            'supir_id' => 'required',

        ]);

        $transaksiac = TransaksiAutocare::create([
            'kode_peminjaman' => $request->get('kode_peminjaman'),
            'karyawan_id' => $request->get('karyawan_id'),
            'asetac_id' => $request->get('asetac_id'),
            'supir_id' => $request->get('supir_id'),
            'tgl_pinjam' => $request->get('tgl_pinjam'),
            'tgl_kembali' => $request->get('tgl_kembali'),
            'ket' => $request->get('ket'),
            'status' => 'pinjam'
        ]);

        $transaksiac->asetac->where('id', $transaksiac->asetac_id)
            ->update([
                'status_kendaraan' => ($transaksiac->asetac->status_kendaraan - 1),
            ]);

        $transaksiac->supir->where('id', $transaksiac->supir_id)
            ->update([
                'status_supir' => ($transaksiac->supir->status_supir - 1),
            ]);

        alert()->success('Berhasil.', 'Data telah ditambahkan!');
        return redirect()->route('transaksiac.index');
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
        $transaksiac = TransaksiAutocare::find($id);

        $transaksiac->update([
            'status' => 'kembali'
        ]);

        $transaksiac->asetac->where('id', $transaksiac->asetac->id)
            ->update([
                'status_kendaraan' => ($transaksiac->asetac->status_kendaraan + 1),
            ]);

        $transaksiac->supir->where('id', $transaksiac->supir->id)
            ->update([
                'status_supir' => ($transaksiac->supir->status_supir + 1),
            ]);

        alert()->success('Berhasil.', 'Data telah diubah!');
        return redirect()->route('transaksiac.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TransaksiAutocare::find($id)->delete();
        alert()->success('Berhasil.', 'Data telah dihapus!');
        return redirect()->route('transaksiac.index');
    }
}
