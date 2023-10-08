<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login | Management Aset</title>

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
  <div class="card">
    <div class="image">
      <img src="{{url('images/logoamanda.png')}}">
    </div>
    <div class="content">
      <div class="details">
        <h2>MANAGEMENT ASET</h2>
        <form method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
          <div class="container">
            <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
              <label class="label">Username</label>
            </div>
            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
            <span class="help-block">
              <h6>{{ $errors->first('email') }}
                <h6>
            </span>
            @endif
            <br>
            <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
              <label class="label">Password</label>
            </div>
            <input id="password" type="password" class="form-control" name="password" required>
            @if ($errors->has('password'))
            <span class="help-block">
              <strong>
                <h5>{{ $errors->first('password') }}
              </strong></h5>
            </span>
            @endif
            <div style="text-align: right !important">
              <a href="{{route('forgot-password.index')}}">Lupa Password</a>
            </div>
            <button class="btn btn-primary submit-btn btn-block" type="submit">Login</button>
          </div>
        </form>
        <h6>Amanda Brownies © {{date('Y')}}. All rights reserved.</h6>
      </div>
    </div>
  </div>
</body>

</html>