@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        $(".users").select2();
    });
</script>
@stop

@extends('layouts.app')

@section('content')
{{-- <div class="container mt-5 mt-md-0">
    <a href="{{route('karyawan.index')}}" class="btn btn-outline-dark pull-left">Back</a>
</div> --}}
<div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
        <div class="row flex-grow">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail <b>{{$data->nama}}</b></h4>
                        <form class="forms-sample">
                        <div class="form-group">
                            <div class="col-md-6">
                                <img class="product" width="200" height="200" @if($data->gambar) src="{{ asset('images/user/'.$data->gambar) }}" @endif />
                            </div>
                        </div>

                            <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                                <label for="nama" class="col-md-4 control-label">Nama</label>
                                <div class="col">
                                    <input id="nama" type="text" class="form-control" name="nama" value="{{ $data->nama }}" readonly>
                                    @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nik') ? ' has-error' : '' }}">
                                <label for="nik" class="col-md-4 control-label">NIK</label>
                                <div class="col">
                                    <input id="nik" type="text" class="form-control" name="nik" value="{{ $data->nik }}" maxlength="16" readonly>
                                    @if ($errors->has('nik'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nik') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                                <label for="level" class="col-md-4 control-label">Jenis Kelamin</label>
                                <div class="col">
                                    <select class="form-control" name="jk" required="" disabled="">
                                        <option value=""></option>
                                        <option value="L" {{$data->jk === "L" ? "selected" : ""}}>Laki - Laki</option>
                                        <option value="P" {{$data->jk === "P" ? "selected" : ""}}>Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('jabatan') ? ' has-error' : '' }}">
                                <label for="jabatan" class="col-md-4 control-label">Jabatan</label>
                                <div class="col">
                                    <input id="jabatan" type="text" class="form-control" name="jabatan" value="{{ $data->jabatan }}" required readonly="">
                                    @if ($errors->has('jabatan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jabatan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('telepon') ? ' has-error' : '' }}">
                                <label for="telepon" class="col-md-4 control-label">No Handphone</label>
                                <div class="col">
                                    <input id="telepon" type="text" class="form-control" name="telepon" value="{{ $data->telepon }}" required readonly="">
                                    @if ($errors->has('telepon'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telepon') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="container">
                                <a href="{{route('karyawan.index')}}" class="btn btn-outline-dark pull-left">Back</a><br><br>
                            </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection