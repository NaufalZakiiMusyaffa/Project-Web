<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Aset;
use App\Kategori;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;


class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $datas = Kategori::get();
        return view('kategori.index', compact('datas'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_kategori' => 'required|string|max:255'
        ]);

        Kategori::create($request->all());

        alert()->success('Berhasil.', 'Data telah ditambahkan!');
        return redirect()->route('kategori.index');
    }

    public function show($id)
    {
        $data = Kategori::findOrFail($id);
        return view('kategori.show', compact('data'));
    }

    public function edit($id)
    {
        $data = Kategori::findOrFail($id);
        $users = User::get();
        return view('kategori.edit', compact('data', 'users'));
    }

    public function update(Request $request, $id)
    {
        Kategori::find($id)->update($request->all());

        alert()->success('Berhasil.', 'Data telah diubah!');
        return redirect()->to('kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kategori::find($id)->delete();
        alert()->success('Berhasil.', 'Data telah dihapus!');
        return redirect()->route('kategori.index');
    }
}
