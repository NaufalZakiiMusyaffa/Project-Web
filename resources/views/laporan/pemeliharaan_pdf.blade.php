<!DOCTYPE html>
<html>

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style type="text/css">
    @page { margin: 0px; }

    body {
        font-family: 'gill-sans-mt', sans-serif;
        /* font-size: 10px; */
        background-image: url("images/laporan_pengajuan/asset_footer.png");
        background-position: right bottom; /*Positioning*/
        background-repeat: no-repeat; 
        background-size: 400px 400px;
    }
    
    table, th, td {
        border:1px solid black;
        border-collapse: collapse;
        font-size: 10px;
    }

    p {
        font-size: 10px;
    }

    table {
        margin: 10px 20px;
    }

    th, td {
        padding: 10px 20px
    }

    th {
        font-weight: normal;
    }

    .color-key-column {
        background-color: #c0c0c0;
    }

    .center {
      text-align: center;
    }
  </style>
  <link rel="stylesheet" href="">
  <title>Laporan Pengajuan Aset ITt</title>
</head>

<body>
  <img src="{{public_path('images/laporan_pengajuan/asset_header.png')}}" style="max-width: 100%">

  <h4 class="center"><b>FORMULIR PERBAIKAN ASET</b></h4>

  <table>
    <tr>
        <td class="color-key-column">Tanggal</td>
        <td> {{date('d F Y ', strtotime($data->created_at))}}</td>
    </tr>
  </table>

  <table style="width: 100%" class="center">
    <tr>
        <th class="color-key-column">No. Pengajuan</th>
        <th class="color-key-column">Nama Karyawan</th>
        <th class="color-key-column">Jabatan</th>
        <th class="color-key-column">Lokasi</th>
        <th class="color-key-column">Divisi</th>
    </tr>
    <tr>
        <td>{{$data->kode_pemeliharaan}}</td>
        <td>{{$data->yang_mengajukan}}</td>
        <td><b>STAFF IT</b></td>
        <td><b>HO - RANCABOLANG</b></td>
        <td><b>IT</b></td>
    </tr>
  </table>

  <table style="width: 100%" class="center">
    <tr>
        <th class="color-key-column" style="padding:0">Perihal Biaya</th>
    </tr>
    <tr>
        <td>{{$data->keterangan}}</td>
    </tr>
  </table>
  
  <table style="width: 100%" class="center">
    <tr>
        <th class="color-key-column">No.</th>
        <th class="color-key-column">Rincian Biaya</th>
        <th class="color-key-column">Estimasi Tanggal Penggunaan</th>
        <th class="color-key-column">Estimasi Jumlah</th>
    </tr>
    <tr>
        <td>1</td>
        <td>{{$data->keterangan}}</td>
        <td><b>SEGERA</b></td>
        <td>{{$data->biaya}}</td>
    </tr>
    <tr>
        <td class="color-key-column" colspan="3">Estimasi Jumlah Keseluruhan</td>
        <td>{{$data->biaya}}</td>
    </tr>
  </table>

  <br>
  <p style="margin: 10px 20px;"><b><i>Penggesahan</i></b></p>

  <table>
    <tr class="center">
        <td>Diajukan Oleh</td>
        <td>Menyetujui</td>
    </tr>
    <tr>
        <td width="150" style="vertical-align: bottom">
          <b>Nama:</b>
        </td>
        <td>
            <img height="150" src="{{ $manager->karyawan->tanda_tangan ? public_path('images/user/tanda_tangan/'.$manager->karyawan->tanda_tangan) : public_path('images/user/tanda_tangan/not-found.jpg') }}" />
            <br>
            <b>{{$manager->karyawan->nama}}</b>
        </td>
    </tr>
    <tr>
        <td><b>Jabatan: STAFF IT</b></td>
        <td>
            <b>Jabatan: HR&GA Senior Manager</b>
        </td>
    </tr>
  </table>

  <p style="margin: 10px 20px;"><i>Catatan: </i>Setelah mendapatkan approved, cetak dan berikan berkas kepada bagian Keuangan</p>
</body>

</html>