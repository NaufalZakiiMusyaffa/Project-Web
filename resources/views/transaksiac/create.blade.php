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
  $(document).on('click', '.pilih', function(e) {
    document.getElementById("aset_nama").value = $(this).attr('data-aset_nama');
    document.getElementById("asetac_id").value = $(this).attr('data-asetac_id');
    $('#myModal').modal('hide');
  });

  $(document).on('click', '.pilih_karyawan', function(e) {
    document.getElementById("karyawan_id").value = $(this).attr('data-karyawan_id');
    document.getElementById("karyawan_nama").value = $(this).attr('data-karyawan_nama');
    $('#myModal2').modal('hide');
  });

  $(function() {
    $("#lookup, #lookup2").dataTable();
  });
</script>

@stop
@section('css')

@stop
@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('transaksiac.store') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-9 d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col-9">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Peminjaman Aset Autocare</h4>
              <div class="float-left">
                <div class="form-group{{ $errors->has('kode_peminjaman') ? ' has-error' : '' }}">
                  <label for="kode_peminjaman" class="col-md-12 control-label">Kode Peminjaman</label>
                  <div class="col-md-12">
                    <input id="kode_peminjaman" type="text" class="form-control" name="kode_peminjaman" value="{{ $kode }}" required readonly="">
                    @if ($errors->has('kode_peminjaman'))
                    <span class="help-block">
                      <strong>{{ $errors->first('kode_peminjaman') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="float-right">
                <div class="form-group{{ $errors->has('tgl_kembali') ? ' has-error' : '' }}">
                  <label for="tgl_kembali" class="col-md-12 control-label">Tanggal Kembali *</label>
                  <div class="col-md-12">
                    <input id="tgl_kembali" type="date" class="form-control" name="tgl_kembali" value="{{ old('tgl_kembali') }}" required="">
                    @if ($errors->has('tgl_kembali'))
                    <span class="help-block">
                      <strong>{{ $errors->first('tgl_kembali') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="float-right">
                <div class="form-group{{ $errors->has('tgl_pinjam') ? ' has-error' : '' }}">
                  <label for="tgl_pinjam" class="col-md-12 control-label">Tanggal Pinjam *</label>
                  <div class="col-md-12">
                    <input id="tgl_pinjam" type="date" class="form-control" name="tgl_pinjam" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}">
                    @if ($errors->has('tgl_pinjam'))
                    <span class="help-block">
                      <strong>{{ $errors->first('tgl_pinjam') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="form-group{{ $errors->has('supir_id') ? ' has-error' : '' }}">
                <label for="supir_id" class="col-md-12 control-label">Supir *</label>
                <div class="col-md-12">
                  <select class="form-control" name="supir_id" required="">
                    @foreach($drivers as $data)
                    <option value="{{ $data->id }}">{{$data->nama_supir}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group{{ $errors->has('asetac_id') ? ' has-error' : '' }}">
                <label for="asetac_id" class="col-md-6 control-label">Kendaraan *</label>
                <div class="col-md-12">
                  <div class="input-group">
                    <input id="aset_nama" type="text" class="form-control" readonly="" required>
                    <input id="asetac_id" type="hidden" name="asetac_id" value="{{ old('asetac_id') }}" required readonly="">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><b>Cari Kendaraan</b> <span class="fa fa-search"></span></button>
                    </span>
                  </div>
                  @if ($errors->has('asetac_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('asetac_id') }}</strong>
                  </span>
                  @endif
                </div>
              </div>


              <div class="form-group{{ $errors->has('karyawan_id') ? ' has-error' : '' }}">
                <label for="karyawan_id" class="col-md-6 control-label">Peminjam *</label>
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
                <button type="submit" class="btn btn-primary" id="submit">
                  Kirim
                </button>
                <button type="reset" class="btn btn-danger">
                  Hapus Data Inputan
                </button>
                <a href="{{route('transaksiac.index')}}" class="btn btn-light pull-right">Kembali</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Cari Kendaraan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true\">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="lookup" class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>Nama Kendaraan</th>
              <th>No. Polisi</th>
              <th>Masa Berlaku STNK</th>
              <th>Status Kendaraan</th>
            </tr>
          </thead>
          <tbody>
            @foreach($autocares as $data)
            <tr class="pilih" data-asetac_id="<?php echo $data->id; ?>" data-aset_nama="<?php echo $data->nama_kendaraan; ?>">
              <td>{{$data->nama_kendaraan}}</td>
              <td>{{$data->nopol}}</td>
              <td>{{$data->masaberlaku_stnk}}</td>
              <td>
                @if($data->status_kendaraan == '1')
                <label class="badge badge-success">Siap digunakan</label>
                @else
                <label class="badge badge-danger">Ada Kerusakan</label>
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
      <div class="modal-body">
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
                @if($data->user->gambar)
                <img src="{{url('images/user', $data->user->gambar)}}" alt="image" style="margin-right: 10px;" />
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