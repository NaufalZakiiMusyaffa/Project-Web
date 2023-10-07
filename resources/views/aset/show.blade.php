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
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
        <div class="row flex-grow">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail Aset <b>[{{$data->nama_aset}}]</b> </h4>
                        <form class="forms-sample">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <img width="300" height="200" src="{{ $data->gambar ? asset('images/aset/'.$data->gambar) : asset('images/aset/default.png') }}" />
                                </div>

                                
                            </div>

                            <div class="form-row">
                                <div class="d-flex flex-row col-md-4">
                                    <p for="status_aset" class="col-md-4 p-2">Status Aset</p>
                                    @if($data->status_aset == 'Sedang dipinjam')
                                        <div class="col-md-8 p-2" style="margin-top: -3px;">
                                            <label class="badge badge-primary">Sedang dipinjam</label>
                                        </div>
                                    @elseif($data->status_aset == 'Siap digunakan')
                                        <div class="col-md-8 p-2" style="margin-top: -3px;">
                                            <label class="badge badge-success">Siap digunakan</label>
                                        </div>
                                    @elseif($data->status_aset == 'Diinventariskan')
                                        <div class="col-md-8 p-2" style="margin-top: -3px;">
                                            <label class="badge badge-warning" >Diinventariskan</label>
                                        </div>
                                    @elseif($data->status_aset == 'Rusak(Bisa diperbaiki)')
                                        <div class="col-md-8 p-2" style="margin-top: -3px;">
                                            <label class="badge badge-danger">Rusak(Bisa diperbaiki)</label>
                                        </div>
                                    @elseif($data->status_aset == 'Sedang diperbaiki')
                                        <div class="col-md-8 p-2" style="margin-top: -3px;">
                                            <label class="badge badge-info">Sedang diperbaiki</label>
                                        </div>
                                    @else
                                        <div class="col-md-8 p-2" style="margin-top: -3px;">
                                        <label class="badge badge-danger">Rusak Total</label>
                                        </div>
                                    @endif
                                </div>
                                <div class="d-flex flex-row col-md-4">
                                    <p for="kode_aset" class="col-md-6 p-2">Inventaris Kepada</p>
                                    <div class="col-md-6 p-2" style="margin-top: -3px;">
                                        @if($data->karyawan != null)
                                        <label class="badge badge-primary"><b>{{$data->karyawan->nama}}</b></label>
                                        @else
                                        <label class="badge badge-primary"><b>-</b></label>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex flex-row col-md-4">
                                    <p for="kode_aset" class="col-md-4 p-2">Kode Aset</p>
                                    <div class="col-md-8 p-2" style="margin-top: -3px;">
                                         <label class="badge badge-danger"><b>{{ $data->kode_aset }}</b></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="d-flex flex-row col-md-4" style="margin-top: -20px;">
                                <p for="nama_aset" class="col-md-4 p-2">Nama Aset</p>
                                    <div class="col-md-8 p-2">
                                    <p><b>{{ $data->nama_aset }}</b></p>
                                    </div>
                                </div>
    
                                <div class="d-flex flex-row col-md-4" style="margin-top: -20px;">
                                <p for="nama_aset" class="col-md-6 p-2">Merk</p>
                                    <div class="col-md-6 p-2">
                                    <p><b>{{ $data->merk }}</b></p>
                                    </div>
                                </div>
    
                                <div class="d-flex flex-row col-md-4" style="margin-top: -20px;">
                                <p for="nama_aset" class="col-md-4 p-2">Kategori</p>
                                    <div class="col-md-8 p-2">
                                    <p><b>{{ $data->kategori->nama_kategori }}</b></p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="d-flex flex-row col-md-4" style="margin-top: -20px;">
                                    <p for="nama_aset" class="col-md-4 p-2">Harga Beli</p>
                                        <div class="col-md-8 p-2">
                                        <p><b>@currency($data->harga_beli)</b></p>
                                        </div>
                                </div>

                                <div class="d-flex flex-row col-md-8" style="margin-top: -20px;">
                                <p for="nama_aset" class="col-md-3 p-2">Spesifikasi</p>
                                    <div class="col-md-6 p-2">
                                    <p><b>{{ $data->spesifikasi }}</b></p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="d-flex flex-row col-md-4" style="margin-top: -20px;">
                                <p for="nama_aset" class="col-md-4 p-2">Tgl Beli</p>
                                    <div class="col-md-8 p-2">
                                    <p><b>{{date('d F Y', strtotime($data->tgl_beli))}}</b></p>
                                    </div>
                                </div>
                                <div class="d-flex flex-row col-md-8" style="margin-top: -20px;">
                                    <p for="nama_aset" class="col-md-3 p-2">Garansi</p>
                                    <div class="col-md-6 p-2">
                                    <p><b>{{date('d F Y', strtotime($data->garansi))}}</b></p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="d-flex flex-row col-md-4" style="margin-top: -20px;">
                                    <p for="nama_aset" class="col-md-4 p-2">Vendor</p>
                                        <div class="col-md-8 p-2">
                                        <p><b>{{ $data->toko_beli }}</b></p>
                                        </div>
                                </div>
                                <div class="d-flex flex-row col-md-8" style="margin-top: -20px;">
                                        <p for="nama_aset" class="col-md-3 p-2">Alamat</p>
                                        <div class="col-md-9 p-2">
                                        <p><b>{{ $data->alamat }}</b></p>
                                        </div>
                                </div>
                            </div>

                             <div class="d-flex flex-row mt-2">
                                <a href="{{route('asetit.index')}}" class="btn btn-light pull-left">Kembali</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection