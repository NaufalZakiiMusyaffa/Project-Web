<!DOCTYPE html>
<html>

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style type="text/css">
    @page { margin: 0px; }

    body {
        font-family: 'gill-sans-mt', sans-serif;
        /* font-size: 10px; */
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
    
    /*.background-pdf {*/
    /*    background-image: url({{url('images/laporan/bagian_bawah.jpg')}});*/
    /*}*/
  </style>
  <link rel="stylesheet" href="">
  <title>Laporan Pengajuan Aset IT</title>
</head>

<body>
  <img src="{{public_path('images/laporan_pengajuan/asset_header.png')}}" style="max-width: 100%">

  <h4 class="center"><b>FORMULIR PERBAIKAN ASET IT</b></h4>

  <table>
    <tr>
        <td class="color-key-column">Tanggal</td>
        <td> {{date('d-m-Y ', strtotime($data->created_at))}}</td>
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
        <th class="color-key-column" style="width: 5%">No.</th>
        <th class="color-key-column" style="width: 45%">Rincian Biaya</th>
        <th class="color-key-column">Estimasi Tanggal Penggunaan</th>
        <th class="color-key-column">Estimasi Jumlah</th>
    </tr>
    <tr>
        <td style="width: 5%">1</td>
        <td style="width: 45%">{{$data->keterangan}}</td>
        <td><b>SEGERA</b></td>
        <td>@currency($data->biaya)</td>
    </tr>
    <tr>
        <td class="color-key-column" colspan="3">Estimasi Jumlah Keseluruhan</td>
        <td>@currency($data->biaya)</td>
    </tr>
  </table>

  <br>
  <p style="margin: 10px 20px;"><b><i>Pengesahan</i></b></p>

  <table>
    <tr class="center">
        <td>Diajukan Oleh</td>
        <td>Menyetujui</td>
    </tr>
    <tr>
        <td>
          <div class="center">
            <img height="50" width="150" src="{{ $it->tanda_tangan ? public_path('images/user/tanda_tangan/'.$it->tanda_tangan) : public_path('images/user/tanda_tangan/not-found.jpg') }}" />
          </div>
          <br>
          <b>Nama: {{$it->nama}}</b>
        </td>
        <td>
            <div class="center">
              <img height="50" width="150" src="{{ $manager->karyawan->tanda_tangan ? public_path('images/user/tanda_tangan/'.$manager->karyawan->tanda_tangan) : public_path('images/user/tanda_tangan/not-found.jpg') }}" />
            </div>
            <br>
            <b>Nama: {{$manager->karyawan->nama}}</b>
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
  <img src="{{public_path('images/laporan_pengajuan/asset_footer.jpg')}}" height="380" style="position:absolute; float:right; bottom: 0;"/>
</body>

</html>