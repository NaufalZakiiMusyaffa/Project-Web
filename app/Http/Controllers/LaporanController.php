<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Aset;
use App\Karyawan;
use App\Kategori;
use App\Transaksi;
use App\History;
use App\Autocare;
use App\TransaksiAutocare;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Excel;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;
use PHPExcel_Worksheet_Drawing;

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
        $status_aset = $request->get('status_aset');
        $month = $request->get('bulan');
        $year = $request->get('tahun');
        $q = Aset::query();

        if (!empty($status_aset)) {
            $q->where('status_aset',$status_aset);
        }

        if (!empty($year)) {
            $q->whereYear('tgl_beli', '=', $year);
        }
        
        if (!empty($month)) {
            $q->whereMonth('tgl_beli', '=', $month);
        } 
        $datas = $q->get();
        $pdf = PDF::loadView('laporan.aset_pdf', compact('datas','month','year'))->setPaper('a4', 'landscape');
        return $pdf->download('laporan_aset_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function asetExcel(Request $request)
    {
        $nama = 'laporan_aset_' . date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
            $excel->sheet('Laporan Data Aset', function ($sheet) use ($request) {

                $sheet->setAutoSize(array('B','C','D','E','F','G','H'));
                $sheet->setWidth('A', 15);
                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('images/laporan/logo.png')); //your image path
                $objDrawing->setCoordinates('A2');
                $objDrawing->setHeight(100);
                $objDrawing->setWorksheet($sheet);

                $sheet->mergeCells('B2:C2');
                $sheet->cell('B2', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '18',
                        'bold'       =>  true
                    ));
                    $cell->setValue('CV AMANDA');
                });

                $status_aset = $request->get('status_aset');
                $month = $request->get('bulan');
                $year = $request->get('tahun');
                
                $sheet->mergeCells('B3:C3');
                
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

                global $reportTitle; 
                if ($month != NULL && $year != NULL) {
                    $reportTitle = 'Laporan Data Aset IT Bulan '.$month_name.' Tahun '.$year;
                } elseif ($year != NULL) {
                    $reportTitle = 'Laporan Data Aset IT Tahun '.$year;
                } elseif ($month != NULL) {
                    $reportTitle = 'Laporan Data Aset IT Bulan '.$month_name;
                } else {
                    $reportTitle = 'Laporan Data Aset IT';
                }
                $sheet->cell('B3', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '14',
                        'bold'       =>  true
                    ));
                    global $reportTitle;
                    $cell->setValue($reportTitle);
                });
                
                $sheet->mergeCells('B4:C4');
                $sheet->cell('B4', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '14',
                        'bold'       =>  true
                    ));
                    $cell->setValue('System Management Aset');
                });

                $sheet->mergeCells('A5:H5');
                $sheet->row(6, function ($row) {
                    $row->setFontFamily('Calibri');
                    $row->setFontSize(14);
                    $row->setFontWeight('bold');
                    $row->setBackground('#fcd966');
                    $row->setAlignment('center');
                });

                $sheet->setBorder('A6:H6', 'thin');
                $range = "A6:H6";
                $sheet->cells($range, function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });

                $q = Aset::query();

                if (!empty($status_aset)) {
                    $q->where('status_aset',$status_aset);
                }

                if (!empty($year)) {
                    $q->whereYear('tgl_beli', '=', $year);
                }
                
                if (!empty($month)) {
                    $q->whereMonth('tgl_beli', '=', $month);
                } 
                $datas = $q->get();

                $sheet->row(6, array("No", "Nama Aset", "Kategori", "Merk",  "Status Aset", "Spesifikasi", "Tanggal Beli", "Harga Beli"));
                 
                $datasheet = array();
                $i = 1;
                $row_excel = 7;

                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  14,
                    )
                ));

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
                            date('d F Y', strtotime($data['tgl_beli'])),
                            "Rp " . number_format($data['harga_beli'],0,',','.')
                        );
                        $i++;
                    }
                } else {
                    $sheet->mergeCells('A7:H7');
                    $sheet->cell('A7', function($cell) {
                        $cell->setFont(array(
                            'family'     => 'Calibri',
                            'size'       => '14',
                            'bold'       =>  true
                        ));
                        $cell->setAlignment('center');
                        $cell->setValue('Data Tidak ditemukan');
                    });
                }

                $sheet->rows($datasheet);
                $get_range = (count($datas)> 0) ? $row_excel+count($datas)-1 : $row_excel+count($datas);
                $datarange =  "A".$row_excel.":H".$get_range;
                $sheet->setBorder($datarange, 'thin');
                $sheet->cells($datarange, function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
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
        $pdf = PDF::loadView('laporan.transaksi_pdf', compact('datas','tgl_pinjam'))->setPaper('a4', 'landscape');
        return $pdf->download('laporan_transaksi_' . date('Y-m-d_H-i-s') . '.pdf');
    }


    public function transaksiExcel(Request $request)
    {
        $nama = 'laporan_transaksi_' . date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
            $excel->sheet('Laporan Data Transaksi', function ($sheet) use ($request) {

                $sheet->setAutoSize(array('B','C','D','E','F','G','H'));
                $sheet->setWidth('A', 15);
                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('images/laporan/logo.png')); //your image path
                $objDrawing->setCoordinates('A2');
                $objDrawing->setHeight(100);
                $objDrawing->setWorksheet($sheet);

                $sheet->mergeCells('B2:C2');
                $sheet->cell('B2', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '18',
                        'bold'       =>  true
                    ));
                    $cell->setValue('CV AMANDA');
                });

                $sheet->mergeCells('B3:C3');
                $sheet->cell('B3', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '14',
                        'bold'       =>  true
                    ));
                    $cell->setValue('Laporan Data Transaksi');
                });

                $sheet->mergeCells('B4:C4');
                $sheet->cell('B4', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '14',
                        'bold'       =>  true
                    ));
                    $cell->setValue('System Management Aset');
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

                $sheet->mergeCells('A5:H5');
                $sheet->row(6, function ($row) {
                    $row->setFontFamily('Calibri');
                    $row->setFontSize(14);
                    $row->setFontWeight('bold');
                    $row->setBackground('#fcd966');
                    $row->setAlignment('center');
                });

                $sheet->setBorder('A6:H6', 'thin');
                $range = "A6:H6";
                $sheet->cells($range, function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });

                $sheet->row(6, array("No", "Kode Transaksi", "Nama Aset", "Peminjam",  "Tanggal Pinjam", "Tanggal Kembali", "Status", "Keterangan"));

                $datasheet = array();
                $i = 1;
                $row_excel = 7;

                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  14,
                    )
                ));

                if (count($datas) > 0) {
                    foreach ($datas as $data) {

                        // $sheet->appendrow($data);
                        $datasheet[$i] = array(
                            $i,
                            $data['kode_transaksi'],
                            $data->aset->nama_aset,
                            $data->karyawan->nama,
                            date('d F Y', strtotime($data['tgl_pinjam'])),
                            date('d F Y', strtotime($data['tgl_kembali'])),
                            $data['status'],
                            $data['ket']
                        );
    
                        $i++;
                    }
                } else {
                    $sheet->mergeCells('A7:H7');
                    $sheet->cell('A7', function($cell) {
                        $cell->setFont(array(
                            'family'     => 'Calibri',
                            'size'       => '14',
                            'bold'       =>  true
                        ));
                        $cell->setAlignment('center');
                        $cell->setValue('Data Tidak ditemukan');
                    });
                }

                $sheet->rows($datasheet);
                $get_range = (count($datas)> 0) ? $row_excel+count($datas)-1 : $row_excel+count($datas);
                $datarange =  "A".$row_excel.":H".$get_range;
                $sheet->setBorder($datarange, 'thin');
                $sheet->cells($datarange, function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
            });
        })->export('xlsx');
    }

    public function transaksiacPdf(Request $request)
    {
        $status = $request->get('status');
        $tgl_pinjam = $request->get('tgl_pinjam');
        $tgl_kembali = $request->get('tgl_kembali');
        $q = TransaksiAutocare::query();

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

        $pdf = PDF::loadView('laporan.transaksi_aset_autocare_pdf', compact('datas'))->setPaper('a4', 'landscape');
        return $pdf->download('laporan_transaksi_aset_autocare_' . date('Y-m-d_H-i-s') . '.pdf');
    }


    public function transaksiacExcel(Request $request)
    {
        $nama = 'laporan_transaksi_aset_autocare' . date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
            $excel->sheet('Laporan Transaksi Aset Autocare', function ($sheet) use ($request) {

                $sheet->setAutoSize(array('B','C','D','E','F','G','H','I'));
                $sheet->setWidth('A', 15);
                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('images/laporan/logo.png')); //your image path
                $objDrawing->setCoordinates('A2');
                $objDrawing->setHeight(100);
                $objDrawing->setWorksheet($sheet);

                $sheet->mergeCells('B2:C2');
                $sheet->cell('B2', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '18',
                        'bold'       =>  true
                    ));
                    $cell->setValue('CV AMANDA');
                });

                $sheet->mergeCells('B3:C3');
                $sheet->cell('B3', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '14',
                        'bold'       =>  true
                    ));
                    $cell->setValue('Laporan Data Transaksi Aset Autocare');
                });

                $sheet->mergeCells('B4:C4');
                $sheet->cell('B4', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '14',
                        'bold'       =>  true
                    ));
                    $cell->setValue('System Management Aset');
                });

                $status = $request->get('status');
                $tgl_pinjam = $request->get('tgl_pinjam');
                $tgl_kembali = $request->get('tgl_kembali');
                $q = TransaksiAutocare::query();

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

                $sheet->mergeCells('A5:I5');
                $sheet->row(6, function ($row) {
                    $row->setFontFamily('Calibri');
                    $row->setFontSize(14);
                    $row->setFontWeight('bold');
                    $row->setBackground('#fcd966');
                    $row->setAlignment('center');
                });

                $sheet->setBorder('A6:I6', 'thin');
                $range = "A6:I6";
                $sheet->cells($range, function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });

                $sheet->row(6, array("No", "Kode Peminjaman", "Nama Kendaraan", "Peminjam", "Supir", "Tanggal Pinjam", "Tanggal Kembali", "Keterangan", "Status"));

                $datasheet = array();
                $i = 1;
                $row_excel = 7;

                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  14,
                    )
                ));

                if (count($datas) > 0) {
                    foreach ($datas as $data) {

                        // $sheet->appendrow($data);
                        $datasheet[$i] = array(
                            $i,
                            $data->kode_peminjaman,
                            $data->asetac->nama_kendaraan,
                            $data->karyawan->nama,
                            $data->supir->nama_supir,
                            date('d F Y', strtotime($data->tgl_pinjam)),
                            date('d F Y', strtotime($data->tgl_kembali)),
                            $data->ket,
                            $data->status
                        );
    
                        $i++;
                    }
                } else {
                    $sheet->mergeCells('A7:I7');
                    $sheet->cell('A7', function($cell) {
                        $cell->setFont(array(
                            'family'     => 'Calibri',
                            'size'       => '14',
                            'bold'       =>  true
                        ));
                        $cell->setAlignment('center');
                        $cell->setValue('Data Tidak ditemukan');
                    });
                }

                $sheet->rows($datasheet);
                $get_range = (count($datas)> 0) ? $row_excel+count($datas)-1 : $row_excel+count($datas);
                $datarange =  "A".$row_excel.":I".$get_range;
                $sheet->setBorder($datarange, 'thin');
                $sheet->cells($datarange, function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
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
        $pdf = PDF::loadView('laporan.jejak_aset_pdf', compact('datas','nama_aset'))->setPaper('a4', 'landscape');
        return $pdf->download('laporan_jejak_aset_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function historyExcel(Request $request)
    {
        $nama = 'laporan_jejak_aset_' . date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
            $excel->sheet('Laporan Data Jejak Aset', function ($sheet) use ($request) {

                $nama_aset = $request->get('nama_aset');
                
                $sheet->setAutoSize(array('B','C','D','E'));
                $sheet->setWidth('A', 15);
                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('images/laporan/logo.png')); //your image path
                $objDrawing->setCoordinates('A2');
                $objDrawing->setHeight(100);
                $objDrawing->setWorksheet($sheet);

                $sheet->mergeCells('B2:C2');
                $sheet->cell('B2', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '18',
                        'bold'       =>  true
                    ));
                    $cell->setValue('CV AMANDA');
                });

                $sheet->mergeCells('B3:C3');
                $sheet->cell('B3', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '14',
                        'bold'       =>  true
                    ));
                    $cell->setValue('Laporan Jejak Aset');
                });

                $sheet->mergeCells('B4:C4');
                $sheet->cell('B4', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '14',
                        'bold'       =>  true
                    ));
                    $cell->setValue('System Management Aset');
                });

                $datas = History::get();
                if (!empty($nama_aset)) {
                    $aset_id = Aset::where('nama_aset', $nama_aset)->first()->id;
                    $datas = History::where('aset_id',$aset_id)->get();
                }

                $sheet->mergeCells('A5:E5');
                $sheet->row(6, function ($row) {
                    $row->setFontFamily('Calibri');
                    $row->setFontSize(14);
                    $row->setFontWeight('bold');
                    $row->setBackground('#fcd966');
                    $row->setAlignment('center');
                });

                $sheet->setBorder('A6:E6', 'thin');
                $range = "A6:E6";
                $sheet->cells($range, function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });

                $sheet->row(6, array("No", "Tanggal Jejak", "Nama Aset", "Tindakan", "Teknisi"));

                $datasheet = array();
                $i = 1;
                $row_excel = 7;

                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  14,
                    )
                ));

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
                    $sheet->mergeCells('A7:E7');
                    $sheet->cell('A7', function($cell) {
                        $cell->setFont(array(
                            'family'     => 'Calibri',
                            'size'       => '14',
                            'bold'       =>  true
                        ));
                        $cell->setAlignment('center');
                        $cell->setValue('Data Tidak ditemukan');
                    });
                }

                $sheet->rows($datasheet);
                $get_range = (count($datas)> 0) ? $row_excel+count($datas)-1 : $row_excel+count($datas);
                $datarange =  "A".$row_excel.":E".$get_range;
                $sheet->setBorder($datarange, 'thin');
                $sheet->cells($datarange, function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
            });
        })->export('xlsx');
    }

    public function karyawanPdf(Request $request)
    {
        $datas = Karyawan::get();
        $pdf = PDF::loadView('laporan.karyawan_pdf', compact('datas'));
        return $pdf->download('laporan_karyawan_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function karyawanExcel(Request $request)
    {
        $nama = 'laporan_karyawan_' . date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
            $excel->sheet('Laporan Data Karyawan', function ($sheet) use ($request) {

                $sheet->setAutoSize(array('B','C','D','E'));
                $sheet->setWidth('A', 15);
                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('images/laporan/logo.png')); //your image path
                $objDrawing->setCoordinates('A2');
                $objDrawing->setHeight(100);
                $objDrawing->setWorksheet($sheet);

                $sheet->mergeCells('B2:C2');
                $sheet->cell('B2', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '18',
                        'bold'       =>  true
                    ));
                    $cell->setValue('CV AMANDA');
                });

                $sheet->mergeCells('B3:C3');
                $sheet->cell('B3', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '14',
                        'bold'       =>  true
                    ));
                    $cell->setValue('Laporan Data Karyawan');
                });

                $sheet->mergeCells('B4:C4');
                $sheet->cell('B4', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '14',
                        'bold'       =>  true
                    ));
                    $cell->setValue('System Management Aset');
                });

                $datas = Karyawan::get();

                $sheet->mergeCells('A5:E5');
                $sheet->row(6, function ($row) {
                    $row->setFontFamily('Calibri');
                    $row->setFontSize(14);
                    $row->setFontWeight('bold');
                    $row->setBackground('#fcd966');
                    $row->setAlignment('center');
                });

                $sheet->setBorder('A6:E6', 'thin');
                $range = "A6:E6";
                $sheet->cells($range, function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });

                $sheet->row(6, array("No", "NIK", "Nama Karyawan", "Jenis Kelamin", "Jabatan"));

                $datasheet = array();
                $i = 1;
                $row_excel = 7;

                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  14,
                    )
                ));

                if (count($datas) > 0) {
                    foreach ($datas as $data) {
                        if ($data->jk == 'L') {
                            $jenis = "Laki-Laki";
                        } elseif ($data->jk == 'P') {
                            $jenis = "Perempuan";
                        }
    
                        $datasheet[$i] = array(
                            $i,
                            $data->nik,
                            $data->nama,
                            $jenis,
                            $data->jabatan,
                        );
    
                        $i++;
                    }
                } else {
                    $sheet->mergeCells('A7:E7');
                    $sheet->cell('A7', function($cell) {
                        $cell->setFont(array(
                            'family'     => 'Calibri',
                            'size'       => '14',
                            'bold'       =>  true
                        ));
                        $cell->setAlignment('center');
                        $cell->setValue('Data Tidak ditemukan');
                    });
                }

                $sheet->rows($datasheet);
                $get_range = (count($datas)> 0) ? $row_excel+count($datas)-1 : $row_excel+count($datas);
                $datarange =  "A".$row_excel.":E".$get_range;
                $sheet->setBorder($datarange, 'thin');
                $sheet->cells($datarange, function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
            });
        })->export('xlsx');
    }

    public function asetacPdf(Request $request)
    {
        $datas = Autocare::get();
        $pdf = PDF::loadView('laporan.autocare_pdf', compact('datas'))->setPaper('a4', 'landscape');
        return $pdf->download('laporan_autocare_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function asetacExcel(Request $request)
    {
        $nama = 'laporan_autocare_' . date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
            $excel->sheet('Laporan Data Aset Autocare', function ($sheet) use ($request) {

                $sheet->setAutoSize(array('B','C','D','E','F'));
                $sheet->setWidth('A', 15);
                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('images/laporan/logo.png')); //your image path
                $objDrawing->setCoordinates('A2');
                $objDrawing->setHeight(100);
                $objDrawing->setWorksheet($sheet);

                $sheet->mergeCells('B2:C2');
                $sheet->cell('B2', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '18',
                        'bold'       =>  true
                    ));
                    $cell->setValue('CV AMANDA');
                });

                $sheet->mergeCells('B3:C3');
                $sheet->cell('B3', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '14',
                        'bold'       =>  true
                    ));
                    $cell->setValue('Laporan Data Karyawan');
                });

                $sheet->mergeCells('B4:C4');
                $sheet->cell('B4', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '14',
                        'bold'       =>  true
                    ));
                    $cell->setValue('System Management Aset');
                });

                $datas = Autocare::get();

                $sheet->mergeCells('A5:F5');
                $sheet->row(6, function ($row) {
                    $row->setFontFamily('Calibri');
                    $row->setFontSize(14);
                    $row->setFontWeight('bold');
                    $row->setBackground('#fcd966');
                    $row->setAlignment('center');
                });

                $sheet->setBorder('A6:F6', 'thin');
                $range = "A6:F6";
                $sheet->cells($range, function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });

                $sheet->row(6, array("No", "Kode Aset", "Nama Kendaraan", "Nomor Polisi", "Masa Berlaku STNK", "Inventaris Kepada"));

                $datasheet = array();
                $i = 1;
                $row_excel = 7;

                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  14,
                    )
                ));

                if (count($datas) > 0) {
                    foreach ($datas as $data) {
    
                        $datasheet[$i] = array(
                            $i,
                            $data->kode_aset,
                            $data->nama_kendaraan,
                            $data->nopol,
                            date('d F Y', strtotime($data->masaberlaku_stnk)),
                            $data->karyawan_id ? $data->karyawan->nama : '-',
                        );
    
                        $i++;
                    }
                } else {
                    $sheet->mergeCells('A7:F7');
                    $sheet->cell('A7', function($cell) {
                        $cell->setFont(array(
                            'family'     => 'Calibri',
                            'size'       => '14',
                            'bold'       =>  true
                        ));
                        $cell->setAlignment('center');
                        $cell->setValue('Data Tidak ditemukan');
                    });
                }

                $sheet->rows($datasheet);
                $get_range = (count($datas)> 0) ? $row_excel+count($datas)-1 : $row_excel+count($datas);
                $datarange =  "A".$row_excel.":F".$get_range;
                $sheet->setBorder($datarange, 'thin');
                $sheet->cells($datarange, function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
            });
        })->export('xlsx');
    }

    public function penggunaPdf(Request $request)
    {
        $datas = User::get();
        $pdf = PDF::loadView('laporan.pengguna_pdf', compact('datas'));
        return $pdf->download('laporan_pengguna_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function penggunaExcel(Request $request)
    {
        $nama = 'laporan_pengguna_' . date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
            $excel->sheet('Laporan Data Pengguna', function ($sheet) use ($request) {

                $sheet->setAutoSize(array('B','C','D','E'));
                $sheet->setWidth('A', 15);
                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('images/laporan/logo.png')); //your image path
                $objDrawing->setCoordinates('A2');
                $objDrawing->setHeight(100);
                $objDrawing->setWorksheet($sheet);

                $sheet->mergeCells('B2:C2');
                $sheet->cell('B2', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '18',
                        'bold'       =>  true
                    ));
                    $cell->setValue('CV AMANDA');
                });

                $sheet->mergeCells('B3:C3');
                $sheet->cell('B3', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '14',
                        'bold'       =>  true
                    ));
                    $cell->setValue('Laporan Data Pengguna');
                });

                $sheet->mergeCells('B4:C4');
                $sheet->cell('B4', function($cell) {
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '14',
                        'bold'       =>  true
                    ));
                    $cell->setValue('System Management Aset');
                });

                $datas = User::get();

                $sheet->mergeCells('A5:E5');
                $sheet->row(6, function ($row) {
                    $row->setFontFamily('Calibri');
                    $row->setFontSize(14);
                    $row->setFontWeight('bold');
                    $row->setBackground('#fcd966');
                    $row->setAlignment('center');
                });

                $sheet->setBorder('A6:E6', 'thin');
                $range = "A6:E6";
                $sheet->cells($range, function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });

                $sheet->row(6, array("No", "Nama", "Username", "Email", "Tanggal Buat"));

                $datasheet = array();
                $i = 1;
                $row_excel = 7;

                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  14,
                    )
                ));

                if (count($datas) > 0) {
                    foreach ($datas as $data) {
                        $datasheet[$i] = array(
                            $i,
                            $data->name,
                            $data->username,
                            $data->email,
                            date('d F Y h:i a', strtotime($data->created_at)),
                        );
    
                        $i++;
                    }
                } else {
                    $sheet->mergeCells('A7:E7');
                    $sheet->cell('A7', function($cell) {
                        $cell->setFont(array(
                            'family'     => 'Calibri',
                            'size'       => '14',
                            'bold'       =>  true
                        ));
                        $cell->setAlignment('center');
                        $cell->setValue('Data Tidak ditemukan');
                    });
                }

                $sheet->rows($datasheet);
                $get_range = (count($datas)> 0) ? $row_excel+count($datas)-1 : $row_excel+count($datas);
                $datarange =  "A".$row_excel.":E".$get_range;
                $sheet->setBorder($datarange, 'thin');
                $sheet->cells($datarange, function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');
                });
            });
        })->export('xlsx');
    }
}
