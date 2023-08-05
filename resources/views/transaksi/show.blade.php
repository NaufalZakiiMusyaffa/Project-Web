@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
        <div class="row flex-grow">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail <b>{{$data->kode_transaksi}}</b></h4>
                        <div class="form-group">
                            <div class="col-md-12">
                                <img width="200" height="200" @if($data->aset->gambar) src="{{ asset('images/aset/'.$data->aset->gambar) }}" @endif />
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('kode_transaksi') ? ' has-error' : '' }}">
                            <label for="kode_transaksi" class="col-md-4 control-label">Kode Transaksi</label>
                            <div class="col-md-12">
                                <input id="kode_transaksi" type="text" class="form-control" name="kode_transaksi" value="{{$data->kode_transaksi}}" required readonly="">
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

                        <div class="form-group">
                            <label for="karyawan_id" class="col-md-4 control-label">Aset</label>
                            <div class="col-md-12">
                                <input id="aset" type="text" class="form-control" readonly="" value="{{$data->aset->nama_aset}}">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="karyawan_id" class="col-md-4 control-label">Karyawan</label>
                            <div class="col-md-12">
                                <input id="karyawan_nama" type="text" class="form-control" readonly="" value="{{$data->karyawan->nama}}">

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
                            <div class="col-md-12">
                                @if($data->status == 'pinjam')
                                <label class="badge badge-warning">Pinjam</label>
                                @else
                                <label class="badge badge-success">Kembali</label>
                                @endif
                            </div>
                        </div>

                        <a href="{{route('transaksi.index')}}" class="btn btn-light pull-right">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection