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
                  <a  href="{{route('karyawan.show', $data->id)}}" class="btn" style="display: block"><span class="fa fa-eye fa-lg" title="Detail Pengguna"></span><br>Detail</a>
                  <a class="btn" href="{{route('karyawan.edit', $data->id)}}" style="display: block;color:green"><span class="fa fa-pencil fa-lg" title="Ubah Data"></span><br>Edit</a>
                  <form action="{{ route('karyawan.destroy', $data->id) }}" method="post" style="text-align: center">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <a class="btn" onclick="return confirm('Anda yakin ingin menghapus data ini?')" style="color:red"> <span class="fa fa-trash fa-lg" title="Hapus Data"></span>
                      <br>Hapus
                    </a>
                  </form>
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