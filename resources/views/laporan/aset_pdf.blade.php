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
  </style>
  <link rel="stylesheet" href="">
  <title>Laporan Data Aset</title>
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
          DATA ASET IT 
            @if ($month != NULL)
              Bulan 
              @switch($month)
                  @case('01')
                      <span>Januari</span>
                      @break
                  @case('02')
                      <span>Februari</span>
                      @break
                  @case('03')
                      <span>Maret</span>
                      @break
                  @case('04')
                      <span>April</span>
                      @break
                  @case('05')
                      <span>Mei</span>
                      @break
                  @case('06')
                      <span>Juni</span>
                      @break
                  @case('07')
                      <span>Juli</span>
                      @break
                  @case('08')
                      <span>Agustus</span>
                      @break
                  @case('09')
                      <span>September</span>
                      @break
                  @case('10')
                      <span>Oktober</span>
                      @break
                  @case('11')
                      <span>November</span>
                      @break
                  @case('12')
                      <span>Desemberx</span>
                      @break
                  @default
                      
              @endswitch
            @endif 
            @if ($year != NULL)
              Tahun {{$year}}  
            @endif
        </p>
        <p style="margin-top: -10px; letter-spacing: 3px;">System Management Aset</p>
      </div>
    </div>

    <img src="{{public_path('images/laporan/garis_dibawah_logo.jpg')}}" style="max-width: 100%; clear:both; margin-top:-35px">

    <table id="pseudo-demo">
      <thead>
        <tr>
          <th>
            Nama Aset
          </th>
          <th>
            Kategori
          </th>
          <th>
            Merk
          </th>
          <th>
            Status Aset
          </th>
          <th>
            Spesifikasi
          </th>
          <th>
            Tanggal Beli
          </th>
          <th>
            Harga Beli
          </th>
        </tr>
      </thead>
      <tbody>
        @if (count($datas) > 0)
          @foreach($datas as $data)
          <tr>
            <td class="py-1">
              {{$data->nama_aset}}
            </td>
            <td>
              {{$data->kategori->nama_kategori}}
            </td>
            <td>
              {{$data->merk}}
            </td>
            <td>
              {{$data->status_aset}}
            </td>
            <td>
              {{$data->spesifikasi}}
            </td>
            <td>
              {{date('d F Y', strtotime($data->tgl_beli))}}
            </td>
            <td>
              @currency($data->harga_beli)
            </td>
          </tr>
          @endforeach    
        @else
          <tr>
            <td colspan="7" class="center">
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