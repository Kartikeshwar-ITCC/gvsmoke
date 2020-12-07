<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" type="image/png" href="{{ asset('dist/images/favicon.png') }}" />
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- inject:css -->
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- endinject -->

        @stack('styles')

        <!-- Main Style  -->
        <link rel="stylesheet" href="{{ asset('dist/css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}">
        <link href="{{ asset('bower_components/sweetalert/dist/sweetalert2.min.css') }}" rel="stylesheet">
        <link href="{{ asset('bower_components/toastr/toastr.min.css') }}" rel="stylesheet">

    </head>
    <body class="body-light">

        <div id="ui" class="ui ui-aside-compact">

            <!--header start-->
            <header id="header" class="ui-header">

                <div class="navbar-header">
                    <!--logo start-->
                    <a href="/" class="navbar-brand">
                        <span class="logo"><img src="{{ asset('dist/images/logo.png') }}" alt="" width="150px"/></span>
                        <span class="logo-compact"><img src="{{ asset('dist/images/favicon.png') }}" alt="" width="25px"/></span>
                        <!--<span class="logo"><strong>Gv Smoke Alarms</strong></span>
                        <span class="logo-compact"><strong>Gv</strong></span>-->
                    </a>
                    <!--logo end-->
                </div>

                <div class="search-dropdown dropdown pull-right visible-xs">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-search"></i></button>
                    <div class="dropdown-menu">
                        <form >
                            <input class="form-control" placeholder="Search here..." type="text">
                        </form>
                    </div>
                </div>

                <div class="navbar-collapse nav-responsive-disabled">

                    <!--toggle buttons start-->
                    <ul class="nav navbar-nav">
                        <li>
                            <a class="toggle-btn" data-toggle="ui-nav" href="#">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- toggle buttons end -->


                    <!--notification start-->
                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown dropdown-usermenu">
                            <a href="#" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <div class="user-avatar"><img class="body-light" src="{{ asset('dist/images/boy.png') }}" alt="..."></div>
                                <span class="hidden-sm hidden-xs">{{ \Auth::user()->name }}</span>
                                <!--<i class="fa fa-angle-down"></i>-->
                                <span class="caret hidden-sm hidden-xs"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                                <li><a href="{{ route('profileEdit') }}"><i class="fa fa-user"></i>  Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <!--notification end-->

                </div>

            </header>
            <!--header end-->

            <!--sidebar start-->
            <aside id="aside" class="ui-aside">
                <ul class="nav" ui-nav>
                    <li class="nav-head">
                        <h5 class="nav-title text-uppercase light-txt">Navigation</h5>
                    </li>
                    @if(Auth::user()->role == 'admin')
                    <li class="{{ request()->is('job*') ? 'active' : '' }}">
                        <a href="javascript::void(0)"><i class="fa fa-list-ul"></i><span>Jobs</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="nav nav-sub" style="display: {{ request()->is('job*') ? 'block' : 'none' }};">
                            <li><a href="{{ route('job') }}" class="{{ request()->is('job') ? 'active' : '' }}"><i class="fa fa-file"></i><span>Jobs list</span></a></li>
                            <li><a href="{{ route('jobPending') }}" class="{{ request()->is('job/pending') ? 'active' : '' }}"><i class="fa fa-clock-o"></i><span>Pending Approval</span></a></li>
                            <li><a href="{{ route('jobDeleted') }}" class="{{ request()->is('job/deleted') ? 'active' : '' }}"><i class="fa fa-trash"></i><span>No Longer Managed Jobs</span></a></li>
                        </ul>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('job') }}" class="{{ request()->is('job') || request()->is('job/*') ? 'active' : '' }}"><i class="fa fa-tasks"></i><span>Jobs</span></a>
                    </li>
                    @endif

                    @if(Auth::user()->role == 'admin')
                    <li>
                        <a href="{{ route('agency') }}" class="{{ request()->is('agency') || request()->is('agency/*') ? 'active' : '' }}"><i class="fa fa-users"></i><span>Agencies</span></a>
                    </li>
                    @endif

                </ul>
            </aside>
            <!--sidebar end-->

            <!--main content start-->
            <div id="content" class="ui-content">
                <div class="ui-content-body">
                    <div class="ui-container">
                        @yield('content')
                    </div>
                </div>
            </div>
            <!--main content end-->

            <!--footer start-->
            <div id="footer" class="ui-footer">
                2019 &copy; Gv Smoke Alarms | Powered by ITCC
            </div>
            <!--footer end-->

        </div>

        <!-- inject:js -->
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <!-- Scripts -->
        <script src="{{ asset('dist/js/moment.js') }}"></script>
        <script src="{{ asset('dist/js/modernizr-custom.js') }}"></script>
        <script src="{{ asset('bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ asset('bower_components/autosize/dist/autosize.min.js') }}"></script>
        <!-- endinject -->
        <!-- Common Script   -->
        <script src="{{ asset('bower_components/sweetalert/dist/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('bower_components/toastr/toastr.min.js') }}"></script>
        <script>
            // function notify(msg)
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            @if(Session::has('notify-success'))
                toastr["success"]('{{ Session::get('notify-success') }}')
            @endif
            @if(Session::has('notify-error'))
                toastr["error"]('{{ Session::get('notify-error') }}')
            @endif
            @if(Session::has('notify-warning'))
                toastr["warning"]('{{ Session::get('notify-warning') }}')
            @endif
        </script>

        @stack('scripts')
        <script src="{{ asset('dist/js/main.js') }}"></script>
    </body>
</html>
