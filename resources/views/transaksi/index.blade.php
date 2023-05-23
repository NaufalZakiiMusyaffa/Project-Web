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
            $('.date-choice').prop( "disabled", true );
            document.getElementsByClassName('date-choice').value = "";
        } else {       
            $('.date-choice').prop( "disabled", false )
        }
    });
    $('.status-transaksi').change(function() {
        if( $(this).val() == 'pinjam') {
            $('.loan-label').attr("hidden", false);
            $('.loan-date').attr("hidden", false);
            $('.return-label').attr("hidden", true);
            $('.return-date').attr("hidden", true);
            document.getElementsByClassName('return-date').value = "";
        } else if( $(this).val() == 'kembali') {
            $('.loan-label').attr("hidden", true);
            $('.loan-date').attr("hidden", true);
            $('.return-label').attr("hidden", false);
            $('.return-date').attr("hidden", false);
            document.getElementsByClassName('loan-date').value = "";
        } else {
            $('.loan-label').attr("hidden", true);
            $('.loan-date').attr("hidden", true);
            $('.return-label').attr("hidden", true);
            $('.return-date').attr("hidden", true);
            document.getElementsByClassName('loan-date').value = "";
            document.getElementsByClassName('return-date').value = "";
        }
    });
    $('#filter-transaksi').change(function () {
      var UserOption  = document.getElementById('filter-transaksi').value;
      table.search(this.value).draw();
      document.getElementById('get_status').value = this.value;
      document.getElementsByClassName('status-transaksi')[0].value = this.value;
      document.getElementsByClassName('status-transaksi')[1].value = this.value;
    });
  });
</script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-2">
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Peminjaman</a>
  </div>
  <div class="col-lg-12">
    @if (Session::has('message'))
    <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
    @endif
  </div>
</div>
<div class="row" style="margin-top: 20px;">
  <div class="col-md-12">
    <label class="badge badge-primary">Filter Transaksi</label>
  </div>
  <div class="col-lg-12 grid-margin stretch-card">
    <select id="filter-transaksi" class="form-control filter" name="status_transaksi" form="reportForm">
      <option value="">Pilih Status Transaksi</option>
      <option value="pinjam">Sedang Dipinjam</option>
      <option value="kembali">Sudah Kembali</option>
    </select>
    <input type="hidden" id="get_status" name="status_transaksi" form="reportFormExcel"/>
  </div>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">

      <div class="card-body">
        <h4 class="card-title pull-left">Data Keseluruhan Peminjaman / Pengembalian Aset IT</h4>
        <div class="card-title pull-right">
          <button type="button" class="btn btn-danger btn-rounded btn-fw mt-2" data-toggle="modal" data-target="#exportPDFModal">
            <b><i class="fa fa-download"></i> Export PDF</b>
          </button>
          <button type="button" class="btn btn-success btn-rounded btn-fw mt-2" data-toggle="modal" data-target="#exportExcelModal">
            <b><i class="fa fa-download"></i> Export Excel</b>
          </button>
        </div>

        <!-- Modal PDF-->
        <form method="POST" action="laporan/trs/pdf" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="modal fade" id="exportPDFModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Pilihan Export</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label>Status Transaksi</label>
                    <select name="status" class="form-control status-transaksi">
                      <option value="">Semua Transaksi</option>
                      <option value="pinjam">Pinjam</option>
                      <option value="kembali">Kembali</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Jenis Export</label>
                    <select name="export-type" class="form-control option-export">
                      <option value="1">Export Semua Data</option>
                      <option value="2">Export Berdasarkan Tanggal</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="loan-label" hidden>Tanggal Pinjam</label>
                    <input type="date" class="form-control date-choice loan-date" name="tgl_pinjam" hidden disabled>
                  </div>
                  <div class="form-group">
                    <label class="return-label" hidden>Tanggal Kembali</label>
                    <input type="date" class="form-control date-choice return-date" name="tgl_kembali" hidden disabled>
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
        <form method="POST" action="laporan/trs/excel" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="modal fade" id="exportExcelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Pilihan Export</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label>Status Transaksi</label>
                    <select name="status" class="form-control status-transaksi">
                      <option value="">Semua Transaksi</option>
                      <option value="pinjam">Pinjam</option>
                      <option value="kembali">Kembali</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Jenis Export</label>
                    <select name="export-type" class="form-control option-export">
                      <option value="1">Export Semua Data</option>
                      <option value="2">Export Berdasarkan Tanggal</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="loan-label">Tanggal Pinjam</label>
                    <input type="date" class="form-control date-choice loan-date" name="tgl_pinjam" disabled>
                  </div>
                  <div class="form-group">
                    <label class="return-label" hidden>Tanggal Kembali</label>
                    <input type="date" class="form-control date-choice return-date" name="tgl_kembali" hidden disabled>
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
                  Kode
                </th>
                <th>
                  Nama Aset
                </th>
                <th>
                  Peminjam
                </th>
                <th>
                  Tgl Pinjam
                </th>
                <th>
                  Tgl Kembali
                </th>
                <th>
                  Status
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
                  <a href="{{route('transaksi.show', $data->id)}}">
                    {{$data->kode_transaksi}}
                  </a>
                </td>
                <td>

                  {{$data->aset->nama_aset}}

                </td>

                <td>
                  {{$data->karyawan->nama}}
                </td>
                <td>
                  {{$data->tgl_pinjam}}
                </td>
                <td>
                  {{$data->tgl_kembali}}
                </td>
                <td>
                  @if($data->status == 'pinjam')
                  <label class="badge badge-warning">Pinjam</label>
                  @else
                  <label class="badge badge-success">Kembali</label>
                  @endif
                </td>
                <td>
                  @if(Auth::user()->level == 'manager')
                  <div class="btn-group dropdown">
                    <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Aksi
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                      @if($data->status == 'pinjam')
                      <form action="{{ route('transaksi.update', $data->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <button class="dropdown-item" onclick="return confirm('Anda yakin aset ini sudah kembali?')"> Sudah Kembali
                        </button>
                      </form>
                      @endif
                      @if($data->status == 'kembali')
                      <form action="{{ route('transaksi.destroy', $data->id) }}" class="pull-left" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="dropdown-item" onclick="return confirm('Anda yakin ingin menghapus data ini?')"> Hapus
                        </button>
                      </form>
                      @endif
                    </div>
                  </div>
                  @else
                  @if($data->status == 'pinjam')
                  <form action="{{ route('transaksi.update', $data->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <button class="btn btn-info btn-xs" onclick="return confirm('Anda yakin aset ini sudah kembali?')">Sudah Kembali
                    </button>
                  </form>
                  @else
                  -
                  @endif
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