<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransaksiAutocare;
use App\Driver;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class DriverController extends Controller
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

        $datas = Driver::get();
        return view('driver.index', compact('datas'));
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

        $getRow = Driver::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "SPR00001";
        $siap = "Siap";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "SPR0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "SPR000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "SPR00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "SPR0" . '' . ($lastId->id + 1);
            } else {
                $kode = "SPR" . '' . ($lastId->id + 1);
            }
        }

        return view('driver.create', compact('kode', 'siap'));
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
            'nama_supir' => 'required|string|max:255',
        ]);

        Driver::create([
            'kode_supir'   => $request->get('kode_supir'),
            'nama_supir'   => $request->get('nama_supir'),
            'kontak'       => $request->get('kontak'),
            'status_supir' => $request->get('status_supir'),
        ]);

        alert()->success('Berhasil.', 'Data telah ditambahkan!');

        return redirect()->route('driver.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ((Auth::user()->level == 'it') && (Auth::user()->id != $id)) {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        $data = Driver::findOrFail($id);
        return view('driver.edit', compact('data'));
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
        Driver::find($id)->update([
            'kode_supir'   => $request->get('kode_supir'),
            'nama_supir'   => $request->get('nama_supir'),
            'kontak'       => $request->get('kontak'),
        ]);

        alert()->success('Berhasil.', 'Data telah diubah!');
        return redirect()->route('driver.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Driver::find($id)->delete();
        alert()->success('Berhasil.', 'Data telah dihapus!');
        return redirect()->route('driver.index');
    }
}
