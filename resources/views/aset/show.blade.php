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
                        <h4 class="card-title">Detail Aset <b>[{{$data->nama_aset}}]</b> </h4>
                        <form class="forms-sample">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <img width="200" height="200" @if($data->cover) src="{{ asset('images/aset/'.$data->gambar) }}" @endif />
                                </div>
                            </div>

                            <div class="d-flex flex-row">
                            <p for="jumlah_aset" class="p-2">Status Aset :</p>
                            @if($data->jumlah_aset == '0')
                                <div class="p-2" style="margin-top: -3px;">
                                <label class="badge badge-primary">Sedang dipinjam</label>
                                </div>
                            @elseif($data->jumlah_aset == '1')
                                <div class="p-2" style="margin-top: -3px;">
                                <label class="badge badge-success">Siap digunakan</label>
                                </div>
                            @elseif($data->jumlah_aset == '2')
                                <div class="p-2" style="margin-top: -3px;">
                                <label class="badge badge-warning" >Digunakan</label>
                                </div>
                            @elseif($data->jumlah_aset == '3')
                                <div class="p-2" style="margin-top: -3px;">
                                <label class="badge badge-danger">Rusak(Bisa diperbaiki)</label>
                                </div>
                            @elseif($data->jumlah_aset == '4')
                                <div class="p-2" style="margin-top: -3px;">
                                <label class="badge badge-info">Sedang diperbaiki</label>
                                </div>
                            @else
                                <div class="p-2" style="margin-top: -3px;">
                                <label class="badge badge-danger">Rusak Total</label>
                                </div>
                            @endif
                                <p for="kode_aset" class="p-2">Inventaris Kepada :</p>
                                    <div class="p-2" style="margin-top: -3px;">
                                     <label class="badge badge-primary"><b>{{$data->karyawan->nama}}</b></label>
                                </div>
                                <p for="kode_aset" class="p-2">Kode Aset :</p>
                                    <div class="p-2" style="margin-top: -3px;">
                                     <label class="badge badge-danger"><b>{{ $data->kode_aset }}</b></label>
                                </div>
                            </div>

                            <div class="d-flex flex-row" style="margin-top: -20px;">
                            <p for="nama_aset" class="p-2">Nama Aset :</p>
                                <div class="p-2">
                                <p><b>{{ $data->nama_aset }}</b></p>
                                </div>
                            </div>

                            <div class="d-flex flex-row" style="margin-top: -20px;">
                            <p for="nama_aset" class="p-2">Merk&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</p>
                                <div class="p-2">
                                <p><b>{{ $data->merk }}</b></p>
                                </div>
                            </div>

                            <div class="d-flex flex-row" style="margin-top: -20px;">
                            <p for="nama_aset" class="p-2">Kategori&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</p>
                                <div class="p-2">
                                <p><b>{{ $data->kategori->nama_kategori }}</b></p>
                                </div>
                            </div>

                            <div class="d-flex flex-row" style="margin-top: -20px;">
                            <p for="nama_aset" class="p-2">Spesifikasi&nbsp;&nbsp;:</p>
                                <div class="col-md-10" style="margin-top: 7px; margin-left: -4px;">
                                <p><b>{{ $data->spesifikasi }}</b></p>
                                </div>
                            </div>

                            <div class="d-flex flex-row" style="margin-top: -20px;">
                            <p for="nama_aset" class="p-2">Harga Beli&nbsp; :</p>
                                <div class="p-2" style="margin-left: 2px;">
                                <p><b>@currency($data->harga_beli)</b></p>
                                </div>
                            </div>

                            <div class="d-flex flex-row" style="margin-top: -20px;">
                            <p for="nama_aset" class="p-2">Tgl Beli&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</p>
                                <div class="col-md-4" style="margin-top: 7px; margin-left: -2px;">
                                <p><b>{{ $data->tgl_beli }}</b></p>
                                </div>

                                <p for="nama_aset" class="p-2">Garansi :</p>
                                <div class="col-md-4" style="margin-top: 7px;">
                                <p><b>{{ $data->garansi }}</b></p>
                                </div>
                            </div>

                            <div class="d-flex flex-row" style="margin-top: -20px;">
                            <p for="nama_aset" class="p-2">Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</p>
                                <div class="col-md-4" style="margin-top: 7px;">
                                <p><b>{{ $data->toko_beli }}</b></p>
                                </div>

                                <p for="nama_aset" class="p-2">Alamat :</p>
                                <div class="col-md-4" style="margin-top: 7px;">
                                <p><b>{{ $data->alamat }}</b></p>
                                </div>
                            </div>

                             <div class="d-flex flex-row" style="margin-top: -20px;">
                                <a href="{{route('aset.index')}}" class="btn btn-light pull-left">Kembali</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection