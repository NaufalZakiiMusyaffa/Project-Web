
@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#table').DataTable({
      "language": {
        "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
        "sEmptyTable": "Tidak ada data di database"
      }
    });
    $('#filter-jejak').change(function () {
      var UserOption  = document.getElementById('filter-jejak').value;
      table.search(this.value).draw();
      document.getElementById('get_aset').value = this.value;
    })
  });
</script>
@stop

@extends('layouts.app')

@section('content')
<div class="row">
  @if(Auth::user()->level == 'it')
  <div class="col-lg-12">
    <a href="{{ route('history.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Data</a>
  </div>
  @endif
</div>
<div class="row" style="margin-top: 20px;">
  <div class="col-md-12">
    <label class="badge badge-primary">Filter Aset</label>
  </div>
  <div class="col-lg-12 grid-margin stretch-card">
    <select id="filter-jejak" class="form-control filter" name="nama_aset" form="reportForm">
      <option value="">Pilih Aset</option>
      @foreach($datas->unique('aset.nama_aset') as $data)
      <option value="{{$data->aset->nama_aset}}">{{$data->aset->nama_aset}}</option>
      @endforeach
    </select>
    <input type="hidden" id="get_aset" name="nama_aset" form="reportFormExcel"/>
  </div>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title pull-left mt-2">Data Jejak Aset</h4>
        <div class="card-title pull-right">
          <form action="laporan/history/pdf" method="POST" class="d-inline" id="reportForm" enctype="multipart/form-data">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-rounded btn-fw mt-2">
              <b><i class="fa fa-download"></i> Export PDF</b>
            </button>
          </form>
          <form action="laporan/history/excel" method="POST" class="d-inline" id="reportFormExcel" enctype="multipart/form-data">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-success btn-rounded btn-fw mt-2">
              <b><i class="fa fa-download"></i> Export Excel</b>
            </button>
          </form>
        </div>
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
                @if(Auth::user()->level == 'it')
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
                @if(Auth::user()->level == 'it')
                <td>
                  <a class="btn" href="{{route('history.edit', $data->id)}}" style="color:green"><span class="fa fa-pencil fa-lg" title="Ubah Data"></span><br>Ubah Data</a>
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