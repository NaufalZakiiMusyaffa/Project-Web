@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        $(".users").select2();
    });
    $('#status-terima').click(function() {
        $('#status').val('2')
    })
    $('#status-tolak').click(function() {
        const result = confirm('Anda yakin ingin menolak pengajuan ini?')
        if (result == true) {
            $('#status').val('0') 
            document.getElementById("status-tolak").type = "submit"
        }else{

        }
    })
</script>
@stop
@extends('layouts.app')

@section('content')

<form action="{{ route('pemeliharaan.update', $data->id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('put') }}

    <div class="row">
        <div class="col d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Detail Pengajuan</h4>

                            <div class="form-group">
                                <div class="col-md-12">
                                     <img width="170" height="170" src="{{ $data->gambar ? asset('images/pemeliharaan/'.$data->gambar) : asset('images/pemeliharaan/not-found.png') }}" />
                                </div>
                            </div>

                            <div class="d-flex flex-row">
                                <p for="kode_pemeliharaan" class="p-2">Kode Pengajuan :</p>
                                    <div class="p-2" style="margin-top: -3px;">
                                     <label class="badge badge-primary">{{ $data->kode_pemeliharaan }}</label>
                                    </div>
                            </div>

                            <div class="d-flex flex-row">
                                <p for="kode_aset" class="p-2">Kode Aset &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</p>
                                    <div class="p-2">
                                    <p><b>{{ $data->aset->kode_aset }}</b></p>
                                    </div>
                            </div>

                            <div class="d-flex flex-row">
                                <p for="nama_aset" class="p-2">Nama Aset &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</p>
                                    <div class="p-2">
                                    <p><b>{{ $data->aset->nama_aset }}</b></p>
                                    </div>
                            </div>

                            <div class="d-flex flex-row">
                                <p for="keterangan" class="p-2">Keterangan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</p>
                                    <div class="col-md-6" style="margin-top: 7px; margin-left: -4px;">
                                    <p><b>{{ $data->keterangan }}</b></p>
                                    </div>
                            </div>

                            <div class="d-flex flex-row">
                                <p for="biaya" class="p-2">Biaya &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</p>
                                    <div class="p-2" style="margin-top: -3px;">
                                    <label class="badge badge-danger">@currency($data->biaya)</label>
                                    </div>
                            </div>

                                {{-- <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                    <label for="status" class="col-md-12 control-label" style="margin-left: -4px;">Keputusan *</label>
                                    <div class="col-md-12">
                                        <select class="form-control" name="status" style="margin-left: -4px;" required>
                                            <option value="2" @if($data->status == '2') selected @endif>Terima Pengajuan</option>
                                            <option value="0" @if($data->status == '0') selected @endif>Tolak Pengajuan</option>

                                        </select>
                                    </div>
                                </div> --}}
                                <input type="hidden" name="status" id="status">

                                <div class="col-md-12">
                                    <div class="row justify-content-between">
                                        <div class="col-sm-6 mt-2">
                                            <div class="row">
                                                @if ($data->status == 1)
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-success btn-block" id="status-terima">
                                                            Terima Pengajuan
                                                        </button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="button" class="btn btn-danger btn-block" id="status-tolak">
                                                            Tolak Pengajuan
                                                        </button>
                                                    </div>
                                                @elseif($data->status == 2)
                                                    <div class="col-md-4">
                                                        <a class="btn btn-success fa fa-print" href="{{ route('pemeliharaan.pdf', $data->id) }}">&nbsp;&nbsp;Cetak</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mt-2">
                                            <a href="{{route('pemeliharaan.index')}}" class="btn btn-light pull-right">Kembali</a>
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