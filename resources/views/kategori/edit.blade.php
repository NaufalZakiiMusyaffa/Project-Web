@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        $(".users").select2();
    });
</script>
@stop

@extends('layouts.app')

@section('content')
<form action="{{ route('kategori.update', $data->id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('put') }}
    {{-- <div class="row">
        <div class="col-md-8 d-flex align-items-stretch grid-margin"> --}}
            <div class="row flex-grow">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ubah Data Kategori <b>[{{$data->nama_kategori}}]</b> </h4>
                            <div class="form-group{{ $errors->has('nama_kategori') ? ' has-error' : '' }}">
                                <label for="nama_kategori" class="col-md-12 control-label">Nama Kategori</label>
                                <div class="col-md-12">
                                    <input id="nama_kategori" type="text" class="form-control" name="nama_kategori" value="{{ $data->nama_kategori }}" required>
                                    @if ($errors->has('nama_kategori'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_kategori') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-sm-4 mt-2">
                                    <button type="submit" class="btn btn-primary btn-block" id="submit">
                                        Perbaharui Data
                                    </button>
                                </div>
                                <div class="col-sm-4 mt-2">
                                    <a href="{{route('kategori.index')}}" class="btn btn-light pull-right">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- </div>
    </div> --}}
</form>
@endsection