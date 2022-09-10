<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="admin, admin panel, admin template, admin dashboard, responsive, bootstrap 4, ui kits, ecommerce, web app, crm, cms, html, sass support, scss">
    <meta name="author" content="Themesbox">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Admin Login</title>
    <!-- Fevicon -->
    {{-- <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}"> --}}
    <!-- Start css -->
    <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/icons.css" rel="stylesheet')}}" type="text/css">
    <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet" type="text/css">
    <!-- End css -->
</head>
<body class="vertical-layout">
    <!-- Start Containerbar -->
<div id="containerbar" class="containerbar authenticate-bg">
<div class="container">
    <div class="auth-box login-box">
        <!-- Start row -->
        <div class="row no-gutters align-items-center justify-content-center">
            <!-- Start col -->
            <div class="col-md-6 col-lg-5">
                <!-- Start Auth Box -->
                <div class="auth-box-right">
                     <div class="card">
                        @if(session('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
                        {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <h4 class="text-primary my-4">{{__('Login')}}</h4>
                        <div class="form-group row">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 ">
                                <div class="custom-control custom-checkbox text-left">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label font-14" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="forgot-psw">
                                @if (Route::has('password.request'))
                                <a class="forgot-psw" href="{{ route('password.request') }}">
                                    {{ __('Forgot  Password?') }}
                                </a>
                                </div>
                            @endif
                            </div>
                        </div>

                        {{-- <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-4"> --}}
                                <button type="submit" class="btn btn-primary btn-block btn-lg">
                                    {{ __('Login') }}
                                </button>


                            {{-- </div>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End Containerbar -->
<!-- Start js -->
{{-- <script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/detect.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script> --}}
<!-- End js -->
</body>
</html>
