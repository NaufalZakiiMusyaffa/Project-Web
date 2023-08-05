@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
        <div class="row flex-grow">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail <b>{{$data->kode_peminjaman}}</b></h4>
                        <div class="form-row">
                            <div class="form-group col-md-6{{ $errors->has('kode_peminjaman') ? ' has-error' : '' }}">
                                <label for="kode_peminjaman" class="col-md-6 control-label">Kode Peminjaman</label>
                                <div class="col-md-12">
                                    <input id="kode_peminjaman" type="text" class="form-control" name="kode_peminjaman" value="{{$data->kode_peminjaman}}" required readonly="">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nama_kendaraan" class="col-md-6 control-label">Nama Kendaraan</label>
                                <div class="col-md-12">
                                    <input id="nama_kendaraan" type="text" class="form-control" name="nama_kendaraan" value="{{$data->asetac->nama_kendaraan}}" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="peminjam" class="col-md-4 control-label">Peminjam</label>
                                <div class="col-md-12">
                                    <input id="peminjam" type="text" class="form-control" name="peminjam" value="{{$data->karyawan->nama}}" readonly="">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="supir" class="col-md-4 control-label">Supir</label>
                                <div class="col-md-12">
                                    <input id="supir" type="text" class="form-control" name="supir" value="{{$data->supir->nama_supir}}" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6{{ $errors->has('tgl_pinjam') ? ' has-error' : '' }}">
                                <label for="tgl_pinjam" class="col-md-4 control-label">Tanggal Pinjam</label>
                                <div class="col-md-12">
                                    <input id="tgl_pinjam" type="text" class="form-control" name="tgl_pinjam" value="{{ date('d F Y', strtotime($data->tgl_pinjam)) }}" readonly="">
                                </div>
                            </div>
                            <div class="form-group col-md-6{{ $errors->has('tgl_kembali') ? ' has-error' : '' }}">
                                <label for="tgl_kembali" class="col-md-4 control-label">Tanggal Kembali</label>
                                <div class="col-md-12">
                                    <input id="tgl_kembali" type="text" class="form-control" name="tgl_kembali" value="{{ $data->tgl_kembali ? date('d F Y', strtotime($data->tgl_kembali)) : '-' }}" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ket') ? ' has-error' : '' }}">
                            <label for="ket" class="col-md-4 control-label">Keterangan</label>
                            <div class="col-md-12">
                                <textarea id="ket" class="form-control" name="ket" readonly="">{{ $data->ket }}</textarea>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ket') ? ' has-error' : '' }}">
                            <label for="ket" class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                @if($data->status == 'pinjam')
                                <label class="badge badge-warning">Sedang Dipinjam</label>
                                @elseif($data->status == 'booking')
                                <label class="badge badge-dark">Sudah dibooking</label>
                                @else
                                <label class="badge badge-success">Sudah Kembali</label>
                                @endif
                            </div>
                        </div>
                        <a href="{{route('autocare-transaksi.index')}}" class="btn btn-light pull-right">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection