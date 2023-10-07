<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Karyawan;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class KaryawanController extends Controller
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
        if ((Auth::user()->level == 'it') || (Auth::user()->level == 'autocare') || (Auth::user()->level == 'karyawan')) {
            return redirect()->to('/profil');
        }
        $datas = Karyawan::where('id', '>', 0)->get();
        return view('karyawan.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::get();
        return view('karyawan.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = Karyawan::where('nik', $request->input('nik'))->count();

        if ($count > 0) {
            Session::flash('message', 'Already exist!');
            Session::flash('message_type', 'danger');
            return redirect()->to('karyawan');
        }

        $this->validate($request, [
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:karyawan'
        ]);

        if ($request->file('gambar')) {
            $file = $request->file('gambar');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $acak;
            $request->file('gambar')->move("images/user", $fileName);
            $cover = $fileName;
        } else {
            $cover = NULL;
        }

        if ($request->file('tanda_tangan')) {
            $fileTTD = $request->file('tanda_tangan');
            $dtTTD = Carbon::now();
            $random  = $fileTTD->getClientOriginalExtension();
            $fileNameTTD = rand(11111, 99999) . '-' . $dtTTD->format('Y-m-d-H-i-s') . '.' . $random;
            $request->file('tanda_tangan')->move("images/user/tanda_tangan", $fileNameTTD);
            $coverTTD = $fileNameTTD;
        } else {
            $coverTTD = NULL;
        }

        Karyawan::create([
            'nik'           => $request->get('nik'),
            'nama'          => $request->get('nama'),
            'jk'            => $request->get('jk'),
            'jabatan'       => $request->get('jabatan'),
            'gambar'        => $cover,
            'telepon'       => $request->get('telepon'),
            'tanda_tangan'  => $coverTTD,
        ]);

        alert()->success('Berhasil.', 'Data telah ditambahkan!');
        return redirect()->route('karyawan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ((Auth::user()->level == 'it') && (Auth::user()->id != $id)) {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        $data = Karyawan::findOrFail($id);

        return view('karyawan.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = Karyawan::findOrFail($id);
        $users = User::get();
        return view('karyawan.edit', compact('data', 'users'));
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
        $karyawan = Karyawan::find($id);
        if ($request->file('gambar')) {
            $file = $request->file('gambar');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $acak;
            $request->file('gambar')->move("images/user", $fileName);
            $cover = $fileName;
            $karyawan->gambar ? unlink(public_path("images/user/".$karyawan->gambar)) : '';
        } else {
            $cover = $karyawan->gambar ? $karyawan->gambar : NULL;
        }

        if ($request->file('tanda_tangan')) {
            $fileTTD = $request->file('tanda_tangan');
            $dtTTD = Carbon::now();
            $random  = $fileTTD->getClientOriginalExtension();
            $fileNameTTD = rand(11111, 99999) . '-' . $dtTTD->format('Y-m-d-H-i-s') . '.' . $random;
            $request->file('tanda_tangan')->move("images/user/tanda_tangan", $fileNameTTD);
            $coverTTD = $fileNameTTD;
            $karyawan->tanda_tangan ? unlink(public_path("images/user/tanda_tangan/".$karyawan->tanda_tangan)) : '';
        } else {
            $coverTTD = $karyawan->tanda_tangan ? $karyawan->tanda_tangan : NULL;
        }

        Karyawan::find($id)->update([
            'nik'           => $request->get('nik'),
            'nama'          => $request->get('nama'),
            'jk'            => $request->get('jk'),
            'jabatan'       => $request->get('jabatan'),
            'gambar'        => $cover,
            'telepon'       => $request->get('telepon'),
            'tanda_tangan'  => $coverTTD,
        ]);

        alert()->success('Berhasil.', 'Data telah diubah!');
        return redirect()->to('karyawan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);
        $karyawan->gambar ? unlink(public_path("images/user/".$karyawan->gambar)) : '';
        $karyawan->tanda_tangan ? unlink(public_path("images/user/tanda_tangan/".$karyawan->tanda_tangan)) : '';
        Karyawan::find($id)->delete();
        alert()->success('Berhasil.', 'Data telah dihapus!');
        return redirect()->route('karyawan.index');
    }
}
