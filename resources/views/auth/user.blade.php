@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "language": {
            "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
            "sEmptyTable": "Tidak ada data di database"
        }
    });

} );
</script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">

  <div class="col-lg-2">
    <a href="{{ route('user.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Pengguna</a>
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
                  <h4 class="card-title pull-left">Data Pengguna Sistem</h4>
                  <div class="card-title pull-right">
                    <a href="{{ url('laporan/pengguna/pdf') }}" class="btn btn-danger btn-rounded btn-fw mt-2">
                      <b><i class="fa fa-download"></i> Export PDF</b>
                    </a>
                    <a href="{{ url('laporan/pengguna/excel') }}" class="btn btn-success btn-rounded btn-fw mt-2">
                      <b><i class="fa fa-download"></i> Export Excel</b>
                    </a>
                  </div>

                  <div class="table-responsive">
                    <table id="table" class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Nama
                          </th>
                          <th>
                            Username
                          </th>
                          <th>
                            Email
                          </th>
                          <th>
                            Tanggal Buat 
                          </th>
                          <th>
                            Aksi
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($datas as $data)
                        <tr>
                          <td class="py-1">
                          @if($data->karyawan->gambar)
                            <img src="{{url('images/user', $data->karyawan->gambar)}}" alt="image" style="margin-right: 10px;" />
                          @else
                            <img src="{{url('images/user/default.png')}}" alt="image" style="margin-right: 10px; width:30px; height:20px;" />
                          @endif
                            {{$data->karyawan->nama}}
                          </td>
                          <td> 
                            {{$data->username}}
                          </td>
                          <td>
                            {{$data->email}}
                          </td>
                          <td>
                            {{date('d F Y h:i a', strtotime($data->created_at))}}
                          </td>
                          <td>
                            <a href="{{route('user.show', $data->id)}}" class="btn" style="display: block"><span class="fa fa-eye fa-lg" title="Detail User"></span><br>Detail</a>
                            <a class="btn" href="{{route('user.edit', $data->id)}}" style="display: block;color:green"><span class="fa fa-pencil fa-lg" title="Ubah Data"></span><br>Edit</a>
                            <form action="{{ route('user.destroy', $data->id) }}" method="post" style="text-align: center">
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