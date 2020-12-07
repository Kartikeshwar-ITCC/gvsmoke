@extends('layouts.app')
@section('content')

    <!--page title and breadcrumb start -->
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title"> Agencies
                <small></small>
            </h1>
        </div>
        <div class="col-md-4">
            <ul class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="javascript:void(0)" class="active">Edit Profile</a></li>
            </ul>
        </div>
    </div>
    <!--page title and breadcrumb end -->

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <header class="panel-heading">
                    Edit Profile
                        <span class="tools pull-right">
                        </span>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <form role="form" id="editProfileForm" method="POST" action="{{ route('profilePostUpdate') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" id="name" name="name" placeholder="Name" type="text" value="{{ \Auth::user()->name }}">
                                </div>

                                @if(\Auth::user()->role == 'agency')
                                <div class="form-group">
                                    <label for="property_manager_name">Property Manager Name</label>
                                    <input class="form-control" id="property_manager_name" name="property_manager_name" placeholder="Property Manager Name" type="text" value="{{ \Auth::user()->property_manager_name }}">
                                </div>
                                @endif

                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input class="form-control" id="email" disabled="true" name="email" placeholder="Email Address" type="text" value="{{ \Auth::user()->email }}">
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="password">Password</label>
                                        <input class="form-control" id="password" name="password" placeholder="Password" type="password" value="{{ old('password') }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" type="password" value="{{ old('confirm_password') }}">
                                    </div>
                                </div>

                                <button type="submit" id="editProfileButton" class="btn btn-primary pull-right m-5">Save</button>
                                <a href="{{ route('agency') }}" class="btn btn-danger pull-left m-5">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script>

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

$("#editProfileButton").click(function(event){
    event.preventDefault();
    if($("#name").val() == ''){
        toastr["error"]("Enter Profile Name");
        $('#name').focus();
        return false;
    }
    @if(\Auth::user()->role == 'agency')
    if($("#property_manager_name").val() == ''){
        toastr["error"]("Enter Property Manager Name");
        $('#property_manager_name').focus();
        return false;
    }
    @endif
    if($("#email").val() == ''){
        toastr["error"]('Enter Email Address');
        $('#email').focus();
        return false;
    }
    if( !isEmail($("#email").val()) ){
        toastr["error"]('Invalid Email');
        $('#email').focus();
        return false;
    }

    if($("#password").val() != $("#confirm_password").val()){
        toastr["error"]('Password And Confirm password should be same..!');
        $('#password').focus();
        return false;
    }

    if( $("#password").val() != '' && $("#password").val() == $("#confirm_password").val() && $("#password").val().length < 7 ){
        toastr["error"]('Too Short Password..!');
        $('#password').focus();
        return false;
    }

    $("#editProfileForm").submit();
});

</script>
@endpush
