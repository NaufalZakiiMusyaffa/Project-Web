<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Aset;
use App\Kategori;
use App\Karyawan;
use App\Transaksi;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Excel;
use RealRashid\SweetAlert\Facades\Alert;

class AsetController extends Controller
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
            $datas2 = Transaksi::where('status', 'pinjam')
                ->where('karyawan_id', Auth::user()->id)->get();
        } else {
            $datas2 = Transaksi::where('status', 'pinjam')->get();
        }

        $datas = Aset::get();
        return view('aset.index', compact('datas2', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        $getRow = Aset::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "ASET00001";
        $siappakai = "1";
        $dipakai = "2";
        $bisadiperbaiki = "3";
        $rusak = "5";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "ASET0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "ASET000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "ASET00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "ASET0" . '' . ($lastId->id + 1);
            } else {
                $kode = "ASET" . '' . ($lastId->id + 1);
            }
        }

        $kategoris = Kategori::get();
        $karyawans = Karyawan::where('id', '>', 0)->get();
        return view('aset.create', compact('kode', 'siappakai', 'dipakai', 'bisadiperbaiki', 'rusak', 'kategoris', 'karyawans'));
    }

    public function format()
    {
        $data = [['kode_aset' => null, 'nama_aset' => null, 'kategori' => null, 'merk' => null, 'jumlah_aset' => null, 'spesifikasi' => null, 'tgl_beli' => null, 'harga_beli' => null]];
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
            'nama_aset' => 'required|string|max:255',
            'kategori_id' => 'required|integer',
        ]);

        if ($request->file('gambar')) {
            $file = $request->file('gambar');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $acak;
            $request->file('gambar')->move("images/aset", $fileName);
            $cover = $fileName;
        } else {
            $cover = NULL;
        }

        Aset::create([
            'kode_aset'   => $request->get('kode_aset'),
            'nama_aset'   => $request->get('nama_aset'),
            'kategori_id' => $request->get('kategori_id'),
            'karyawan_id' => $request->get('karyawan_id'),
            'merk'        => $request->get('merk'),
            'jumlah_aset' => $request->get('jumlah_aset'),
            'spesifikasi' => $request->get('spesifikasi'),
            'garansi'     => $request->get('garansi'),
            'tgl_beli'    => $request->get('tgl_beli'),
            'harga_beli'  => $request->get('harga_beli'),
            'toko_beli'   => $request->get('toko_beli'),
            'alamat'      => $request->get('alamat'),
            'gambar'      => $cover
        ]);

        alert()->success('Berhasil.', 'Data telah ditambahkan!');

        return redirect()->route('aset.index');
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

        $kategoris = Kategori::get();
        $data = Aset::findOrFail($id);

        return view('aset.show', compact('kategoris', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $kategoris = Kategori::get();
        $data = Aset::findOrFail($id);
        $karyawans = Karyawan::where('id', '>', -1)->get();
        return view('aset.edit', compact('kategoris', 'data', 'karyawans'));
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
        if ($request->file('gambar')) {
            $file = $request->file('gambar');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $acak;
            $request->file('gambar')->move("images/aset", $fileName);
            $cover = $fileName;
        } else {
            $cover = NULL;
        }

        Aset::find($id)->update([
            'kode_aset'   => $request->get('kode_aset'),
            'nama_aset'   => $request->get('nama_aset'),
            'kategori_id' => $request->get('kategori_id'),
            'karyawan_id' => $request->get('karyawan_id'),
            'merk'        => $request->get('merk'),
            'jumlah_aset' => $request->get('jumlah_aset'),
            'spesifikasi' => $request->get('spesifikasi'),
            'garansi'     => $request->get('garansi'),
            'tgl_beli'    => $request->get('tgl_beli'),
            'harga_beli'  => $request->get('harga_beli'),
            'toko_beli'   => $request->get('toko_beli'),
            'alamat'      => $request->get('alamat'),
            'gambar'      => $cover
        ]);

        alert()->success('Berhasil.', 'Data telah diubah!');
        return redirect()->route('aset.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Aset::find($id)->delete();
        alert()->success('Berhasil.', 'Data telah dihapus!');
        return redirect()->route('aset.index');
    }
}
