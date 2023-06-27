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
<form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tambah Pengguna Baru</h4>

                            <div class="form-row">
                                <div class="form-group col-md-6{{ $errors->has('karyawan_id') ? ' has-error' : '' }}">
                                    <label for="karyawan_id" class="col-md-6 control-label">Nama Karyawan</label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input id="karyawan_nama" type="text" class="form-control" readonly="" required>
                                            <input id="karyawan_id" type="hidden" name="karyawan_id" value="{{ old('karyawan_id') }}" required readonly="">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2"><b>Cari Karyawan</b> <span class="fa fa-search"></span></button>
                                            </span>
                                        </div>
                                    </div>
                                    @if ($errors->has('karyawan_id'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('karyawan_id') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-12 control-label">Alamat Email</label>
                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6{{ $errors->has('username') ? ' has-error' : '' }}">
                                    <label for="username" class="col-md-12 control-label">Username</label>
                                    <div class="col-md-12">
                                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>
                                        @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6{{ $errors->has('level') ? ' has-error' : '' }}">
                                    <label for="level" class="col-md-12 control-label">Akses Login</label>
                                    <div class="col-md-12">
                                        <select class="form-control" name="level" required="">
                                            <option value="">Pilih Level</option>
                                            <option value="manager">MANAGER</option>
                                            <option value="it">IT</option>
                                            <option value="autocare">AUTOCARE</option>
                                        </select>
                                    </div>
                                </div>    
                            </div>

                            <div class="form-row">
                            <div class="form-group col-md-6{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-12 control-label">Kata Sandi</label>
                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control" onkeyup='check();' name="password" required>
                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                            </div>

                            <div class="form-group col-md-6">
                                    <label for="password-confirm" class="col-md-12 control-label">Konfirmasi Kata Sandi</label>
                                    <div class="col-md-12">
                                        <input id="confirm_password" type="password" onkeyup="check()" class="form-control" name="password_confirmation" required>
                                        <span id='message'></span>
                                    </div>
                            </div>
                            </div>

                            <div class="col-md-12 mt-2">
                                <div class="row justify-content-between">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-sm-4 mt-1">
                                                <button type="submit" class="btn btn-primary btn-block" id="submit">
                                                    Kirim
                                                </button>
                                            </div>
                                            <div class="col-sm-8 mt-1">
                                                <button type="reset" class="btn btn-danger btn-block text-truncate">
                                                    Hapus Data Inputan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="{{route('user.index')}}" class="btn btn-light pull-right mt-1">Kembali</a>
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
              @foreach($karyawans as $data)
              <tr class="pilih_karyawan" data-karyawan_id="<?php echo $data->id; ?>" data-karyawan_nama="<?php echo $data->nama; ?>">
                <td class="py-1">
                  @if($data->gambar)
                  <img src="{{url('images/user', $data->gambar)}}" alt="image" style="margin-right: 10px;" />
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