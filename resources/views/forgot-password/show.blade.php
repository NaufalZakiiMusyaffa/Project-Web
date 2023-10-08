<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Lupa Password | Management Aset</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/iconfonts/puse-icons-feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.addons.css')}}">
  <link rel="stylesheet" href="{{asset('css/stylelogin.css')}}">
  <!-- endinject -->
  <link rel="icon" href="{{url('images/iconamanda.png')}}" />
</head>

<body>
  {{-- <div class="card"> --}}
    {{-- <div class="image">
      <img src="{{url('images/logoamanda.png')}}">
    </div> --}}
    <div class="content">
      <div class="details">
        <h3 style="text-align: center; margin-bottom: 25px;">RESET PASSWORD</h3>
        <form method="POST" action="{{ route('forgot-password.check') }}">
          {{ csrf_field() }}
          <div class="container">
            
            <input id="user_id" type="hidden" class="form-control" name="user_id" value="{{ $user_id }}" required>
            
            <div class="{{ $errors->has('verifikasi_kode') ? ' has-error' : '' }}">
              {{-- <label class="label">verifikasi_kode</label> --}}
            </div>
            <input id="verifikasi_kode" type="text" class="form-control" name="verifikasi_kode" value="{{ old('verifikasi_kode') }}" placeholder="Masukan Verifikasi Kode" required>
            @if ($errors->has('verifikasi_kode'))
            <span class="help-block">
              <h6>{{ $errors->first('verifikasi_kode') }}
                <h6>
            </span>
            @endif
            <br>
            <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                {{-- <label class="label">password</label> --}}
              </div>
              <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Masukan Password Baru anda" required>
              @if ($errors->has('password'))
              <span class="help-block">
                <h6>{{ $errors->first('password') }}
                  <h6>
              </span>
              @endif
            <button class="btn btn-primary submit-btn btn-block" type="submit">Reset Password</button>
          </div>
        </form>
        <h6>Amanda Brownies © {{date('Y')}}. All rights reserved.</h6>
      </div>
    </div>
  {{-- </div> --}}
</body>

</html>