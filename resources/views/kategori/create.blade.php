@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        $(".users").select2();
    });
</script>
@stop

@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('kategori.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{-- <div class="row">
        <div class="col d-flex align-items-stretch grid-margin"> --}}
            <div class="row flex-grow">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tambah Data Kategori</h4>
                            <div class="form-group{{ $errors->has('nama_kategori') ? ' has-error' : '' }}">
                                <label for="nama_kategori" class="col-md-12 control-label">Nama Kategori</label>
                                <div class="col-md-12">
                                    <input id="nama_kategori" type="text" class="form-control" name="nama_kategori" value="{{ old('nama_kategori') }}" required>
                                    @if ($errors->has('nama_kategori'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_kategori') }}</strong>
                                    </span>
                                    @endif
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
                                        <a href="{{route('kategori.index')}}" class="btn btn-light pull-right mt-1">Kembali</a>
                                    </div>
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