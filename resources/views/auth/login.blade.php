@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="login-box">
        <div class="login-logo">
            <a href="#"><b></b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="row">
                {{-- <div class="col-md-6 d-none d-md-block">
                    <img src="backend/dist/img/login-bg.jpg" id="login-bg" style="width:100%; height:450px">
                </div> --}}
                <div class="col-md-12">
                    <div class="card-body login-card-body">
                        <h3 class="text-center">Đăng Nhập Hệ Thống</h3>
                        <p class="login-box-msg"></p>
                        <p class="error text-danger error-faillogin"></p>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="input-group mt-4">
                                <div class="input-group-prepend has-feedback">
                                    <span class="far fa-envelope form-control-feedback input-group-text"></span>
                                </div>
                                <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" id="email" value="{{ old('email') }}" name="email">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <p class="text-danger error error-email">
                            </p>
                            <div class="input-group my-2">
                                <div class="input-group-prepend has-feedback">
                                    <span class="far fa-lock form-control-feedback input-group-text"></span>
                                </div>
                                <input type="password" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Password" id="password" name="password">
                                 @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <p class="text-danger error error-password"></p>
                            <div class="row my-2">
                                <div class="col-8">
                                    <div class="checkbox icheck">
                                        <label>
                                                <input type="checkbox"> Ghi Nhớ
                                              </label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-4">
                                    <button type="submit" id="btn-login" class="btn btn-primary btn-block btn-flat">Đăng Nhập</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>

                        <div class="social-auth-links text-center my-3">
                            <p>- Hoặc -</p>
                            <a href="#" class="btn btn-block btn-primary">
                              <i class="fab fa-facebook mr-2"></i> Đăng Nhập Facebook
                            </a>
                            <a href="#" class="btn btn-block btn-danger">
                              <i class="fab fa-google-plus mr-2"></i> Đăng Nhập Google
                            </a>
                        </div>
                        <!-- /.social-auth-links -->

                        <p class="mb-1 float-left">
                            <a href="#">Quên Mật Khẩu</a>
                        </p>
                        <p class="mb-0 float-right">
                            <a href="register" class="text-center">Đăng Ký Thành Viên</a>
                        </p>
                        <div class="clearfix">

                        </div>
                    </div>
                </div>
            </div>

            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
