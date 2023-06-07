@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#table').DataTable({
      "language": {
        "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
        "sEmptyTable": "Tidak ada data di database"
      }
    });
    $('.option-export').change(function() {
        if( $(this).val() == 1) {
            $('.month-choice').prop( "disabled", true );
            $('.year-choice').prop( "disabled", true );
            document.getElementsByClassName('month-choice').value = "";
            document.getElementsByClassName('year-choice').value = "";
        } else {       
            $('.month-choice').prop( "disabled", false );
            $('.year-choice').prop( "disabled", false )
        }
    });
    $('#filter-aset').change(function () {
      var UserOption  = document.getElementById('filter-aset').value;
      table.search(this.value).draw();
      document.getElementById('get_status').value = this.value;
    });
  });
</script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-8">
    <a href="{{ route('aset.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Data Aset</a>
  </div>
  <div class="col-lg-12">
    @if (Session::has('message'))
    <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
    @endif
  </div>
</div>
<div class="row" style="margin-top: 20px;">
  <div class="col-md-12">
    <label class="badge badge-primary">Filter Aset</label>
  </div>
  <div class="col-lg-12 grid-margin stretch-card">
    <select id="filter-aset" class="form-control filter" name="status_aset" form="reportForm">
      <option value="">Pilih Status Aset</option>
      <option value="Sedang dipinjam">Sedang Dipinjam</option>
      <option value="Siap digunakan">Siap Digunakan</option>
      <option value="Digunakan">Digunakan</option>
      <option value="Rusak(Bisa diperbaiki)">Rusak(Bisa Diperbaiki)</option>
      <option value="Sedang diperbaiki">Sedang Diperbaiki</option>
      <option value="Rusak Total">Rusak Total</option>
    </select>
    <input type="hidden" id="get_status" name="status_aset" form="reportFormExcel"/>
  </div>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">

      <div class="card-body">        
        <h4 class="card-title pull-left">Data Aset IT</h4>
        <!--      <a href="{{url('format_buku')}}" class="btn btn-xs btn-info pull-right">Format Buku</a> -->
        <div class="card-title pull-right">
          <button type="button" class="btn btn-danger btn-rounded btn-fw mt-2" data-toggle="modal" data-target="#exportPDFModal">
            <b><i class="fa fa-download"></i> Export PDF</a></b>
          </button>
          <button type="button" class="btn btn-success btn-rounded btn-fw mt-2" data-toggle="modal" data-target="#exportExcelModal">
            <b><i class="fa fa-download"></i> Export Excel</a></b>
          </button>
        </div>
        
        <!-- Modal PDF-->
        <form method="POST" action="laporan/aset/pdf" enctype="multipart/form-data" id="reportForm">
          {{ csrf_field() }}
          <div class="modal fade" id="exportPDFModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Pilih Bulan dan Tahun</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <select name="export-type" class="form-control option-export">
                      <option value="1">Export Semua Data</option>
                      <option value="2">Export Berdasarkan Tanggal</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Bulan</label>
                    <select name="bulan" class="form-control month-choice" disabled>
                      <option value="">Pilih Bulan</option>
                      <option value='01'>Januari</option>
                      <option value='02'>Februari</option>
                      <option value='03'>Maret</option>
                      <option value='04'>April</option>
                      <option value='05'>Mei</option>
                      <option value='06'>Juni</option>
                      <option value='07'>Juli</option>
                      <option value='08'>Agustus</option>
                      <option value='09'>September</option>
                      <option value='10'>Oktober</option>
                      <option value='11'>November</option>
                      <option value='12'>Desember</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Tahun(yyyy)</label>
                    <input type="text" class="form-control year-choice" name="tahun" disabled placeholder="<?php echo date("Y"); ?>">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutp</button>
                  <input class="btn btn-primary" type="submit" value="Export Data">
                </div>
              </div>
            </div>
          </div>
        </form>
        {{-- Modal Excel --}}
        <form method="POST" action="laporan/aset/excel" enctype="multipart/form-data" id="reportFormExcel">
          {{ csrf_field() }}
          <div class="modal fade" id="exportExcelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Pilih Bulan dan Tahun</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <select name="export-type" class="form-control option-export">
                      <option value="1">Export Semua Data</option>
                      <option value="2">Export Berdasarkan Tanggal</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Bulan</label>
                    <select name="bulan" class="form-control month-choice" disabled>
                      <option value="">Pilih Bulan</option>
                      <option value='01'>Januari</option>
                      <option value='02'>Februari</option>
                      <option value='03'>Maret</option>
                      <option value='04'>April</option>
                      <option value='05'>Mei</option>
                      <option value='06'>Juni</option>
                      <option value='07'>Juli</option>
                      <option value='08'>Agustus</option>
                      <option value='09'>September</option>
                      <option value='10'>Oktober</option>
                      <option value='11'>November</option>
                      <option value='12'>Desember</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Tahun(yyyy)</label>
                    <input type="text" class="form-control year-choice" name="tahun" disabled placeholder="<?php echo date("Y"); ?>">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutp</button>
                  <input class="btn btn-primary" type="submit" value="Export Data">
                </div>
              </div>
            </div>
          </div>
        </form>

        <div class="table-responsive">
          <table class="table table-striped" id="table">
            <thead>
              <tr>
                <th>
                  Kode Aset
                </th>
                <th>
                  Nama Aset
                </th>
                <th>
                  Kategori
                </th>
                <th>
                  Status Aset
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
                  {{$data->nama_aset}}
                </td>
                <td>
                  {{$data->kategori->nama_kategori}}
                </td>
                <td>
                  @if($data->status_aset == 'Sedang dipinjam')
                  <label class="badge badge-primary">Sedang dipinjam</label>
                  @elseif($data->status_aset == 'Siap digunakan')
                  <label class="badge badge-success">Siap digunakan</label>
                  @elseif($data->status_aset == 'Digunakan')
                  <label class="badge badge-warning">Digunakan</label>
                  @elseif($data->status_aset == 'Rusak(Bisa diperbaiki)')
                  <label class="badge badge-danger">Rusak(Bisa diperbaiki)</label>
                  @elseif($data->status_aset == 'Sedang diperbaiki')
                  <label class="badge badge-info">Sedang diperbaiki</label>
                  @else
                  <label class="badge badge-danger">Rusak Total</label>
                  @endif
                </td>
                <td style="text-align: center;">
                  @if($data->karyawan != null)
                  <label class="badge badge-primary">{{$data->karyawan->nama}}</label>
                  @else
                  <label class="badge badge-primary">-</label>
                  @endif
                </td>
                <td>
                  <a href="{{route('aset.show', $data->id)}}" class="btn" style="display: block"><span class="fa fa-eye fa-lg" title="Detail Aset"></span><br>Detail</a>
                  @if($data->status_aset > 'Sedang dipinjam')
                  <a href="{{route('aset.edit', $data->id)}}" class="btn" style="display: block;color:green"><span class="fa fa-pencil fa-lg" title="Ubah Data"></span><br>Edit</a>
                  <form action="{{ route('aset.destroy', $data->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <a class="btn" onclick="return confirm('Anda yakin ingin menghapus data ini?')" style="color:red"> <span class="fa fa-trash fa-lg" title="Hapus Data"></span>
                      <br>Hapus
                    </a>
                  </form>
                  
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