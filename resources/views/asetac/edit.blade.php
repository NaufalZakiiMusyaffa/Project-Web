@section('js')

<script type="text/javascript">
  $(document).ready(function() {
    $(".users").select2();
  });

  $(document).on('click', '.pilih_karyawan', function(e) {
    document.getElementById("karyawan_id").value = $(this).attr('data-karyawan_id');
    document.getElementById("karyawan_nama").value = $(this).attr('data-karyawan_nama');
    $('#myModal2').modal('hide');
  });

  $(function() {
    $("#lookup").dataTable({
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

<form action="{{ route('asetac.update', $data->id) }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field('put') }}
  <div class="row">
    <div class="col d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Ubah Data Kendaraan <b>[{{$data->nama_kendaraan}}]</b> </h4>
              @if($data->status_kendaraan !== 'Sedang dipinjam')
              <div class="float-left">
                <div class="form-group{{ $errors->has('status_kendaraan') ? ' has-error' : '' }}">
                  <label for="status_kendaraan" class="col-md-12 control-label">Status Kendaraan *</label>
                  <div class="col-md-12">
                    <select class="form-control" name="status_kendaraan">
                      <option value="Siap digunakan" @if($data->status_kendaraan == 'Siap digunakan') selected @endif>Siap digunakan</option>
                      <option value="Digunakan" @if($data->status_kendaraan == 'Digunakan') selected @endif>Digunakan</option>
                      <option value="Ada Kerusakan" @if($data->status_kendaraan == 'Ada Kerusakan') selected @endif>Ada Kerusakan</option>
                    </select>
                  </div>
                </div>
              </div>
              @endif

              <div class="float-left">
                <div class="form-group{{ $errors->has('kode_aset') ? ' has-error' : '' }}">
                  <label for="kode_aset" class="col-md-12 control-label">Kode Aset Kendaraan</label>
                  <div class="col-md-12">
                    <input id="kode_aset" type="text" class="form-control" name="kode_aset" value="{{ $data->kode_aset }}" required readonly="">
                    @if ($errors->has('kode_aset'))
                    <span class="help-block">
                      <strong>{{ $errors->first('kode_aset') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="form-group{{ $errors->has('karyawan_id') ? ' has-error' : '' }}">
                <label for="karyawan_id" class="col-md-12 control-label">Pilih karyawan bila status kendaraan <b>[ Digunakan ]</b></label>
                <div class="col-md-12">
                  <div class="input-group">
                    @if($data->karyawan != null)
                    <input id="karyawan_nama" type="text" class="form-control" value="{{ $data->karyawan->nama }}" required readonly="">
                    <input id="karyawan_id" type="hidden" name="karyawan_id" value="{{ $data->karyawan_id }}" required readonly="">
                    @else
                    <input id="karyawan_nama" type="text" class="form-control" value="-"  readonly="" required>
                    <input id="karyawan_id" type="hidden" name="karyawan_id" value="" required readonly="">
                    @endif
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

              <div class="form-row">  
                <div class="form-group col-md-6{{ $errors->has('nama_kendaraan') ? ' has-error' : '' }}">
                  <label for="nama_kendaraan" class="col-md-6 control-label">Nama Kendaraan *</label>
                  <div class="col-md-12">
                    <input id="nama_kendaraan" type="text" class="form-control" name="nama_kendaraan" value="{{ $data->nama_kendaraan  }}" required>
                    @if ($errors->has('nama_kendaraan'))
                    <span class="help-block">
                      <strong>{{ $errors->first('nama_kendaraan') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="form-group col-md-6{{ $errors->has('nopol') ? ' has-error' : '' }}">
                  <label for="nopol" class="col-md-6 control-label">No. Polisi *</label>
                  <div class="col-md-12">
                    <input id="nopol" type="text" class="form-control" name="nopol" value="{{ $data->nopol }}" maxlength="10" required>
                    @if ($errors->has('nopol'))
                    <span class="help-block">
                      <strong>{{ $errors->first('nopol') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="form-group{{ $errors->has('masaberlaku_stnk') ? ' has-error' : '' }}">
                <label for="masaberlaku_stnk" class="col-md-4 control-label">Masa Berlaku STNK *</label>
                <div class="col-md-12">
                  <input id="masaberlaku_stnk" type="date" class="form-control" name="masaberlaku_stnk" value="{{ $data->masaberlaku_stnk }}" required="">
                  @if ($errors->has('masaberlaku_stnk'))
                  <span class="help-block">
                    <strong>{{ $errors->first('masaberlaku_stnk') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="col-md-12">
                <div class="row justify-content-between">
                    <div class="col-sm-4 mt-2">
                        <button type="submit" class="btn btn-primary btn-block" id="submit">
                            Perbaharui Data
                        </button>
                    </div>
                    <div class="col-sm-4 mt-2">
                        <a href="{{route('asetac.index')}}" class="btn btn-light pull-right">Kembali</a>
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