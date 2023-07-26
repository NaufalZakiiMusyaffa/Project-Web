<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Auth;
use App\TandaTangan;

class TandaTanganController extends Controller
{
    public function store(Request $request)
    {
        if ($request->file('gambar')) {
            $file = $request->file('gambar');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $acak;
            $request->file('gambar')->move("images/user/tanda_tangan", $fileName);
            $cover = $fileName;
        } else {
            $cover = NULL;
        }

        TandaTangan::create([
            'karyawan_id'   => Auth::user()->karyawan_id,
            'gambar'        => $cover,
        ]);

        alert()->success('Berhasil.', 'Data telah ditambahkan!');
        return redirect()->route('user.me');
    }

    public function update(Request $request, $id)
    {
        $tandaTangan = TandaTangan::find($id)->get();
        if ($request->file('gambar')) {
            File::delete("images/user/tanda_tangan/",$tandaTangan->gambar);
            $file = $request->file('gambar');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $acak;
            $request->file('gambar')->move("images/user/tanda_tangan", $fileName);
            $cover = $fileName;
        } else {
            $cover = $tandaTangan->gambar;
        }

        TandaTangan::find($id)->update([
            'karyawan_id'   => Auth::user()->karyawan_id,
            'gambar'        => $cover,
        ]);

        alert()->success('Berhasil.', 'Data telah diubah!');
        return redirect()->to('user.me');
    }

    public function destroy($id)
    {
        TandaTangan::find($id)->delete();
        File::delete("images/user/tanda_tangan/",$tandaTangan->gambar);
        alert()->success('Berhasil.', 'Data telah dihapus!');
        return redirect()->route('user.me');
    }

}
