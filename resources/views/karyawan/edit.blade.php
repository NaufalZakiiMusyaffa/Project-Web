@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        $(".users").select2();
    });
</script>
@stop

@extends('layouts.app')

@section('content')
<form action="{{ route('karyawan.update', $data->id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('put') }}
    <div class="row">
        <div class="col-md-8 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ubah Data Karyawan<b>[{{$data->nama}}]</b> </h4>

                            <div class="float-right">
                                <div class="form-group{{ $errors->has('nik') ? ' has-error' : '' }}">
                                    <label for="nik" class="col-md-4 control-label">NIK</label>
                                    <div class="col-md-12">
                                        <input id="nik" type="text" class="form-control" name="nik" value="{{ $data->nik }}" maxlength="8" required>
                                        @if ($errors->has('nik'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nik') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                                <label for="nama" class="col-md-6 control-label">Nama</label>
                                <div class="col-md-7">
                                    <input id="nama" type="text" class="form-control" name="nama" value="{{ $data->nama }}" required>
                                    @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="float-right">
                                <div class="form-group{{ $errors->has('jabatan') ? ' has-error' : '' }}">
                                    <label for="jabatan" class="col-md-8 control-label">Jabatan</label>
                                    <div class="col-md-12">
                                        <input id="jabatan" type="text" class="form-control" name="jabatan" value="{{ $data->jabatan }}" required>
                                        @if ($errors->has('jabatan'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('jabatan') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                                <label for="level" class="col-md-4 control-label">Jenis Kelamin</label>
                                <div class="col-md-7">
                                    <select class="form-control" name="jk" required="">
                                        <option value=""></option>
                                        <option value="L" {{$data->jk === "L" ? "selected" : ""}}>Laki - Laki</option>
                                        <option value="P" {{$data->jk === "P" ? "selected" : ""}}>Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }} " style="margin-bottom: 20px;">
                                <label for="user_id" class="col-md-12 control-label">Yang Menginputkan Data</label>
                                <div class="col-md-12">
                                    <input id="aset_nama" type="text" class="form-control" value="{{ Auth::user()->name }}" readonly="">
                                    <input id="user_id" type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}" required readonly="">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" id="submit">
                                    Perbaharui Data
                                </button>
                                <button type="reset" class="btn btn-danger">
                                    Hapus Data Inputan
                                </button>
                                <a href="{{route('karyawan.index')}}" class="btn btn-light pull-right">Kembali</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection