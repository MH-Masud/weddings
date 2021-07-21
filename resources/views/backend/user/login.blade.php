<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <?php $company = DB::table('company_settings')->first();?>
        <title>
            {{ $company->name }} | Dashboard Login
        </title>
        <meta name="description" content="Login">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <?php $logo = json_decode($company->logo); ?>
        <!-- base css -->
        <link rel="stylesheet" media="screen, print" href="{{ asset('assets/backend')}}/css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="{{ asset('assets/backend')}}/css/app.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('uploads/logo/'.$logo[0]->thumb) }}">
        <link rel="icon" type="image/webp" sizes="32x32" href="{{ asset('uploads/logo/'.$logo[0]->thumb) }}">
        <link rel="mask-icon" href="{{ asset('uploads/logo/'.$logo[0]->thumb) }}" color="#5bbad5">
        <!-- Optional: page related CSS-->
        <link rel="stylesheet" media="screen, print" href="{{ asset('assets/backend')}}/css/page-login.css">
    </head>
    <body>
        <div class="blankpage-form-field">
            <div class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
                <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                    <img src="{{ asset('uploads/logo/'.$logo[0]->thumb)}}" alt="SmartAdmin WebApp" aria-roledescription="logo">
                    <span class="page-logo-text mr-1">Admin Dashboard Login</span>
                    <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                </a>
            </div>
            <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="email">Username</label>
                        <input type="email" required id="email" class="form-control" value="{{ old('email') }}" placeholder="email" name="email">
                        <span class="help-block">
                            Your email
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" required id="password" class="form-control" value="{{ old('password') }}" placeholder="password" name="password">
                        <span class="help-block">
                            Your password
                        </span>
                    </div>
                    <div class="form-group text-left">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" {{ old('rememberme') ? 'checked' : '' }} name="rememberme" id="rememberme">
                            <label class="custom-control-label" for="rememberme"> Remember me</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Login</button>
                </form>
            </div>
            <div class="blankpage-footer text-center">
                <a href="#"><strong>Recover Password</strong></a>
            </div>
        </div>
        {{-- <div class="login-footer p-2">
            <div class="row">
                <div class="col col-sm-12 text-center">
                    <i><strong>System Message:</strong> You were logged out from 198.164.246.1 on Saturday, March, 2017 at 10.56AM</i>
                </div>
            </div>
        </div> --}}
        @include('sweetalert::alert')
        <video poster="{{ asset('assets/backend')}}/img/backgrounds/clouds.png" id="bgvid" playsinline autoplay muted loop>
            <source src="{{ asset('assets/backend')}}/media/video/dd.mp4" type="video/mp4">
            <source src="{{ asset('assets/backend')}}/media/video/dd.mp4" type="video/mp4">
        </video>
        <script src="{{ asset('assets/backend')}}/js/vendors.bundle.js"></script>
        <script src="{{ asset('assets/backend')}}/js/app.bundle.js"></script>
        <!-- Page related scripts -->
    </body>
</html>
