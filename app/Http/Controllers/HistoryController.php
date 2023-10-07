<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Aset;
use App\History;
use App\Karyawan;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Excel;
use RealRashid\SweetAlert\Facades\Alert;


class HistoryController extends Controller
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
        $datas2 = Aset::get();
        $datas = History::get();
        return view('history.index', compact('datas2', 'datas'));
    }

    public function create()
    {
        $asets = Aset::get();
        $karyawans = Karyawan::where('id', '>', 0)->get();
        return view('history.create', compact('asets', 'karyawans'));
    }

    public function store(Request $request)
    {

        History::create([
            'tgl_history' => $request->get('tgl_history'),
            'aset_id'     => $request->get('aset_id'),
            'tindakan'    => $request->get('tindakan'),
            'karyawan_id'  => $request->get('karyawan_id')

        ]);

        alert()->success('Berhasil.', 'Data telah ditambahkan!');

        return redirect()->route('history.index');
    }

    public function show($id)

    {
        $asets = Aset::get();
        $data = Aset::findOrFail($id);

        return view('history.show', compact('asets', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asets = Aset::get();
        $karyawans = Karyawan::where('id', '>', 0)->get();
        $data = History::findOrFail($id);
        return view('history.edit', compact('asets', 'karyawans', 'data'));
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

        History::find($id)->update([
            'tgl_history' => $request->get('tgl_history'),
            'aset_id'     => $request->get('aset_id'),
            'tindakan'    => $request->get('tindakan'),
            'karyawan_id'  => $request->get('karyawan_id')
        ]);

        alert()->success('Berhasil.', 'Data telah diubah!');
        return redirect()->route('history.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        History::find($id)->delete();
        alert()->success('Berhasil.', 'Data telah dihapus!');
        return redirect()->route('history.index');
    }
}
