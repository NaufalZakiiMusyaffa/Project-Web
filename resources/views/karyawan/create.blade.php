@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        $(".users").select2();
    });
</script>
@stop

@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('karyawan.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tambah Data Karyawan</h4>

                            <div class="form-group{{ $errors->has('nik') ? ' has-error' : '' }}">
                                <label for="nik" class="col-md-4 control-label">NIK</label>
                                <div class="col-md-12">
                                    <input id="nik" type="text" class="form-control" name="nik" value="{{ old('nik') }}" maxlength="8" required>
                                    @if ($errors->has('nik'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nik') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                                <label for="nama" class="col-md-6 control-label">Nama</label>
                                <div class="col-md-12">
                                    <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>
                                    @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row">    
                                <div class="form-group col-md-6{{ $errors->has('level') ? ' has-error' : '' }}">
                                    <label for="level" class="col-md-8 control-label">Jenis Kelamin</label>
                                    <div class="col-md-12">
                                        <select class="form-control" name="jk" required="">
                                            <option value=""></option>
                                            <option value="L">Laki - Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6{{ $errors->has('jabatan') ? ' has-error' : '' }}">
                                    <label for="jabatan" class="col-md-8 control-label">Jabatan</label>
                                    <div class="col-md-12">
                                        <input id="jabatan" type="text" class="form-control" name="jabatan" value="{{ old('jabatan') }}" required>
                                        @if ($errors->has('jabatan'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('jabatan') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }} " style="margin-bottom: 20px;">
                                <label for="user_id" class="col-md-12 control-label">Yang Menginputkan Data</label>
                                <div class="col-md-12">
                                    <input id="aset_nama" type="text" class="form-control" value="{{ Auth::user()->name }}" readonly="">
                                    <input id="user_id" type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}" required readonly="">
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
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
                                        <a href="{{route('karyawan.index')}}" class="btn btn-light pull-right mt-1">Kembali</a>
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
@endsection