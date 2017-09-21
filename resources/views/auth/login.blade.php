@extends('layouts.applogin')

@section('content')

<div class="login-box">
  <div class="login-logo">
    <p><b>RAPOR SMP KARTIKA NASIONAL</b></p>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Silahkan Melakukan Login Terlebih dahulu</p>

    <form action="{{ route('login') }}" method="post">
        {{ csrf_field() }}
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
        <input id="username" name="username" type="text" class="form-control" placeholder="Username"  value="{{ old('username') }}" required autofocus>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('username'))
            <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
        <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection
