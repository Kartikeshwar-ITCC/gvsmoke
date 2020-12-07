<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="{{ asset('dist/images/favicon.png') }}" />
        <title>{{ __('Forgot password') }}</title>

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
                    <h4>{{ __('Forgot password') }}</h4>
                    <p>Enter your email address and your password will be reset and emailed to you.</p>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="sign-in-form" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control @error('email') error @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="text-danger" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Send New Password</button>
                        <button type="button" onclick="window.history.back()" class="btn btn-block">Cancel</button>
                    </form>
                </div>
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
