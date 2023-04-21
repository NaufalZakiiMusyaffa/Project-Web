<!DOCTYPE html>
<html>

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style type="text/css">
    table {
      border-spacing: 0;
      width: 100%;
    }

    th {
      background: #404853;
      background: linear-gradient(#687587, #404853);
      border-left: 1px solid rgba(0, 0, 0, 0.2);
      border-right: 1px solid rgba(255, 255, 255, 0.1);
      padding: 8px;
      text-align: left;
      text-transform: uppercase;
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
      border-right: 1px solid #c6c9cc;
      border-bottom: 1px solid #c6c9cc;
      padding: 8px;
    }

    td:first-child {
      border-left: 1px solid #c6c9cc;
    }

    tr:first-child td {
      border-top: 0;
    }

    tr:nth-child(even) td {
      background: #e8eae9;
    }

    tr:last-child td:first-child {
      border-bottom-left-radius: 4px;
    }

    tr:last-child td:last-child {
      border-bottom-right-radius: 4px;
    }

    img {
      width: 40px;
      height: 40px;
      border-radius: 100%;
    }

    .center {
      text-align: center;
    }
  </style>
  <link rel="stylesheet" href="">
  <title>Laporan Data Aset Autocare</title>
</head>

<body>
  <h1 class="center">LAPORAN DATA ASET AUTOCARE</h1>

  <table id="pseudo-demo">
    <thead>
      <tr>
        <th>
          Kode Aset
        </th>
        <th>
          Nama Kendaraan
        </th>
        <th>
          Nomor Polisi
        </th>
        <th>
          Masa Berlaku STNK
        </th>
        <th>
          Status Kendaraan
        </th>
        <th>
          Inventaris Kepada
        </th>
      </tr>
    </thead>
    <tbody>
      @if (count($datas) > 0)
        @foreach ($datas as $data)
            <tr>
                <td class="py-1">
                    {{$data->kode_aset}}
                </td>
                <td>
                    {{$data->nama_kendaraan}}
                </td>
                <td>
                    {{$data->nopol}}
                </td>
                <td>
                    {{date('d F Y', strtotime($data->masaberlaku_stnk))}}
                </td>
                <td>
                    {{$data->status_kendaraan}}
                </td>
                <td>
                    {{$data->karyawan ? $data->karyawan->nama : '-'}}
                </td>
            </tr>
        @endforeach
      @else
        <tr>
          <td colspan="6" class="center">
            Data Tdak Ditemukan
          </td>
        </tr>  
      @endif
      
    </tbody>
  </table>
</body>

</html>