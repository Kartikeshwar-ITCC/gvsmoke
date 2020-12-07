<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="{{ asset('dist/images/favicon.png') }}" />
        <title>{{ __('Login') }}</title>

        <!-- inject:css -->
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- endinject -->

        <!-- Main Style  -->
        <link rel="stylesheet" href="{{ asset('dist/css/main.css') }}">

        <script src="{{ asset('dist/js/modernizr-custom.js') }}"></script>
    </head>
    <body>

        <div class="sign-in-wrapper">
            <div class="sign-container">
                <div class="text-center">
                    <h2 class="logo"><img src="{{ asset('dist/images/logo.png') }}" width="250px" alt=""/></h2>
                    <h4>{{ __('Login') }}</h4>
                </div>

                <form class="sign-in-form" role="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control @error('email') error @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="text-danger" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') error @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="text-danger" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group text-center">
                        <label class="i-checks">
                            <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <i></i>
                        </label>
                        {{ __('Remember Me') }}
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                    <div class="text-center help-block">
                        <a href="{{ route('password.request') }}"><small>{{ __('Forgot Your Password?') }}</small></a>
                    </div>
                </form>
            </div>
        </div>

        <!-- inject:js -->
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ asset('bower_components/autosize/dist/autosize.min.js') }}"></script>
        <!-- endinject -->

        <!-- Common Script   -->
        <script src="{{ asset('dist/js/main.js') }}"></script>

    </body>
</html>
