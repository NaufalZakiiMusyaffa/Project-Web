
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
  <div class="col-lg-12">
    <a href="{{ route('history.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Data</a>
  </div>
</div>
<div class="row" style="margin-top: 20px;">
  <div class="col-md-12">
    <label class="badge badge-primary">Filter Aset</label>
  </div>
  <div class="col-lg-12 grid-margin stretch-card">
    <select id="filter-jejak" class="form-control filter">
      <option value="">Pilih Aset</option>
      @foreach($datas as $data)
      <option value="{{$data->id}}">{{$data->aset->nama_aset}}</option>
      @endforeach
    </select>
  </div>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title pull-left">Data Jejak Aset</h4>
        <div class="table-responsive">
          <table class="table table-striped" id="table">
            <thead>
              <tr>
                <th>
                  Tanggal Jejak
                </th>
                <th>
                  Nama Aset
                </th>
                <th>
                  Tindakan
                </th>
                <th>
                  Teknisi
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
                  {{date('d F Y', strtotime($data->tgl_history))}}
                </td>
                <td>
                  {{$data->aset->nama_aset}}
                </td>
                <td>
                  {{$data->tindakan}}
                </td>
                <td>
                  {{$data->karyawan->nama}}
                </td>
                <td>
                  <div class="btn-group dropdown">
                    <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Aksi
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                      <a class="dropdown-item" href="{{route('history.edit', $data->id)}}"> Ubah Data </a>
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