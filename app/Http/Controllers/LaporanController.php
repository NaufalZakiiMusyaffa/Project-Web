<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Aset;
use App\Karyawan;
use App\Kategori;
use App\Transaksi;
use App\History;
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

    public function asetPdf(Request $request)
    {
        $month = $request->get('bulan');
        $year = $request->get('tahun');
        $datas;
        if (!empty($year) && !empty($month)) {
            $datas = Aset::whereYear('tgl_beli', '=', $year)->whereMonth('tgl_beli', '=', $month)->get();
        }elseif (!empty($year)) {
            $datas = Aset::whereYear('tgl_beli', '=', $year)->get();
        }elseif (!empty($month)) {
            $datas = Aset::whereMonth('tgl_beli', '=', $month)->get();
        } else {
            $datas = Aset::get();
        }
        $pdf = PDF::loadView('laporan.aset_pdf', compact('datas','month','year'));
        return $pdf->download('laporan_aset_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function asetExcel(Request $request)
    {
        $nama = 'laporan_aset_' . date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
            $excel->sheet('Laporan Data Aset', function ($sheet) use ($request) {

                $month = $request->get('bulan');
                $year = $request->get('tahun');

                $sheet->mergeCells('A1:H1');

                // $sheet->setAllBorders('thin');
                $sheet->row(1, function ($row) {
                    $row->setFontFamily('Calibri');
                    $row->setFontSize(10);
                    $row->setAlignment('center');
                    $row->setFontWeight('bold');
                });
                
                $month_name; 
                if ($month != NULL) {
                    switch ($month) {
                        case '01':
                           $month_name = 'Januari';
                            break;
                        case '02':
                            $month_name = 'Februari';
                            break;
                        case '03':
                            $month_name = 'Maret';
                            break;
                        case '04':
                            $month_name = 'April';
                            break;
                        case '05':
                            $month_name = 'Mei';
                            break;
                        case '06':
                            $month_name = 'Juni';
                            break;
                        case '07':
                            $month_name = 'Juli';
                            break;
                        case '08':
                            $month_name = 'Agustus';
                            break;
                        case '09':
                            $month_name = 'September';
                            break;
                        case '10':
                            $month_name = 'Oktober';
                            break;
                        case '11':
                            $month_name = 'November';
                            break;
                        case '12':
                            $month_name = 'Desember';
                            break;
                        default:
                            # code...
                            break;
                    }
                }

                $reportTitle; 
                if ($month != NULL && $year != NULL) {
                    $reportTitle = 'Laporan Aset CV AMANDA Bulan '.$month_name.' Tahun '.$year;
                } elseif ($year != NULL) {
                    $reportTitle = 'Laporan Aset CV AMANDA Tahun '.$year;
                } elseif ($month != NULL) {
                    $reportTitle = 'Laporan Aset CV AMANDA Bulan '.$month_name;
                } else {
                    $reportTitle = 'Laporan Aset CV AMANDA';
                }
                
                $sheet->row(1, array($reportTitle));
                $sheet->row(2, function ($row) {
                    $row->setFontFamily('Calibri');
                    $row->setFontSize(10);
                    $row->setFontWeight('bold');
                });

                $datas;
                if (!empty($year) && !empty($month)) {
                    $datas = Aset::whereYear('tgl_beli', '=', $year)->whereMonth('tgl_beli', '=', $month)->get();
                }elseif (!empty($year)) {
                    $datas = Aset::whereYear('tgl_beli', '=', $year)->get();
                }elseif (!empty($month)) {
                    $datas = Aset::whereMonth('tgl_beli', '=', $month)->get();
                } else {
                    $datas = Aset::get();
                }

                $sheet->row($sheet->getHighestRow(), function ($row) {
                    $row->setFontWeight('bold');
                });

                $datasheet = array();
                $datasheet[0]  =   array("No", "Nama Aset", "Kategori", "Merk",  "Jumlah Aset", "Spesifikasi", "Tanggal Beli", "Harga Beli");
                $i = 1;

                if (count($datas) > 0) {
                    foreach ($datas as $data) {
    
                        // $sheet->appendrow($data);
                        $datasheet[$i] = array(
                            $i,
                            $data['nama_aset'],
                            $data->kategori->nama_kategori,
                            $data['merk'],
                            $data['status_aset'],
                            $data['spesifikasi'],
                            $data['tgl_beli'],
                            $data['harga_beli']
                        );
    
                        $i++;
                    }
                } else {
                    $datasheet[$i] = array(
                        'Data Tidak ditemukan'
                    );
                    $sheet->mergeCells('A3:H3');
                    $sheet->row(3, function ($row) {
                        $row->setFontFamily('Calibri');
                        $row->setFontSize(10);
                        $row->setAlignment('center');
                        $row->setFontWeight('bold');
                    });
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
        $status = $request->get('status');
        $tgl_pinjam = $request->get('tgl_pinjam');
        $tgl_kembali = $request->get('tgl_kembali');
        $q = Transaksi::query();

        if (!empty($status)) {
            $q->where('status', $status);
        }

        if (!empty($tgl_pinjam)) {
            $q->where('tgl_pinjam', $tgl_pinjam);
        }

        if (!empty($tgl_kembali)) {
            $q->where('tgl_kembali', $tgl_kembali);
        }

        if (Auth::user()->level == 'it') {
            $q->where('karyawan_id', Auth::user()->karyawan->id);
        }

        $datas = $q->get();

        // return view('laporan.transaksi_pdf', compact('datas'));
        $pdf = PDF::loadView('laporan.transaksi_pdf', compact('datas','tgl_pinjam'));
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

                $status = $request->get('status');
                $tgl_pinjam = $request->get('tgl_pinjam');
                $tgl_kembali = $request->get('tgl_kembali');
                $q = Transaksi::query();

                if (!empty($status)) {
                    $q->where('status', $status);
                }

                if (!empty($tgl_pinjam)) {
                    $q->where('tgl_pinjam', $tgl_pinjam);
                }

                if (!empty($tgl_kembali)) {
                    $q->where('tgl_kembali', $tgl_kembali);
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

                if (count($datas) > 0) {
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
                } else {
                    $datasheet[$i] = array(
                        'Data Tidak ditemukan'
                    );
                    $sheet->mergeCells('A3:H3');
                    $sheet->row(3, function ($row) {
                        $row->setFontFamily('Calibri');
                        $row->setFontSize(10);
                        $row->setAlignment('center');
                        $row->setFontWeight('bold');
                    });
                }

                $sheet->fromArray($datasheet);
            });
        })->export('xlsx');
    }

    public function historyPdf(Request $request)
    {
        $nama_aset = $request->get('nama_aset');
        $datas = History::get();
        if (!empty($nama_aset)) {
            $aset_id = Aset::where('nama_aset', $nama_aset)->first()->id;
            $datas = History::where('aset_id',$aset_id)->get();
        }
        $pdf = PDF::loadView('laporan.jejak_aset_pdf', compact('datas','nama_aset'));
        return $pdf->download('laporan_jejak_aset_' . date('Y-m-d_H-i-s') . '.pdf');;
    }

    public function historyExcel(Request $request)
    {
        $nama = 'laporan_jejak_aset_' . date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
            $excel->sheet('Laporan Data Jejak Aset', function ($sheet) use ($request) {

                $nama_aset = $request->get('nama_aset');
                // error_log($nama_aset);

                $sheet->mergeCells('A1:H1');

                // $sheet->setAllBorders('thin');
                $sheet->row(1, function ($row) {
                    $row->setFontFamily('Calibri');
                    $row->setFontSize(10);
                    $row->setAlignment('center');
                    $row->setFontWeight('bold');
                });
                
                

                $sheet->row(1, array('Laporan Jejak Aset CV AMANDA'));
                $sheet->row(2, function ($row) {
                    $row->setFontFamily('Calibri');
                    $row->setFontSize(10);
                    $row->setFontWeight('bold');
                });

                $datas = History::get();
                if (!empty($nama_aset)) {
                    $aset_id = Aset::where('nama_aset', $nama_aset)->first()->id;
                    $datas = History::where('aset_id',$aset_id)->get();
                }

                $sheet->row($sheet->getHighestRow(), function ($row) {
                    $row->setFontWeight('bold');
                });

                $datasheet = array();
                $datasheet[0]  =   array("No", "Tanggal Jejak", "Nama Aset", "Tindakan", "Teknisi");
                $i = 1;

                if (count($datas) > 0) {
                    foreach ($datas as $data) {
    
                        // $sheet->appendrow($data);
                        $datasheet[$i] = array(
                            $i,
                            date('d F Y', strtotime($data->tgl_history)),
                            $data->aset->nama_aset,
                            $data->tindakan,
                            $data->karyawan->nama,
                        );
    
                        $i++;
                    }
                } else {
                    $datasheet[$i] = array(
                        'Data Tidak ditemukan'
                    );
                    $sheet->mergeCells('A3:H3');
                    $sheet->row(3, function ($row) {
                        $row->setFontFamily('Calibri');
                        $row->setFontSize(10);
                        $row->setAlignment('center');
                        $row->setFontWeight('bold');
                    });
                }

                $sheet->fromArray($datasheet);
            });
        })->export('xlsx');
    }
}
