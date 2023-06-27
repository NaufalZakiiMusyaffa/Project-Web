@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 50
    });
  });
  $(document).on('click', '.pilih', function(e) {
    document.getElementById("aset_nama").value = $(this).attr('data-aset_nama');
    document.getElementById("aset_id").value = $(this).attr('data-aset_id');
    $('#myModal').modal('hide');
  });

  $(document).on('click', '.pilih_karyawan', function(e) {
    document.getElementById("karyawan_id").value = $(this).attr('data-karyawan_id');
    document.getElementById("karyawan_nama").value = $(this).attr('data-karyawan_nama');
    $('#myModal2').modal('hide');
  });

  $(function() {
    $("#lookup, #lookup2").dataTable({
      "language": {
        "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
        "sEmptyTable": "Tidak ada data di database"
      }
    });
  });
</script>

@stop
@section('css')

@stop
@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('transaksi.store') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="row">
    <div class="col d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Peminjaman Aset</h4>
              <div class="form-row">
                <div class="form-group col-md-6{{ $errors->has('kode_transaksi') ? ' has-error' : '' }}">
                  <label for="kode_transaksi" class="col-md-12 control-label">Kode Peminjaman</label>
                  <div class="col-md-12">
                    <input id="kode_transaksi" type="text" class="form-control" name="kode_transaksi" value="{{ $kode }}" required readonly="">
                    @if ($errors->has('kode_transaksi'))
                    <span class="help-block">
                      <strong>{{ $errors->first('kode_transaksi') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="form-group col-md-6{{ $errors->has('tgl_pinjam') ? ' has-error' : '' }}">
                  <label for="tgl_pinjam" class="col-md-12 control-label">Tanggal Pinjam</label>
                  <div class="col-md-12">
                    <input id="tgl_pinjam" type="date" class="form-control" name="tgl_pinjam" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" required @if(Auth::user()->level == 'user') readonly @endif>
                    @if ($errors->has('tgl_pinjam'))
                    <span class="help-block">
                      <strong>{{ $errors->first('tgl_pinjam') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="form-group{{ $errors->has('aset_id') ? ' has-error' : '' }}">
                <label for="aset_id" class="col-md-6 control-label">Aset</label>
                <div class="col-md-12">
                  <div class="input-group">
                    <input id="aset_nama" type="text" class="form-control" readonly="" required>
                    <input id="aset_id" type="hidden" name="aset_id" value="{{ old('aset_id') }}" required readonly="">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><b>Cari Aset</b> <span class="fa fa-search"></span></button>
                    </span>
                  </div>
                  @if ($errors->has('aset_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('aset_id') }}</strong>
                  </span>
                  @endif
                </div>
              </div>


              <div class="form-group{{ $errors->has('karyawan_id') ? ' has-error' : '' }}">
                <label for="karyawan_id" class="col-md-6 control-label">Karyawan</label>
                <div class="col-md-12">
                  <div class="input-group">
                    <input id="karyawan_nama" type="text" class="form-control" readonly="" required>
                    <input id="karyawan_id" type="hidden" name="karyawan_id" value="{{ old('karyawan_id') }}" required readonly="">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2"><b>Cari Karyawan</b> <span class="fa fa-search"></span></button>
                    </span>
                  </div>
                  @if ($errors->has('karyawan_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('karyawan_id') }}</strong>
                  </span>
                  @endif

                </div>
              </div>

              <div class="form-group{{ $errors->has('ket') ? ' has-error' : '' }}">
                <label for="ket" class="col-md-6 control-label">Keterangan</label>
                <div class="col-md-12">
                  <input id="ket" type="text" class="form-control" name="ket" value="{{ old('ket') }}">
                  @if ($errors->has('ket'))
                  <span class="help-block">
                    <strong>{{ $errors->first('ket') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="col-md-12">
                <div class="row justify-content-between">
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-4 mt-1">
                                <button type="submit" class="btn btn-primary btn-block" id="submit">
                                    Kirim
                                </button>
                            </div>
                            <div class="col-sm-6 mt-1">
                                <button type="reset" class="btn btn-danger btn-block text-truncate">
                                    Hapus Data Inputan
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <a href="{{route('transaksi.index')}}" class="btn btn-light pull-right mt-1">Kembali</a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</form>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Aset</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true\">&times;</span>
        </button>
      </div>
      <div class="modal-body table-responsive">
        <table id="lookup" class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>Nama Aset</th>
              <th>Kategori</th>
              <th>Merk</th>
              <th>Spesifikasi</th>
              <th>Status Aset</th>
            </tr>
          </thead>
          <tbody>
            @foreach($asets as $data)
            <tr class="pilih" data-aset_id="<?php echo $data->id; ?>" data-aset_nama="<?php echo $data->nama_aset; ?>">
              <td>@if($data->gambar)
                <img src="{{url('images/aset/'. $data->gambar)}}" alt="image" style="margin-right: 10px;" />
                @else
                <img src="{{url('images/aset/default.png')}}" alt="image" style="margin-right: 10px;" />
                @endif
                {{$data->nama_aset}}</td>
              <td>{{$data->kategori->nama_kategori}}</td>
              <td>{{$data->merk}}</td>
              <td>{{$data->spesifikasi}}</td>
              <td>
                @if($data->status_aset == 'Siap digunakan')
                <label class="badge badge-success">Siap digunakan</label>
                @else
                <label class="badge badge-danger">Rusak</label>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body table-responsive">
        <table id="lookup" class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>
                Nama
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
            </tr>
          </thead>
          <tbody>
            @foreach($karyawans as $data)
            <tr class="pilih_karyawan" data-karyawan_id="<?php echo $data->id; ?>" data-karyawan_nama="<?php echo $data->nama; ?>">
              <td class="py-1">
                @if($data->gambar)
                <img src="{{url('images/user', $data->gambar)}}" alt="image" style="margin-right: 10px;" />
                @else
                <img src="{{url('images/user/default.png')}}" alt="image" style="margin-right: 10px;" />
                @endif

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
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection