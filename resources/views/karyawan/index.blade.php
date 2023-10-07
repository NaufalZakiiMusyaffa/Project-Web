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

  <div class="col-lg-2">
    <a href="{{ route('karyawan.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Data Karyawan</a>
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
        <h4 class="card-title pull-left">Data Karyawan</h4>
        <div class="card-title pull-right">
          <a href="{{ url('laporan/karyawan/pdf') }}" class="btn btn-danger btn-rounded btn-fw mt-2">
            <b><i class="fa fa-download"></i> Export PDF</b>
          </a>
          <a href="{{ url('laporan/karyawan/excel') }}" class="btn btn-success btn-rounded btn-fw mt-2">
            <b><i class="fa fa-download"></i> Export Excel</b>
          </a>
        </div>

        <div class="table-responsive">
          <table class="table table-striped" id="table">
            <thead>
              <tr>
                <th>
                  Nama Karyawan
                </th>
                <th>
                  NIK
                </th>
                <th>
                  Jenis Kelamin
                </th>
                <th>
                  Jabatan
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
                  {{$data->nama}}
                </td>
                <td>
                  {{$data->nik}}
                </td>
                <td>
                  {{$data->jk === "L" ? "Laki - Laki" : "Perempuan"}}
                </td>
                <td>
                  {{$data->jabatan}}
                </td>
                <td>
                  <div class="btn-group dropdown">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Aksi
                          </button>
                          <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                            <a class="dropdown-item" href="{{route('karyawan.show', $data->id)}}" style="color:blue"> Lihat Data </a>
                            <a class="dropdown-item" href="{{route('karyawan.edit', $data->id)}}" style="color:green"> Ubah Data </a>
                            <form action="{{ route('karyawan.destroy', $data->id) }}" class="pull-left"  method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button class="dropdown-item" onclick="return confirm('Anda yakin ingin menghapus data ini?')" style="color:red"> Hapus Data
                            </button>
                          </form>
                          </div>
                        </div>
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