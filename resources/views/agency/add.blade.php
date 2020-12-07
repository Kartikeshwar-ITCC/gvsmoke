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
                <li><a href="javascript:void(0)" class="active">Add Agency</a></li>
            </ul>
        </div>
    </div>
    <!--page title and breadcrumb end -->

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <header class="panel-heading">
                    Add New Agency
                        <span class="tools pull-right">
                        </span>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <form autocomplete="off" role="form" id="addAgencyForm" method="POST" action="{{ route('agencyPostUpdate') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Agency Name<span class="text-danger">&nbsp;*</span></label>
                                    <input class="form-control @error('name') error @enderror" id="name" name="name" placeholder="Agency Name" type="text" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger" role="alert">
                                            <p>{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="property_manager_name">Property Manager Name<span class="text-danger">&nbsp;*</span></label>
                                    <input class="form-control @error('property_manager_name') error @enderror" id="property_manager_name" name="property_manager_name" placeholder="Property Manager Name" type="text" value="{{ old('property_manager_name') }}">
                                    @error('property_manager_name')
                                        <span class="text-danger" role="alert">
                                            <p>{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address<span class="text-danger">&nbsp;*</span></label>
                                    <input class="form-control  @error('email') error @enderror" id="email" name="email" placeholder="Email Address" type="text" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="text-danger" role="alert">
                                            <p>{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>

                                <button type="submit" id="addAgencyButton" class="btn btn-primary pull-right m-5">Submit</button>
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

$("#addAgencyButton").click(function(event){
    event.preventDefault();
    if($("#name").val() == ''){
        toastr["error"]("Enter Agency Name");
        $('#name').focus();
        return false;
    }
    if($("#property_manager_name").val() == ''){
        toastr["error"]("Enter Property Manager Name");
        $('#property_manager_name').focus();
        return false;
    }
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
    $("#addAgencyForm").submit();

});

</script>
@endpush
