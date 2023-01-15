<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Aset;
use App\Karyawan;
use App\Kategori;
use App\Transaksi;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Excel;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

class LaporanController extends Controller
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

    public function aset()
    {
        if (Auth::user()->level == 'it') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }
        return view('laporan.aset');
    }

    public function asetPdf()
    {

        $datas = Aset::all();
        $pdf = PDF::loadView('laporan.aset_pdf', compact('datas'));
        return $pdf->download('laporan_aset_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function asetExcel(Request $request)
    {
        $nama = 'laporan_aset_' . date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
            $excel->sheet('Laporan Data Aset', function ($sheet) use ($request) {

                $sheet->mergeCells('A1:H1');

                // $sheet->setAllBorders('thin');
                $sheet->row(1, function ($row) {
                    $row->setFontFamily('Calibri');
                    $row->setFontSize(10);
                    $row->setAlignment('center');
                    $row->setFontWeight('bold');
                });

                $sheet->row(1, array('CV.AMANDA'));
                $sheet->row(2, function ($row) {
                    $row->setFontFamily('Calibri');
                    $row->setFontSize(10);
                    $row->setFontWeight('bold');
                });

                $datas = Aset::all();

                $sheet->row($sheet->getHighestRow(), function ($row) {
                    $row->setFontWeight('bold');
                });

                $datasheet = array();
                $datasheet[0]  =   array("No", "Nama Aset", "Kategori", "Merk",  "Jumlah Aset", "Spesifikasi", "Tanggal Beli", "Harga Beli");
                $i = 1;

                foreach ($datas as $data) {

                    // $sheet->appendrow($data);
                    $datasheet[$i] = array(
                        $i,
                        $data['nama_aset'],
                        $data->kategori->nama_kategori,
                        $data['merk'],
                        $data['jumlah_aset'],
                        $data['spesifikasi'],
                        $data['tgl_beli'],
                        $data['harga_beli']
                    );

                    $i++;
                }

                $sheet->fromArray($datasheet);
            });
        })->export('xlsx');
    }


    public function transaksi()
    {
        if (Auth::user()->level == 'it') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }
        return view('laporan.transaksi');
    }


    public function transaksiPdf(Request $request)
    {
        $q = Transaksi::query();

        if ($request->get('status')) {
            if ($request->get('status') == 'pinjam') {
                $q->where('status', 'pinjam');
            } else {
                $q->where('status', 'kembali');
            }
        }

        if (Auth::user()->level == 'it') {
            $q->where('karyawan_id', Auth::user()->karyawan->id);
        }

        $datas = $q->get();

        // return view('laporan.transaksi_pdf', compact('datas'));
        $pdf = PDF::loadView('laporan.transaksi_pdf', compact('datas'));
        return $pdf->download('laporan_transaksi_' . date('Y-m-d_H-i-s') . '.pdf');
    }


    public function transaksiExcel(Request $request)
    {
        $nama = 'laporan_transaksi_' . date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
            $excel->sheet('Laporan Data Transaksi', function ($sheet) use ($request) {

                $sheet->mergeCells('A1:H1');

                // $sheet->setAllBorders('thin');
                $sheet->row(1, function ($row) {
                    $row->setFontFamily('Calibri');
                    $row->setFontSize(10);
                    $row->setAlignment('center');
                    $row->setFontWeight('bold');
                });

                $sheet->row(1, array('LAPORAN DATA TRANSAKSI'));

                $sheet->row(2, function ($row) {
                    $row->setFontFamily('Calibri');
                    $row->setFontSize(10);
                    $row->setFontWeight('bold');
                });

                $q = Transaksi::query();

                if ($request->get('status')) {
                    if ($request->get('status') == 'pinjam') {
                        $q->where('status', 'pinjam');
                    } else {
                        $q->where('status', 'kembali');
                    }
                }

                if (Auth::user()->level == 'it') {
                    $q->where('karyawan_id', Auth::user()->karyawan->id);
                }

                $datas = $q->get();

                // $sheet->appendRow(array_keys($datas[0]));
                $sheet->row($sheet->getHighestRow(), function ($row) {
                    $row->setFontWeight('bold');
                });

                $datasheet = array();
                $datasheet[0]  =   array("NO", "KODE TRANSAKSI", "NAMA ASET", "PEMINJAM",  "TGL PINJAM", "TGL KEMBALI", "STATUS", "KET");
                $i = 1;

                foreach ($datas as $data) {

                    // $sheet->appendrow($data);
                    $datasheet[$i] = array(
                        $i,
                        $data['kode_transaksi'],
                        $data->aset->nama_aset,
                        $data->karyawan->nama,
                        date('d/m/y', strtotime($data['tgl_pinjam'])),
                        date('d/m/y', strtotime($data['tgl_kembali'])),
                        $data['status'],
                        $data['ket']
                    );

                    $i++;
                }

                $sheet->fromArray($datasheet);
            });
        })->export('xlsx');
    }
}
