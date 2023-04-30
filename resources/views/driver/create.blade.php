@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        $(".users").select2();
    });
</script>
@stop

@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('driver.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tambah Data Supir</h4>

                            <div class="form-row">
                                <div class="form-group col-md-6{{ $errors->has('kode_supir') ? ' has-error' : '' }}">
                                    <label for="kode_supir" class="col-md-6 control-label">Kode Supir</label>
                                    <div class="col-md-12">
                                        <input id="kode_supir" type="text" class="form-control" name="kode_supir" value="{{ $kode }}" required readonly="">
                                        @if ($errors->has('kode_supir'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('kode_supir') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6{{ $errors->has('status_supir') ? ' has-error' : '' }}">
                                    <label for="status_supir" class="col-md-6 control-label">Status</label>
                                    <div class="col-md-12">
                                        <select class="form-control" name="status_supir" readonly="">
                                            <option value="{{ $siap }}">Siap</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6{{ $errors->has('nama_supir') ? ' has-error' : '' }}">
                                    <label for="nama_supir" class="col-md-12 control-label">Nama</label>
                                    <div class="col-md-12">
                                        <input id="nama_supir" type="text" class="form-control" name="nama_supir" value="{{ old('nama_supir') }}" required>
                                        @if ($errors->has('nama_supir'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nama_supir') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6{{ $errors->has('kontak') ? ' has-error' : '' }}">
                                    <label for="kontak" class="col-md-12 control-label">Telp/Whatsapp</label>
                                    <div class="col-md-12">
                                        <input id="kontak" type="number" class="form-control" name="kontak" value="{{ old('kontak') }}" maxlength="13" required>
                                        @if ($errors->has('kontak'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('kontak') }}</strong>
                                        </span>
                                        @endif
                                    </div>
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
                                        <a href="{{route('driver.index')}}" class="btn btn-light pull-right mt-1">Kembali</a>
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