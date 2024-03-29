@section('js')

<script type="text/javascript">
  $(document).ready(function() {
    $(".users").select2();
  });
</script>

<script type="text/javascript">
  $(document).on('click', '.pilih_karyawan', function(e) {
    document.getElementById("karyawan_id").value = $(this).attr('data-karyawan_id');
    document.getElementById("teknisi_nama").value = $(this).attr('data-teknisi_nama');
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

<form action="{{ route('history.update', $data->id) }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field('put') }}
  <div class="row">
    <div class="col d-flex align-items-stretch grid-margin">
      <div class="row flex-grow">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Ubah Data Jejak Aset <b>[{{$data->aset->nama_aset}}]</b> </h4>

              <div class="form-group{{ $errors->has('tgl_history') ? ' has-error' : '' }}">
                <label for="tgl_history" class="col-md-12 control-label">Tanggal Jejak</label>
                <div class="col-md-12">
                  <input id="tgl_history" type="date" class="form-control" name="tgl_history" value="{{ $data->tgl_history }}" required readonly="">
                  @if ($errors->has('tgl_history'))
                  <span class="help-block">
                    <strong>{{ $errors->first('tgl_history') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="form-group{{ $errors->has('aset_id') ? ' has-error' : '' }}">
                <label for="aset_id" class="col-md-8 control-label">Nama Aset</label>
                <div class="col-md-12">
                  <div class="input-group">
                    <input id="aset_nama" type="text" class="form-control" value="{{ $data->aset->nama_aset}}" required readonly="">
                    <input id="aset_id" type="hidden" name="aset_id" value="{{ $data->aset_id}}" required readonly="">
                  </div>
                  @if ($errors->has('aset_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('aset_id') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="form-group{{ $errors->has('tindakan') ? ' has-error' : '' }}">
                <label for="tindakan" class="col-md-6 control-label">Tindakan</label>
                <div class="col-md-12">
                  <textarea class="form-control" rows="7" id="tindakan" name="tindakan">{{ $data->tindakan }}</textarea>
                  @if ($errors->has('tindakan'))
                  <span class="help-block">
                    <strong>{{ $errors->first('tindakan') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="form-group{{ $errors->has('karyawan_id') ? ' has-error' : '' }}">
                <label for="karyawan_id" class="col-md-6 control-label">Teknisi</label>
                <div class="col-md-12">
                  <div class="input-group">
                    <input id="teknisi_nama" type="text" class="form-control" value="{{ $data->karyawan->nama }}" required readonly="">
                    <input id="karyawan_id" type="hidden" name="karyawan_id" value="{{ $data->karyawan_id }}" required readonly="">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2"><b>Cari Teknisi</b> <span class="fa fa-search"></span></button>
                    </span>
                  </div>
                  @if ($errors->has('karyawan_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('karyawan_id') }}</strong>
                  </span>
                  @endif

                </div>
              </div>
              <div class="col-md-12">
                <div class="row justify-content-between">
                  <div class="col-sm-3 mt-2">
                      <button type="submit" class="btn btn-primary btn-block" id="submit">
                          Perbaharui Data
                      </button>
                  </div>
                  <div class="col-sm-4 mt-2">
                      <a href="{{route('history.index')}}" class="btn btn-light pull-right">Kembali</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Cari Teknisi</h5>
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
            <tr class="pilih_karyawan" data-karyawan_id="<?php echo $data->id; ?>" data-teknisi_nama="<?php echo $data->nama; ?>">
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