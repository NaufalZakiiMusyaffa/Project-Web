@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        $(".users").select2();
    });
</script>
@stop

@extends('layouts.app')

@section('content')
<form action="{{ route('driver.update', $data->id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('put') }}
    <div class="row">
        <div class="col d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ubah Data Supir<b>[{{$data->nama_supir}}]</b> </h4>

                            <div class="form-group{{ $errors->has('kode_supir') ? ' has-error' : '' }}">
                                <label for="kode_supir" class="col-md-12 control-label">Kode Supir</label>
                                <div class="col-md-12">
                                    <input id="kode_supir" type="text" class="form-control" name="kode_supir" value="{{ $data->kode_supir }}" required readonly="">
                                    @if ($errors->has('kode_supir'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kode_supir') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nama_supir') ? ' has-error' : '' }}">
                                <label for="nama_supir" class="col-md-12 control-label">Nama</label>
                                <div class="col-md-12">
                                    <input id="nama_supir" type="text" class="form-control" name="nama_supir" value="{{ $data->nama_supir }}">
                                    @if ($errors->has('nama_supir'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_supir') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('kontak') ? ' has-error' : '' }}">
                                <label for="kontak" class="col-md-12 control-label">Telp/Whatsapp</label>
                                <div class="col-md-12">
                                    <input id="kontak" type="text" class="form-control" name="kontak" value="{{ $data->kontak }}" maxlength="13" onkeypress='return harusAngka(event)' required>
                                    @if ($errors->has('kontak'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kontak') }}</strong>
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
                                        <a href="{{route('driver.index')}}" class="btn btn-light pull-right">Kembali</a>
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

<script>
    function harusAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if ((charCode < 48 || charCode > 57) && charCode > 32)
            return false;
        return true;
    }
</script>
@endsection