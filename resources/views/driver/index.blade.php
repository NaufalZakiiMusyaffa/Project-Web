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
  @if(Auth::user()->level == 'autocare')
  <div class="col-lg-2">
    <a href="{{ route('driver.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Data Supir</a>
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
        <h4 class="card-title">Data Supir</h4>

        <div class="table-responsive">
          <table class="table table-striped" id="table">
            <thead>
              <tr>
                <th>
                  Kode Supir
                </th>
                <th>
                  Nama Supir
                </th>
                <th>
                  Telp/Whatsapp
                </th>
                <th>
                  Status
                </th>
                @if(Auth::user()->level == 'autocare')
                <th>
                  Aksi
                </th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach($datas as $data)
              <tr>
                <td>
                  {{$data->kode_supir}}
                </td>
                <td>
                  {{$data->nama_supir}}
                  </a>
                </td>
                <td>
                  {{$data->kontak}}
                </td>
                <td>
                  @if($data->status_supir === 'Siap')
                  <label class="badge badge-success">Siap</label>
                  @elseif($data->status_supir === "Dibooking")
                  <label class="badge badge-info">Dibooking</label>
                  @else
                  <label class="badge badge-danger">Sedang Bertugas</label>
                  @endif
                </td>
                @if(Auth::user()->level == 'autocare')
                <td>
                  @if($data->status_supir != 'Sedang Bertugas')
                  <div class="btn-group dropdown">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Aksi
                          </button>
                          <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                            <a class="dropdown-item" href="{{route('driver.edit', $data->id)}}" style="color:green"> Ubah Data </a>
                            <form action="{{ route('driver.destroy', $data->id) }}" class="pull-left"  method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button class="dropdown-item" onclick="return confirm('Anda yakin ingin menghapus data ini?')" style="color:red"> Hapus Data
                            </button>
                          </form>
                          </div>
                  </div>
                  @endif
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