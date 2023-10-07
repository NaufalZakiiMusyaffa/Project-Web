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
                                <img class="product" width="170" height="170" src="{{ $data->gambar ? asset('images/user/'.$data->gambar) : asset('images/user/default.png') }}" />
                            </div>
                        </div>

                        <div class="d-flex flex-row">
                            <p for="name" class="p-2">Nama Karyawan &nbsp;:</p>
                                <div class="p-2">
                                <label class="badge badge-primary">{{ $data->nama }}</label>
                                </div>
                        </div>

                        <div class="d-flex flex-row" style="margin-top: -20px;">
                            <p for="email" class="p-2">NIK &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</p>
                                <div class="p-2">
                                <label class="badge badge-danger">{{ $data->nik }}</label>
                                </div>
                        </div>

                        <div class="d-flex flex-row" style="margin-top: -20px;">
                            <p for="jk" class="p-2">Jenis Kelamin &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</p>
                                <div class="p-2">
                                <p><b>@if ($data->jk == 'L')
                                            Laki-Laki
                                            @else
                                            Perempuan
                                            @endif</b></p>
                                </div>
                        </div>

                        <div class="d-flex flex-row" style="margin-top: -20px; margin-left: -1px;">
                            <p for="level" class="p-2">Jabatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</p>
                                <div class="p-2" style="margin-top: 0px;">
                                <p><b>{{ $data->jabatan }}</b></p>
                                </div>
                        </div>

                        <div class="d-flex flex-row" style="margin-top: -20px;">
                            <p for="email" class="p-2">No. Handphone &nbsp;&nbsp; :</p>
                                <div class="p-2">
                                <p><b>{{ $data->telepon }}</b></p>
                                </div>
                        </div>

                        <a href="{{route('karyawan.index')}}" class="btn btn-light pull-left">Kembali</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection