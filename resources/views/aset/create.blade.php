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

    $(document).on('click', '.pilih_karyawan', function(e) {
        document.getElementById("karyawan_id").value = $(this).attr('data-karyawan_id');
        document.getElementById("karyawan_nama").value = $(this).attr('data-karyawan_nama');
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

@section('css')

@stop
@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('aset.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tambah Data Aset</h4>

                                <div class="form-row">
                                <div class="form-group col-md-3{{ $errors->has('kode_aset') ? ' has-error' : '' }}">
                                    <label for="kode_aset" class="col-md-12 control-label">Kode Aset</label>
                                    <div class="col-md-12">
                                        <input id="kode_aset" type="text" class="form-control" name="kode_aset" value="{{ $kode }}" required readonly="">
                                        @if ($errors->has('kode_aset'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('kode_aset') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-3{{ $errors->has('jumlah_aset') ? ' has-error' : '' }}">
                                    <label for="jumlah_aset" class="col-md-12 control-label">Status Aset *</label>
                                    <div class="col-md-12">
                                        <select class="form-control" name="jumlah_aset" required="">
                                            <option value="{{ $siappakai }}">Siap digunakan</option>
                                            <option value="{{ $dipakai }}">Digunakan</option>
                                            <option value="{{ $bisadiperbaiki }}">Rusak(Bisa diperbaiki)</option>
                                            <option value="{{ $rusak }}">Rusak Total</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-6{{ $errors->has('karyawan_id') ? ' has-error' : '' }}">
                                    <label for="karyawan_id" class="col-md-12 control-label">Pilih karyawan bila status aset <b>[Digunakan]</b></label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input id="karyawan_nama" type="text" class="form-control" readonly="" required>
                                            <input id="karyawan_id" type="hidden" name="karyawan_id" value="{{ 0 }}" required readonly="">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2"><b>Cari Karyawan</b> <span class="fa fa-search"></span></button>
                                            </span>
                                        </div>
                                        @if ($errors->has('karyawan_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('karyawan_id') }}</strong>
                                        </span>
                                        @endif

                                    </div>
                                </div>
                                </div>

                                <div class="form-row">
                                <div class="form-group col-md-6{{ $errors->has('nama_aset') ? ' has-error' : '' }}">
                                    <label for="nama_aset" class="col-md-12 control-label">Nama Aset *</label>
                                    <div class="col-md-12">
                                        <input id="nama_aset" type="text" class="form-control" name="nama_aset" value="{{ old('nama_aset') }}" required>
                                        @if ($errors->has('nama_aset'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nama_aset') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-3{{ $errors->has('merk') ? ' has-error' : '' }}">
                                    <label for="merk" class="col-md-12 control-label">Merk *</label>
                                    <div class="col-md-12">
                                        <input id="merk" type="text" class="form-control" name="merk" value="{{ old('merk') }}" required>
                                        @if ($errors->has('merk'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('merk') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-3{{ $errors->has('kategori_id') ? ' has-error' : '' }}">
                                    <label for="kategori_id" class="col-md-12 control-label">Kategori *</label>
                                    <div class="col-md-12">
                                        <select class="form-control" name="kategori_id" required="">
                                        @foreach($kategoris as $data)
                                        <option value="{{ $data->id }}">{{$data->nama_kategori}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                </div>

                                <div class="form-row">
                                <div class="form-group col-md-6{{ $errors->has('spesifikasi') ? ' has-error' : '' }}">
                                    <label for="spesifikasi" class="col-md-12 control-label">Spesifikasi *</label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" rows="5" id="spesifikasi" name="spesifikasi" required>{{ old('spesifikasi') }}</textarea>
                                        @if ($errors->has('spesifikasi'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('spesifikasi') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-2{{ $errors->has('harga_beli') ? ' has-error' : '' }}">
                                    <label for="harga_beli" class="col-md-12 control-label">Harga Beli</label>
                                    <div class="col-md-12">
                                        <input id="harga_beli" type="number" maxlength="11" class="form-control" name="harga_beli" value="{{ old('harga_beli') }}">
                                        @if ($errors->has('harga_beli'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('harga_beli') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-2{{ $errors->has('tgl_beli') ? ' has-error' : '' }}">
                                    <label for="tgl_beli" class="col-md-12 control-label">Tanggal Beli</label>
                                    <div class="col-md-12">
                                        <input id="tgl_beli" type="date" class="form-control" name="tgl_beli" value="{{ old('tgl_beli') }}">
                                        @if ($errors->has('tgl_beli'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tgl_beli') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-2{{ $errors->has('garansi') ? ' has-error' : '' }}">
                                    <label for="garansi" class="col-md-12 control-label">Garansi</label>
                                    <div class="col-md-12">
                                        <input id="garansi" type="date" class="form-control" name="garansi" value="{{ old('garansi') }}">
                                        @if ($errors->has('garansi'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('garansi') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                </div>

                                <div class="form-row">
                                <div class="form-group col-md-6{{ $errors->has('toko_beli') ? ' has-error' : '' }}">
                                    <label for="toko_beli" class="col-md-8 control-label">Vendor</label>
                                    <div class="col-md-12">
                                        <input id="toko_beli" type="text" class="form-control" name="toko_beli" value="{{ old('toko_beli') }}">
                                        @if ($errors->has('toko_beli'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('toko_beli') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-6{{ $errors->has('alamat') ? ' has-error' : '' }}">
                                    <label for="alamat" class="col-md-8 control-label">Alamat Vendor</label>
                                    <div class="col-md-12">
                                        <input id="alamat" type="text" class="form-control" name="alamat" value="{{ old('alamat') }}">
                                        @if ($errors->has('alamat'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('alamat') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-md-8 control-label">Gambar Aset</label>
                                    <div class="col-md-6">
                                        <img width="200" height="200" />
                                            <input type="file" class="uploads form-control" style="margin-top: 20px;" name="gambar">
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" id="submit">
                                        Kirim
                                    </button>
                                    <button type="reset" class="btn btn-danger">
                                        Hapus Data Inputan
                                    </button>
                                    <a href="{{route('aset.index')}}" class="btn btn-light pull-right">Kembali</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Cari Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                        <tr class="pilih_karyawan" data-karyawan_id="<?php echo $data->id; ?>" data-karyawan_nama="<?php echo $data->nama; ?>">
                            <td class="py-1">
                                @if($data->user->gambar)
                                <img src="{{url('images/user', $data->user->gambar)}}" alt="image" style="margin-right: 10px;" />
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