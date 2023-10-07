@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        $(".users").select2();
    });
</script>
<script type="text/javascript">
    function readURL() {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(input).prev().attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function() {
        $(".uploads").change(readURL)
        $("#f").submit(function() {
            // do ajax submit or just classic form submit
            //  alert("fake subminting")
            return false
        })
    });
</script>
@stop

@extends('layouts.app')

@section('content')
<form action="{{ route('karyawan.update', $data->id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('put') }}
    <div class="row">
        <div class="col d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ubah Data Karyawan<b>[{{$data->nama}}]</b> </h4>
                            <div class="form-row">
                                <div class="form-group col-md-6{{ $errors->has('nik') ? ' has-error' : '' }}">
                                    <label for="nik" class="col-md-4 control-label">NIK</label>
                                    <div class="col-md-12">
                                        <input id="nik" type="text" class="form-control" name="nik" value="{{ $data->nik }}" maxlength="16" required>
                                        @if ($errors->has('nik'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nik') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6{{ $errors->has('nama') ? ' has-error' : '' }}">
                                    <label for="nama" class="col-md-6 control-label">Nama</label>
                                    <div class="col-md-12">
                                        <input id="nama" type="text" class="form-control" name="nama" value="{{ $data->nama }}" required>
                                        @if ($errors->has('nama'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nama') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6{{ $errors->has('level') ? ' has-error' : '' }}">
                                    <label for="level" class="col-md-4 control-label">Jenis Kelamin</label>
                                    <div class="col-md-12">
                                        <select class="form-control" name="jk" required="">
                                            <option value=""></option>
                                            <option value="L" {{$data->jk === "L" ? "selected" : ""}}>Laki - Laki</option>
                                            <option value="P" {{$data->jk === "P" ? "selected" : ""}}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6{{ $errors->has('jabatan') ? ' has-error' : '' }}">
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

                            <div class="form-row">
                                <div class="form-group col-md-6{{ $errors->has('telepon') ? ' has-error' : '' }}">
                                    <label for="telepon" class="col-md-4 control-label">No Handphone</label>
                                    <div class="col-md-12">
                                        <input id="telepon" type="text" class="form-control" name="telepon" value="{{ $data->telepon }}" maxlength="16" required>
                                        @if ($errors->has('telepon'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('telepon') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="gambar" class="col-md-8 control-label">Foto Karyawan</label>
                                    <div class="col-md-6">
                                        <img width="200" height="200" src="{{ $data->gambar ? asset('images/user/'.$data->gambar) : asset('images/user/default.png') }}" />
                                        <input type="file" class="uploads form-control" style="margin-top: 20px;" name="gambar">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-2">
                                <div class="row justify-content-between">
                                    <div class="col-sm-4 mt-2">
                                        <button type="submit" class="btn btn-primary btn-block" id="submit">
                                            Perbaharui Data
                                        </button>
                                    </div>
                                    <div class="col-sm-4 mt-2">
                                        <a href="{{route('karyawan.index')}}" class="btn btn-light pull-right">Kembali</a>
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