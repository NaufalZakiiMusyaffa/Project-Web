@section('js')
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


    var check = function() {
        if (document.getElementById('password').value ==
            document.getElementById('confirm_password').value) {
            document.getElementById('submit').disabled = false;
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'Password Cocok';
        } else {
            document.getElementById('submit').disabled = true;
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Password Tidak Cocok';
        }
    }

    $(document).on('click', '.pilih_karyawan', function(e) {
        document.getElementById("karyawan_id").value = $(this).attr('data-karyawan_id');
        document.getElementById("karyawan_nama").value = $(this).attr('data-karyawan_nama');
        $('#myModal2').modal('hide');
    });
</script>
@stop

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col d-flex align-items-stretch grid-margin">
        <div class="row flex-grow">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Profil Anda</b> </h4>
                        
                        <h4 class="card-title"><b>[Jabatan: {{$data->karyawan->jabatan}}]</b> </h4>                        
                        <form action="{{ route('karyawan.update', $data->karyawan->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <div class="form-row">
                                <div class="form-group col-md-6{{ $errors->has('nik') ? ' has-error' : '' }}">
                                    <label for="nik" class="col-md-12 control-label">NIK</label>
                                    <div class="col-md-12">
                                        <input id="nik" type="text" class="form-control" name="nik" value="{{ $data->karyawan->nik }}" maxlength="16" required>
                                        @if ($errors->has('nik'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nik') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6{{ $errors->has('nama') ? ' has-error' : '' }}">
                                    <label for="nama" class="col-md-12 control-label">Nama</label>
                                    <div class="col-md-12">
                                        <input id="nama" type="text" class="form-control" name="nama" value="{{ $data->karyawan->nama }}" required>
                                        @if ($errors->has('nama'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nama') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6{{ $errors->has('level') ? ' has-error' : '' }}">
                                    <label for="level" class="col-md-12 control-label">Jenis Kelamin</label>
                                    <div class="col-md-12">
                                        <select class="form-control" name="jk" required="">
                                            <option value=""></option>
                                            <option value="L" {{$data->karyawan->jk === "L" ? "selected" : ""}}>Laki - Laki</option>
                                            <option value="P" {{$data->karyawan->jk === "P" ? "selected" : ""}}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6{{ $errors->has('jabatan') ? ' has-error' : '' }}">
                                    <div class="form-group col-md-6{{ $errors->has('telepon') ? ' has-error' : '' }}">
                                        <label for="telepon" class="col-md-12 control-label">No Handphone</label>
                                        <div class="col-md-12">
                                            <input id="telepon" type="text" class="form-control" name="telepon" value="{{ $data->karyawan->telepon }}" maxlength="16" required>
                                            @if ($errors->has('telepon'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('telepon') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="gambar" class="col-md-12 control-label">Foto Karyawan</label>
                                    <div class="col-md-6">
                                        <img width="200" height="200" src="{{ $data->karyawan->gambar ? asset('images/user/'.$data->karyawan->gambar) : asset('images/user/default.png') }}" />
                                        <input type="file" class="uploads form-control" style="margin-top: 20px;" name="gambar">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="gambar" class="col-md-12 control-label">Tanda Tangan</label>
                                    <div class="col-md-6">
                                        <img width="600" height="200" src="{{ $data->karyawan->tanda_tangan ? asset('images/user/tanda_tangan/'.$data->karyawan->tanda_tangan) : asset('images/user/tanda_tangan/not-found.jpg') }}" />
                                        <input type="file" class="uploads form-control" style="margin-top: 20px;" name="tanda_tangan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2 mb-4">
                                <div class="row justify-content-between">
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-primary btn-block" id="submit">
                                            Perbaharui Data Diri
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <h4 class="card-title"><b>[Akses: {{$data->level}}]</b> </h4>
                        <form action="{{ route('user.update', $data->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <div class="form-row">
                                <div class="form-group col-md-6{{ $errors->has('username') ? ' has-error' : '' }}">
                                    <label for="username" class="col-md-12 control-label">Username</label>
                                    <div class="col-md-12">
                                        <input id="username" type="text" class="form-control" name="username" value="{{ $data->username }}" required>
                                        @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-12 control-label">Alamat Email</label>
                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ $data->email }}">
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-12 control-label">Kata Sandi Baru</label>
                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control" onkeyup='check();' name="password">
                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password-confirm" class="col-md-12 control-label">Konfirmasi Kata Sandi Baru</label>
                                    <div class="col-md-12">
                                        <input id="confirm_password" type="password" onkeyup="check()" class="form-control" name="password_confirmation">
                                        <span id='message'></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-2 mb-4">
                                <div class="row justify-content-between">
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-primary btn-block" id="submit">
                                            Perbaharui Data Pengguna
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
        <div class="modal-body table-responsive">
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
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection