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
    })
</script>
@stop

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-10 d-flex align-items-stretch grid-margin">
        <div class="row flex-grow">
            <div class="col-10">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail <b>{{$data->nama_aset}}</b> </h4>
                        <form class="forms-sample">

                            <div class="form-group">
                                <div class="col-md-6">
                                    <img width="200" height="200" @if($data->cover) src="{{ asset('images/aset/'.$data->gambar) }}" @endif />
                                </div>
                            </div>
                            <div class="float-right">
                                <div class="form-group{{ $errors->has('jumlah_aset') ? ' has-error' : '' }}">
                                    <label for="jumlah_aset" class="col-md-6 control-label">Aset</label>
                                    <div class="col-md-12">
                                        <input id="jumlah_aset" type="number" maxlength="4" class="form-control" name="jumlah_aset" value="{{ $data->jumlah_aset }}" readonly="">
                                        @if ($errors->has('jumlah_aset'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('jumlah_aset') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('kode_aset') ? ' has-error' : '' }}">
                                <label for="kode_aset" class="col-md-4 control-label">Kode Aset</label>
                                <div class="col-md-8">
                                    <input id="kode_aset" type="text" class="form-control" name="kode_aset" value="{{ $data->kode_aset }}" readonly="">
                                    @if ($errors->has('kode_aset'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kode_aset') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('nama_aset') ? ' has-error' : '' }}">
                                <label for="nama_aset" class="col-md-4 control-label">Nama Aset</label>
                                <div class="col-md-12">
                                    <input id="nama_aset" type="text" class="form-control" name="nama_aset" value="{{ $data->nama_aset }}" readonly="">
                                    @if ($errors->has('nama_aset'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_aset') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="float-right">
                                <div class="form-group{{ $errors->has('merk') ? ' has-error' : '' }}">
                                    <label for="merk" class="col-md-4 control-label">Merk</label>
                                    <div class="col-md-12">
                                        <input id="merk" type="text" class="form-control" name="merk" value="{{ $data->merk }}" readonly="">
                                        @if ($errors->has('merk'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('merk') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('kategori_id') ? ' has-error' : '' }}">
                                <label for="kategori_id" class="col-md-4 control-label">Kategori</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="kategori_id" required readonly="">
                                        <option value="{{ $data->kategori_id }}">{{ $data->kategori->nama_kategori }}</option>
                                    </select>
                                    @if ($errors->has('kategori_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kategori_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('spesifikasi') ? ' has-error' : '' }}">
                                <label for="spesifikasi" class="col-md-4 control-label">Spesifikasi</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" rows="5" id="spesifikasi" name="spesifikasi" readonly="">{{ $data->spesifikasi }}</textarea>
                                    @if ($errors->has('spesifikasi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('spesifikasi') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="float-right">
                                <div class="form-group{{ $errors->has('harga_beli') ? ' has-error' : '' }}">
                                    <label for="harga_beli" class="col-md-12 control-label">Harga Beli</label>
                                    <div class="col-md-12">
                                        <input id="harga_beli" type="number" maxlength="11" class="form-control" name="harga_beli" value="{{ $data->harga_beli }}" readonly="">
                                        @if ($errors->has('harga_beli'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('harga_beli') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="float-right">
                                <div class="form-group{{ $errors->has('garansi') ? ' has-error' : '' }}">
                                    <label for="garansi" class="col-md-12 control-label">Garansi</label>
                                    <div class="col-md-12">
                                        <input id="garansi" type="date" class="form-control" name="garansi" value="{{ $data->garansi }}" readonly="">
                                        @if ($errors->has('garansi'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('garansi') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="float-right">
                                <br>
                                <p style="margin-top: 7px; margin-right: -3px;">s/d</p>
                            </div>
                            <div class="form-group{{ $errors->has('tgl_beli') ? ' has-error' : '' }}">
                                <label for="tgl_beli" class="col-md-4 control-label">Tanggal Beli</label>
                                <div class="col-md-5">
                                    <input id="tgl_beli" type="date" class="form-control" name="tgl_beli" value="{{ $data->tgl_beli }}" readonly="">
                                    @if ($errors->has('tgl_beli'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tgl_beli') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('toko_beli') ? ' has-error' : '' }}">
                                <label for="toko_beli" class="col-md-4 control-label">Toko Beli</label>
                                <div class="col-md-12">
                                    <input id="toko_beli" type="text" class="form-control" name="toko_beli" value="{{ $data->toko_beli }}" readonly="">
                                    @if ($errors->has('toko_beli'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('toko_beli') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a href="{{route('aset.index')}}" class="btn btn-light pull-left">Back</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection