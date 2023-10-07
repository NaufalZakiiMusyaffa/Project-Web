<!DOCTYPE html>
<html>

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style type="text/css">
    @page { margin: 0px; }

    body {
      font-family: 'Montserrat', sans-serif;
    }

    .body-report {
      margin: 5px 40px;
    }
    .header-logo {
      float:left;
    }

    .header-title {
      margin-left: 15px;
    }

    .title-report {
      font-weight: bolder;
      font-size: 22px;
      color: #5D4540;
    }
    table {
      border-spacing: 0;
      width: 100%;
      font-size: 11px;
    }

    th {
      background: #5D4540;
      padding: 8px;
      text-align: left;
      text-transform: uppercase;
      color: white
    }

    th:first-child {
      border-top-left-radius: 4px;
      border-left: 0;
    }
    th:last-child {
      border-top-right-radius: 4px;
      border-right: 0;
    }
    td {
      padding: 8px;
    }
    tr:first-child td {
      border-top: 0;
      padding-top: 16px;
    }

    tr:nth-child(even) td {
      background: #e8eae9;
    }

    /* img {
      width: 40px;
      height: 40px;
      border-radius: 100%;
    } */

    .center {
      text-align: center;
    }

    .badge {
      display: inline-block;
      padding: 0.25em 0.4em;
      font-size: 75%;
      font-weight: 700;
      line-height: 1;
      text-align: center;
      white-space: nowrap;
      vertical-align: baseline;
      border-radius: 0.25rem;
    }

    .badge-warning {
      color: #212529;
      background-color: #ffaf00;
    }

    .badge-warning[href]:hover,
    .preview-list .preview-item .preview-thumbnail [href].badge.badge-busy:hover,
    .badge-warning[href]:focus,
    .preview-list .preview-item .preview-thumbnail [href].badge.badge-busy:focus {
      color: #212529;
      text-decoration: none;
      background-color: #cc8c00;
    }

    .badge-success,
    .preview-list .preview-item .preview-thumbnail .badge.badge-online {
      color: #fff;
      background-color: #00ce68;
    }

    .badge-success[href]:hover,
    .preview-list .preview-item .preview-thumbnail [href].badge.badge-online:hover,
    .badge-success[href]:focus,
    .preview-list .preview-item .preview-thumbnail [href].badge.badge-online:focus {
      color: #fff;
      text-decoration: none;
      background-color: #009b4e;
    }
  </style>
  <link rel="stylesheet" href="">
  <title>Laporan Data Transaksi</title>
</head>

<body>
  <img src="{{public_path('images/laporan/bagian_atas.jpg')}}" style="max-width: 100%">
  
  <div class="body-report">
    <div class="header-report">
      <div class="header-logo">
        <img src="{{public_path('images/laporan/logo.png')}}" style="height: 120px;">
      </div>
      <div class="header-title">
        <p class="title-report">
          DATA PEMINJAMAN/PENGEMBALIAN ASET AUTOCARE
        </p>
        <p style="margin-top: -10px; letter-spacing: 3px; ">System Management Aset</p>
      </div>
    </div>
    
    <img src="{{public_path('images/laporan/garis_dibawah_logo.jpg')}}" style="max-width: 100%; clear:both; margin-top:-35px">
    
    <table id="pseudo-demo">
      <thead>
          <tr>
            <th>
              Kode Peminjaman
            </th>
            <th>
              Nama Kendaraan
            </th>
            <th>
              Peminjam
            </th>
            <th>
              Supir
            </th>
            <th>
              Tgl Pinjam
            </th>
            <th>
              Tgl Kembali
            </th>
            <th>
              Keterangan
            </th>
            <th>
              Status
            </th>
          </tr>
      </thead>
      <tbody>
        @if (count($datas) > 0)
          @foreach($datas as $data)
          <tr>
              <td>
                {{$data->kode_peminjaman}}
              </td>
              <td>
  
                {{$data->asetac->nama_kendaraan}}
  
              </td>
  
              <td>
                {{$data->karyawan->nama}}
              </td>
              <td>
                {{$data->supir->nama_supir}}
              </td>
              <td>
                {{date('d F Y', strtotime($data->tgl_pinjam))}}
              </td>
              <td>
                @if ($data->tgl_kembali)
                  {{date('d F Y', strtotime($data->tgl_kembali))}}
                @else
                  -  
                @endif
              </td>
              <td>
                {{$data->ket}}
              </td>
              <td>
                @if($data->status == 'pinjam')
                <label class="badge badge-warning">Sedang dipinjam</label>
                @else
                <label class="badge badge-success">Sudah Kembali</label>
                @endif
              </td>
            </tr>
          @endforeach 
        @else
          <tr>
            <td colspan="8" class="center">
              Data Tdak Ditemukan
            </td>
          </tr>  
        @endif
      </tbody>
    </table>
  </div>
  
  <div style="position: absolute; bottom: 0;">
    <img src="{{public_path('images/laporan/bagian_bawah.jpg')}}" style="max-width: 100%;">
  </div>  
</body>

</html>