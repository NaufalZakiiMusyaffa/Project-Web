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

  @if(Auth::user()->level == 'it')
  <div class="col-lg-2">
    <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Data Kategori</a>
  </div>
  @endif
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
        <h4 class="card-title">Data Kategori</h4>

        <div class="table-responsive">
          <table class="table table-striped" id="table">
            <thead>
              <tr>
                <th style="text-align: center">
                  Nama Kategori
                </th>
                @if(Auth::user()->level == 'it')
                <th style="text-align: center">
                  Aksi
                </th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($datas as $data)
              <tr>
                <td style="text-align: center">
                  {{$data->nama_kategori}}
                </td>
                @if(Auth::user()->level == 'it')
                <td style="text-align: center">
                  <a class="btn ml-2" href="{{route('kategori.edit', $data->id)}}" style="color:green;"><span class="fa fa-pencil fa-lg" title="Ubah Data"></span><br>Edit</a>
                  <form action="{{ route('kategori.destroy', $data->id) }}" method="post" style="display: inline" style="display: block;" class="text-center">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button class="btn" onclick="return confirm('Anda yakin ingin menghapus data ini?')" style="background-color:transparent;color:red"> <span class="fa fa-trash fa-lg" title="Hapus Data"></span>
                      <br>Hapus
                    </button>
                  </form>
                </td>
                @endif
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