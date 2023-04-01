<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Aset;
use App\Karyawan;
use App\History;
use App\Transaksi;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
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
        if (Auth::user()->level == 'manager') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }
        $datas = Transaksi::get();

        return view('transaksi.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $getRow = Transaksi::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "PM00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "PM0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "PM000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "PM00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "PM0" . '' . ($lastId->id + 1);
            } else {
                $kode = "PM" . '' . ($lastId->id + 1);
            }
        }

        $asets = Aset::where('status_aset', '===', 'Siap digunakan')->get();
        $karyawans = Karyawan::where('id', '>', 0)->get();
        $datas = History::get();
        return view('transaksi.create', compact('asets', 'kode', 'karyawans', 'datas'));
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
            'kode_transaksi' => 'required|string|max:255',
            'tgl_pinjam' => 'required',
            'aset_id' => 'required',
            'karyawan_id' => 'required',

        ]);

        $transaksi = Transaksi::create([
            'kode_transaksi' => $request->get('kode_transaksi'),
            'tgl_pinjam' => $request->get('tgl_pinjam'),
            'tgl_kembali' => $request->get('tgl_kembali'),
            'aset_id' => $request->get('aset_id'),
            'karyawan_id' => $request->get('karyawan_id'),
            'ket' => $request->get('ket'),
            'status' => 'pinjam'
        ]);

        $transaksi->aset->where('id', $transaksi->aset_id)
            ->update([
                'status_aset' => 'Sedang dipinjam',
            ]);

        alert()->success('Berhasil.', 'Data telah ditambahkan!');
        return redirect()->route('transaksi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = Transaksi::findOrFail($id);


        if ((Auth::user()->level == 'it') && (Auth::user()->karyawan->id != $data->karyawan_id)) {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }


        return view('transaksi.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Transaksi::findOrFail($id);

        if ((Auth::user()->level == 'it') && (Auth::user()->karyawan->id != $data->karyawan_id)) {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        return view('aset.edit', compact('data'));
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
        $transaksi = Transaksi::find($id);

        $transaksi->update([
            'status' => 'kembali'
        ]);

        $transaksi->aset->where('id', $transaksi->aset->id)
            ->update([
                'status_aset' => 'Siap digunakan',
            ]);

        alert()->success('Berhasil.', 'Data telah diubah!');
        return redirect()->route('transaksi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaksi::find($id)->delete();
        alert()->success('Berhasil.', 'Data telah dihapus!');
        return redirect()->route('transaksi.index');
    }
}
