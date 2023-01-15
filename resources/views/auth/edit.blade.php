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
</script>
@stop

@extends('layouts.app')

@section('content')
<form action="{{ route('user.update', $data->id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('put') }}
    <div class="row">
        <div class="col-md-9 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ubah Data Pengguna <b>[{{$data->name}}]</b> </h4>

                            <div class="form-row">
                            <div class="form-group col-md-5{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-12 control-label">Nama</label>
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}">
                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-4{{ $errors->has('email') ? ' has-error' : '' }}">
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

                            <div class="form-group col-md-3{{ $errors->has('level') ? ' has-error' : '' }}">
                                    <label for="level" class="col-md-12 control-label">Akses Login</label>
                                    <div class="col-md-12">
                                    <input id="level" type="text" class="form-control" name="level" value="{{ $data->level }}" readonly="">
                                        @if ($errors->has('level'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('level') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                            </div>
                            </div>

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
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

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Gambar</label>
                                <div class="col-md-11">
                                    <img class="product" width="200" height="200" @if($data->gambar) src="{{ asset('images/user/'.$data->gambar) }}" @endif />
                                    <input type="file" class="uploads form-control" style="margin-top: 20px;" name="gambar">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" id="submit">
                                    Perbaharui Data
                                </button>

                                <a href="{{route('user.index')}}" class="btn btn-light pull-right">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection