@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable({
            "iDisplayLength": 50
        });
    });

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

    $(document).on('click', '.pilih', function(e) {
        document.getElementById("aset_nama").value = $(this).attr('data-aset_nama');
        document.getElementById("aset_id").value = $(this).attr('data-aset_id');
        $('#myModal').modal('hide');
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

<form method="POST" action="{{ route('pemeliharaan.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Pemeliharaan Aset IT</h4>

                            <div class="form-row">
                                <div class="form-group col-md-4{{ $errors->has('kode_pemeliharaan') ? ' has-error' : '' }}">
                                    <label for="kode_pemeliharaan" class="col-md-12 control-label">Kode Pemeliharaan</label>
                                    <div class="col-md-12">
                                        <input id="kode_pemeliharaan" type="text" class="form-control" name="kode_pemeliharaan" value="{{ $kode }}" required readonly="">
                                        @if ($errors->has('kode_pemeliharaan'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('kode_pemeliharaan') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-4{{ $errors->has('status') ? ' has-error' : '' }}">
                                    <label for="status" class="col-md-12 control-label">Status</label>
                                    <div class="col-md-12">
                                        <select class="form-control" name="status" required readonly="">
                                            <option value="{{ $statusx }}">Menunggu Keputusan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-4{{ $errors->has('yang_mengajukan') ? ' has-error' : '' }} " style="margin-bottom: 20px;">
                                <label for="yang_mengajukan" class="col-md-12 control-label">Yang Mengajukan</label>
                                <div class="col-md-12">
                                    <input id="yang_mengajukan" type="text" name="yang_mengajukan" class="form-control" value="{{ Auth::user()->name }}" readonly="">
                                </div>
                                </div>
                            </div>

                            <div class="form-row">
                            <div class="form-group col-md-8{{ $errors->has('aset_id') ? ' has-error' : '' }}">
                                <label for="aset_id" class="col-md-6 control-label">Aset</label>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input id="aset_nama" type="text" class="form-control" readonly="" required>
                                        <input id="aset_id" type="hidden" name="aset_id" value="{{ old('aset_id') }}" required readonly="">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><b>Cari Aset</b> <span class="fa fa-search"></span></button>
                                        </span>
                                    </div>
                                    @if ($errors->has('aset_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('aset_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-4{{ $errors->has('biaya') ? ' has-error' : '' }}">
                                <label for="biaya" class="col-md-12 control-label">Biaya *</label>
                                <div class="col-md-12">
                                    <input id="biaya" type="number" maxlength="11" class="form-control" name="biaya" value="{{ old('biaya') }}">
                                    @if ($errors->has('biaya'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('biaya') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            </div>

                            <div class="form-row">
                            <div class="form-group col-md-8{{ $errors->has('keterangan') ? ' has-error' : '' }}">
                                <label for="keterangan" class="col-md-4 control-label">keterangan *</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" rows="5" id="keterangan" name="keterangan" required>{{ old('keterangan') }}</textarea>
                                    @if ($errors->has('keterangan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('keterangan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="email" class="col-md-12 control-label">Gambar</label>
                                <div class="col-md-12">
                                    <img width="200" height="200" />
                                    <input type="file" class="uploads form-control" style="margin-top: 20px;" name="gambar">
                                </div>
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
                                        <a href="{{route('pemeliharaan.index')}}" class="btn btn-light pull-right mt-1">Kembali</a>
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

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true\">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Nama Aset</th>
                            <th>Kategori</th>
                            <th>Merk</th>
                            <th>Spesifikasi</th>
                            <th>Status Aset</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($asets as $data)
                        <tr class="pilih" data-aset_id="<?php echo $data->id; ?>" data-aset_nama="<?php echo $data->nama_aset; ?>">
                            <td>@if($data->gambar)
                                <img src="{{url('images/aset/'. $data->gambar)}}" alt="image" style="margin-right: 10px;" />
                                @else
                                <img src="{{url('images/aset/default.png')}}" alt="image" style="margin-right: 10px;" />
                                @endif
                                {{$data->nama_aset}}</td>
                            <td>{{$data->kategori->nama_kategori}}</td>
                            <td>{{$data->merk}}</td>
                            <td>{{$data->spesifikasi}}</td>
                            <td>
                                @if($data->status_aset == 'Siap digunakan')
                                <label class="badge badge-success">Siap digunakan</label>
                                @else
                                <label class="badge badge-danger">Rusak(Bisa diperbaiki)</label>
                                @endif
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