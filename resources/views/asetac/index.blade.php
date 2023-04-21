@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "language": {
        "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
        "sEmptyTable": "Tidak ada data di database"
      }
    });

  });
</script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">

  <div class="col-lg-8">
    <a href="{{ route('asetac.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Data Aset Autocare</a>
  </div>

  <div class="col-lg-12">
    @if (Session::has('message'))
    <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
    @endif
  </div>
</div>
<div class="row" style="margin-top: 20px;">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">

      <div class="card-body">
        <h4 class="card-title pull-left">Data Aset Autocare</h4>
        <!--      <a href="{{url('format_buku')}}" class="btn btn-xs btn-info pull-right">Format Buku</a> -->
        <div class="card-title pull-right">
          <a href="{{ url('laporan/asetac/pdf') }}" class="btn btn-danger btn-rounded btn-fw mt-2">
            <b><i class="fa fa-download"></i> Export PDF</b>
          </a>
          <a href="{{ url('laporan/asetac/excel') }}" class="btn btn-success btn-rounded btn-fw mt-2">
            <b><i class="fa fa-download"></i> Export Excel</b>
          </a>
        </div>
        <div class="table-responsive">
          <table class="table table-striped" id="table">
            <thead>
              <tr>
                <th>
                  Kode Aset Kendaraan
                </th>
                <th>
                  Nama Kendaraan
                </th>
                <th>
                  No. Polisi
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
                <th>
                  Aksi
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($datas as $data)
              <tr>
                <td>
                  {{$data->kode_aset}}
                </td>
                <td>
                  <a href="{{route('asetac.show', $data->id)}}">
                    {{$data->nama_kendaraan}}
                  </a>
                </td>
                <td>
                  {{$data->nopol}}
                </td>
                <td>
                  {{date('d F Y', strtotime($data->masaberlaku_stnk))}}
                </td>
                <td>
                  @if($data->status_kendaraan == 'Sedang dipinjam')
                  <label class="badge badge-primary">Sedang dipinjam</label>
                  @elseif($data->status_kendaraan == 'Siap digunakan')
                  <label class="badge badge-success">Siap digunakan</label>
                  @elseif($data->status_kendaraan == 'Digunakan')
                  <label class="badge badge-warning">Digunakan</label>
                  @else
                  <label class="badge badge-danger">Ada Kerusakan</label>
                  @endif
                </td>
                <td>
                  @if($data->karyawan != null)
                  <label class="badge badge-primary">{{$data->karyawan->nama}}</label>
                  @else
                  <label class="badge badge-primary">-</label>
                  @endif
                </td>
                <td>
                  @if($data->status_kendaraan > '0')
                  <div class="btn-group dropdown">
                    <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Aksi
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                      <a class="dropdown-item" href="{{route('asetac.edit', $data->id)}}"> Ubah Data </a>
                      <form action="{{ route('asetac.destroy', $data->id) }}" class="pull-left" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="dropdown-item" onclick="return confirm('Anda yakin ingin menghapus data ini?')"> Hapus Data
                        </button>
                      </form>
                    </div>
                  </div>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        {{-- {!! $datas->links() !!} --}}
      </div>
    </div>
  </div>
</div>
@endsection