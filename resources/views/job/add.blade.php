@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css')}}">
    <style type="text/css">
        .ml-5{ margin-left: 5px; }
        .panel .panel-heading{text-transform: none!important;}
        .btn_inline {padding: 7px 10px !important;}
        .width-20{ width: 20% !important; }
    </style>
@endpush
@section('content')
    <!--page title and breadcrumb start -->
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title"> Job
                <small></small>
            </h1>
        </div>
        <div class="col-md-4">
            <ul class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="javascript:void(0)" class="active">Add Job</a></li>
            </ul>
        </div>
    </div>
    <!--page title and breadcrumb end -->

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <header class="panel-heading">
                    Add New Job
                        <span class="tools pull-right">
                        </span>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <form role="form" autocomplete="off" id="addJobForm" method="POST" action="{{ route('jobPostUpdate') }}" enctype="multipart/form-data">
                                @csrf

                                @if(\Auth::user()->role == 'admin')
                                    <div class="form-group">
                                        <label for="agency_id">Agency<span class="text-danger">&nbsp;*</span></label>
                                        <select class="form-control mb-10" onchange="$('#property_manager_name').val($(this).children('option:selected').data('pm'));" id="agency_id" name="agency_id">
                                            <option value="" data-pm="">Select Agency</option>
                                            @foreach($agencyList as $agency)
                                            <option data-pm="{{$agency->property_manager_name}}" value="{{$agency->id}}">{{ $agency->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('agency_id')
                                            <span class="text-danger" role="alert">
                                                <p>{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="property_manager_name">Property Manager Name<span class="text-danger">&nbsp;*</span></label>
                                                <input class="form-control" id="property_manager_name" name="property_manager_name" readonly type="text" value="{{ old('property_manager_name') }}">
                                                @error('property_manager_name')
                                                    <span class="text-danger" role="alert">
                                                        <p>{{ $message }}</p>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="landlord">Landlord</label>
                                                <input class="form-control" id="landlord" name="landlord" type="text" value="{{ old('landlord') }}">
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <input type="hidden" name="agency_id" id="agency_id" value="{{ \Auth::Id() }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="property_manager_name">Property Manager Name</label>
                                                <input class="form-control" id="property_manager_name" name="property_manager_name" readonly type="text" value="{{ \Auth::user()->property_manager_name }}">
                                                @error('property_manager_name')
                                                    <span class="text-danger" role="alert">
                                                        <p>{{ $message }}</p>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="landlord">Landlord</label>
                                                <input class="form-control" id="landlord" name="landlord" type="text" value="{{ old('landlord') }}">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="landlord_contact">Landlord Contact</label>
                                            <input class="form-control" id="landlord_contact" name="landlord_contact"  type="text" value="{{ old('landlord_contact') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="landlord_email">Landlord Email</label>
                                            <input class="form-control" id="landlord_email" name="landlord_email"  type="text" value="{{ old('landlord_email') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Search Address</label>
                                    <input id="autocomplete" class="form-control" placeholder="Search Address" onFocus="geolocate()" type="text"/>
                                </div>
                                <div class="row">
                                    <div class="col-md-2" style="width:20%!important;">
                                        <div class="form-group">
                                            <label for="street_number">No.<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control" id="street_number" name="address_line_1" type="text" value="{{ old('address_line_1') }}">
                                            @error('address_line_1')
                                                <span class="text-danger" role="alert">
                                                    <p>{{ $message }}</p>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="width:20%!important;">
                                        <div class="form-group">
                                            <label for="route">Street<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control" id="route" name="address_line_2" type="text" value="{{ old('address_line_2') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="width:20%!important;">
                                        <div class="form-group">
                                            <label for="locality">Suburb<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control" id="locality" name="city"  type="text" value="{{ old('city') }}">
                                            @error('city')
                                                <span class="text-danger" role="alert">
                                                    <p>{{ $message }}</p>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="width:20%!important;">
                                        <div class="form-group">
                                            <label for="administrative_area_level_1">State<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control" id="administrative_area_level_1" name="state" type="text" value="{{ old('state') }}">
                                            @error('state')
                                                <span class="text-danger" role="alert">
                                                    <p>{{ $message }}</p>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 hide" style="width:20%!important;">
                                        <div class="form-group">
                                            <label for="country">Country<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control" id="country" name="country" type="text" value="{{ old('country') ?? 'Australia'}}">
                                            @error('country')
                                                <span class="text-danger" role="alert">
                                                    <p>{{ $message }}</p>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="width:20%!important;">
                                        <div class="form-group">
                                            <label for="postal_code">Postal Code<span class="text-danger">&nbsp;*</span></label>
                                            <input class="form-control" id="postal_code" name="postal_code"  type="text" value="{{ old('postal_code') }}">
                                            @error('postal_code')
                                                <span class="text-danger" role="alert">
                                                    <p>{{ $message }}</p>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                         <div class="form-group">
                                            <label for="location_area">Area Location</label>
                                            <input class="form-control" id="location_area" name="location_area" type="text" value="{{ old('location_area') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="key">Key #</label>
                                            <input class="form-control" id="key" name="key"  type="text" value="{{ old('key') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tenant">Tenant</label>
                                            <input class="form-control" id="tenant" name="tenant"  type="text" value="{{ old('tenant') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="contact_details">Contact Details</label>
                                            <input class="form-control" id="contact_details" name="contact_details" type="text" value="{{ old('contact_details') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tenant_email">Tenant Email</label>
                                            <input class="form-control" id="tenant_email" name="tenant_email" type="text" value="{{ old('tenant_email') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tenant_1">Tenant 1</label>
                                            <input class="form-control" id="tenant_1" name="tenant_1"  type="text" value="{{ old('tenant_1') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="contact_details_1">Contact Details 1</label>
                                            <input class="form-control" id="contact_details_1" name="contact_details_1" type="text" value="{{ old('contact_details_1') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tenant_email_1">Tenant Email 1</label>
                                            <input class="form-control" id="tenant_email_1" name="tenant_email_1" type="text" value="{{ old('tenant_email_1') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="comments">Comments</label>
                                            <textarea class="form-control autoresizenone" id="comments" name="comments" rows="3">{{ old('comments') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <header class="panel-heading panel-border">
                                                Does GV Smoke Alarm manage the Alarm Services?
                                                    <label class="radio radio-inline i-checks" for="alarm_service_yes">
                                                        <input name="alarm_service" id="alarm_service_yes" value="Yes" type="radio" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                        <i></i> Yes
                                                    </label>
                                                    <label class="radio-inline i-checks" for="alarm_service_no">
                                                        <input name="alarm_service" id="alarm_service_no" value="No" checked type="radio" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                        <i></i> No
                                                    </label>
                                            </header>
                                            <div class="panel-body" id="alarm_date" style="display: none;">
                                                <div class="col-md-4" id="alarm_date_div">
                                                    <div class="form-group">
                                                        <label for="last_alarm_service">Last Alarm Service Date</label>
                                                        <input class="form-control past-datepicker required" id="last_alarm_service" name="last_alarm_service" placeholder="DD-MM-YYYY" type="text" value="{{ old('last_alarm_service') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>

                                                <div class="col-md-4" id="service_month_div">
                                                    <div class="form-group">
                                                        <label for="service_month">Service Month</label>
                                                        <select class="form-control" id="service_month" name="service_month" placeholder="Service Month" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                            <option value="NA" {{ old('service_month') == 'NA' ? 'selected' : '' }}> NA (Not Active)</option>
                                                            <option value="January" {{ old('service_month') == 'January' ? 'selected' : '' }}> January </option>
                                                            <option value="February" {{ old('service_month') == 'February' ? 'selected' : '' }}> February </option>
                                                            <option value="March" {{ old('service_month') == 'March' ? 'selected' : '' }}> March </option>
                                                            <option value="April" {{ old('service_month') == 'April' ? 'selected' : '' }}> April </option>
                                                            <option value="May" {{ old('service_month') == 'May' ? 'selected' : '' }}> May </option>
                                                            <option value="June" {{ old('service_month') == 'June' ? 'selected' : '' }}> June </option>
                                                            <option value="July" {{ old('service_month') == 'July' ? 'selected' : '' }}> July </option>
                                                            <option value="August" {{ old('service_month') == 'August' ? 'selected' : '' }}> August </option>
                                                            <option value="September" {{ old('service_month') == 'September' ? 'selected' : '' }}> September </option>
                                                            <option value="October" {{ old('service_month') == 'October' ? 'selected' : '' }}> October </option>
                                                            <option value="November" {{ old('service_month') == 'November' ? 'selected' : '' }}> November </option>
                                                            <option value="December" {{ old('service_month') == 'December' ? 'selected' : '' }}> December </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                @if(\Auth::user()->role == 'admin')
                                                    <div class="col-md-4" id="status_div">
                                                        <div class="form-group">
                                                            <label for="status">Status</label>
                                                            <select class="form-control" id="status" name="status" placeholder="Status" value="{{ old('status') }}" onchange="toggleBookedDate(event)">
                                                                <option value="" {{ old('status') == '' ? 'selected' : '' }}>Select Status</option>
                                                                <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                                <option value="Quoted" {{ old('status') == 'Quoted' ? 'selected' : '' }}>Quoted</option>
                                                                <option value="Booked In" {{ old('status') == 'Booked In' ? 'selected' : '' }}>Booked In</option>
                                                                <option value="Overdue" {{ old('status') == 'Overdue' ? 'selected' : '' }}>Overdue</option>
                                                                <option value="On Hold" {{ old('status') == 'On Hold' ? 'selected' : '' }}>On Hold</option>
                                                                <option value="Postponed" {{ old('status') == 'Postponed' ? 'selected' : '' }}>Postponed</option>
                                                                <option value="New" {{ old('status') == 'New' ? 'selected' : '' }}>New</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @else
                                                    <input type="hidden" name="status" id="status" value="New">
                                                @endif

                                                <div class="col-md-3 hidden width-20" id="booked_date_div">
                                                    <div class="form-group">
                                                        <label for="booked_date">Booked Date</label>
                                                        <input class="form-control datepicker" id="booked_date" name="booked_date" placeholder="DD-MM-YYYY" type="text" value="{{ old('booked_date') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 hidden width-20" id="technician_div">
                                                    <div class="form-group">
                                                        <label for="technician">Technician</label>
                                                        <select class="form-control" id="technician" name="technician" placeholder="Technician" value="{{ old('technician') }}">
                                                            <option value="" {{ old('technician') == '' ? 'selected' : '' }}>Select Technician</option>
                                                            <option value="Sam" {{ old('technician') == 'Sam' ? 'selected' : '' }}>Sam</option>
                                                            <option value="Tom" {{ old('technician') == 'Tom' ? 'selected' : '' }}>Tom</option>
                                                            <option value="Joel" {{ old('technician') == 'Joel' ? 'selected' : '' }}>Joel</option>
                                                            <option value="Lucas" {{ old('technician') == 'Lucas' ? 'selected' : '' }}>Lucas</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="loc_custom_field_1">Location 1</label>
                                                        <input class="form-control" id="loc_custom_field_1" name="loc_custom_field_1" type="text" value="{{ old('loc_custom_field_1') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="t_custom_field_1">Type 1</label>
                                                        <input class="form-control" id="t_custom_field_1" name="t_custom_field_1" type="text" value="{{ old('t_custom_field_1') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exp_custom_field_1">Exp Date 1</label>
                                                        <input class="form-control year-datepicker" id="exp_custom_field_1" name="exp_custom_field_1" placeholder="YYYY" type="text" value="{{ old('exp_custom_field_1') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="loc_custom_field_2">Location 2</label>
                                                        <input class="form-control" id="loc_custom_field_2" name="loc_custom_field_2" type="text" value="{{ old('loc_custom_field_2') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="t_custom_field_2">Type 2</label>
                                                        <input class="form-control" id="t_custom_field_2" name="t_custom_field_2" type="text" value="{{ old('t_custom_field_2') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exp_custom_field_2">Exp Date 2</label>
                                                        <input class="form-control year-datepicker" id="exp_custom_field_2" name="exp_custom_field_2" placeholder="YYYY" type="text" value="{{ old('exp_custom_field_2') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="loc_custom_field_3">Location 3</label>
                                                        <input class="form-control" id="loc_custom_field_3" name="loc_custom_field_3" type="text" value="{{ old('loc_custom_field_3') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="t_custom_field_3">Type 3</label>
                                                        <input class="form-control" id="t_custom_field_3" name="t_custom_field_3" type="text" value="{{ old('t_custom_field_3') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exp_custom_field_3">Exp Date 3</label>
                                                        <input class="form-control year-datepicker" id="exp_custom_field_3" name="exp_custom_field_3" placeholder="YYYY" type="text" value="{{ old('exp_custom_field_3') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="loc_custom_field_4">Location 4</label>
                                                        <input class="form-control" id="loc_custom_field_4" name="loc_custom_field_4" type="text" value="{{ old('loc_custom_field_4') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="t_custom_field_4">Type 4</label>
                                                        <input class="form-control" id="t_custom_field_4" name="t_custom_field_4" type="text" value="{{ old('t_custom_field_4') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exp_custom_field_4">Exp Date 4</label>
                                                        <input class="form-control year-datepicker" id="exp_custom_field_4" name="exp_custom_field_4" placeholder="YYYY" type="text" value="{{ old('exp_custom_field_4') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="service_plan">Service Plan</label>
                                                        <select class="form-control" id="service_plan" name="service_plan" placeholder="Service Plan" value="{{ old('service_plan') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                            <option value="AI" {{ old('service_plan') == 'AI' ? 'selected' : '' }}> AI (All inclusive) </option>
                                                            <option value="$77" {{ old('service_plan') == '$77' ? 'selected' : '' }}> $77 </option>
                                                            <option value="$66" {{ old('service_plan') == '$66' ? 'selected' : '' }}> $66 </option>
                                                            <option value="$60" {{ old('service_plan') == '$60' ? 'selected' : '' }}> $60 </option>
                                                            <option value="$55" {{ old('service_plan') == '$55' ? 'selected' : '' }}> $55 </option>
                                                            <option value="Free" {{ old('service_plan') == 'Free' ? 'selected' : '' }}> Free </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <header class="panel-heading panel-border">
                                                Does this property have Gas Appliances?
                                                <label class="radio radio-inline i-checks" for="has_gas_appliances_yes">
                                                    <input name="has_gas_appliances" id="has_gas_appliances_yes" value="Yes" type="radio" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    <i></i> Yes
                                                </label>
                                                <label class="radio-inline i-checks" for="has_gas_appliances_no">
                                                    <input name="has_gas_appliances" id="has_gas_appliances_no" value="No" checked type="radio" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    <i></i> No
                                                </label>
                                                <label class="radio-inline i-checks" for="has_gas_appliances_unsure">
                                                    <input name="has_gas_appliances" id="has_gas_appliances_unsure" value="Unsure" checked type="radio" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    <i></i> Unsure
                                                </label>
                                            </header>
                                            <div class="panel-body hide" id="has_gas_appliances_div">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="loc_has_gas_appliances">Gas Appliances Location 1</label>
                                                        <input class="form-control" id="loc_has_gas_appliances" name="loc_has_gas_appliances" type="text" value="{{ old('loc_has_gas_appliances') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="t_has_gas_appliances">Gas Appliances Type 1</label>
                                                        <input class="form-control" id="t_has_gas_appliances" name="t_has_gas_appliances" type="text" value="{{ old('t_has_gas_appliances') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="loc_has_gas_appliances_1">Gas Appliances Location 2</label>
                                                        <input class="form-control" id="loc_has_gas_appliances_1" name="loc_has_gas_appliances_1" type="text" value="{{ old('loc_has_gas_appliances_1') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="t_has_gas_appliances_1">Gas Appliances Type 2</label>
                                                        <input class="form-control" id="t_has_gas_appliances_1" name="t_has_gas_appliances_1" type="text" value="{{ old('t_has_gas_appliances_1') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="loc_has_gas_appliances_2">Gas Appliances Location 3</label>
                                                        <input class="form-control" id="loc_has_gas_appliances_2" name="loc_has_gas_appliances_2" type="text" value="{{ old('loc_has_gas_appliances_2') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="t_has_gas_appliances_2">Gas Appliances Type 3</label>
                                                        <input class="form-control" id="t_has_gas_appliances_2" name="t_has_gas_appliances_2" type="text" value="{{ old('t_has_gas_appliances_2') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="loc_has_gas_appliances_3">Gas Appliances Location 4</label>
                                                        <input class="form-control" id="loc_has_gas_appliances_3" name="loc_has_gas_appliances_3" type="text" value="{{ old('loc_has_gas_appliances_3') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="t_has_gas_appliances_3">Gas Appliances Type 4</label>
                                                        <input class="form-control" id="t_has_gas_appliances_3" name="t_has_gas_appliances_3" type="text" value="{{ old('t_has_gas_appliances_3') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Does this property have Carbon Monoxide Alarm?</label>
                                                        <br>
                                                        <label class="radio radio-inline i-checks" for="has_carbon_monoxide_yes">
                                                            <input name="has_carbon_monoxide" id="has_carbon_monoxide_yes" value="Yes" type="radio" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                            <i></i> Yes
                                                        </label>
                                                        <label class="radio-inline i-checks" for="has_carbon_monoxide_no">
                                                            <input name="has_carbon_monoxide" id="has_carbon_monoxide_no" value="No" checked type="radio" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                            <i></i> No
                                                        </label>
                                                        <label class="radio-inline i-checks" for="has_carbon_monoxide_unsure">
                                                            <input name="has_carbon_monoxide" id="has_carbon_monoxide_unsure" value="Unsure" checked type="radio" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                            <i></i> Unsure
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="row hide" id="has_carbon_monoxide_div">
                                                    <div class="col-md-12">
                                                    @if(\Auth::user()->role == 'admin')
                                                        <div class="col-md-4" id="status_div_3">
                                                            <div class="form-group">
                                                                <label for="status_3">Status</label>
                                                                <select class="form-control" id="status_3" name="status_3" placeholder="Status" value="{{ old('status_3') }}" onchange="toggleBookedDate3(event)">
                                                                    <option value="" {{ old('status_3') == '' ? 'selected' : '' }}>Select Status</option>
                                                                    <option value="Completed" {{ old('status_3') == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                                    <option value="Quoted" {{ old('status_3') == 'Quoted' ? 'selected' : '' }}>Quoted</option>
                                                                    <option value="Booked In" {{ old('status_3') == 'Booked In' ? 'selected' : '' }}>Booked In</option>
                                                                    <option value="Overdue" {{ old('status_3') == 'Overdue' ? 'selected' : '' }}>Overdue</option>
                                                                    <option value="On Hold" {{ old('status_3') == 'On Hold' ? 'selected' : '' }}>On Hold</option>
                                                                    <option value="Postponed" {{ old('status_3') == 'Postponed' ? 'selected' : '' }}>Postponed</option>
                                                                    <option value="New" {{ old('status_3') == 'New' ? 'selected' : '' }}>New</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <input type="hidden" name="status_3" id="status_3" value="New">
                                                    @endif
                                                    <div class="col-md-4 hidden" id="booked_date_div_3">
                                                        <div class="form-group">
                                                            <label for="booked_date_3">Booked Date</label>
                                                            <input class="form-control datepicker" id="booked_date_3" name="booked_date_3" placeholder="DD-MM-YYYY" type="text" value="{{ old('booked_date_3') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 hidden" id="technician_div_3">
                                                        <div class="form-group">
                                                            <label for="technician_3">Technician</label>
                                                            <select class="form-control" id="technician_3" name="technician_3" placeholder="Technician" value="{{ old('technician_3') }}">
                                                                <option value="" {{ old('technician_3') == '' ? 'selected' : '' }}>Select Technician</option>
                                                                <option value="Sam" {{ old('technician_3') == 'Sam' ? 'selected' : '' }}>Sam</option>
                                                                <option value="Tom" {{ old('technician_3') == 'Tom' ? 'selected' : '' }}>Tom</option>
                                                                <option value="Joel" {{ old('technician_3') == 'Joel' ? 'selected' : '' }}>Joel</option>
                                                                <option value="Lucas" {{ old('technician_3') == 'Lucas' ? 'selected' : '' }}>Lucas</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="loc_has_carbon_monoxide_1">Carbon Monoxide Location 1</label>
                                                                <input class="form-control" id="loc_has_carbon_monoxide_1" name="loc_has_carbon_monoxide_1" type="text" value="{{ old('loc_has_carbon_monoxide_1') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="t_has_carbon_monoxide_1">Carbon Monoxide Type 1</label>
                                                                <input class="form-control" id="t_has_carbon_monoxide_1" name="t_has_carbon_monoxide_1" type="text" value="{{ old('t_has_carbon_monoxide_1') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="exp_has_carbon_monoxide_1">Carbon Monoxide Exp Year 1</label>
                                                                <input class="form-control year-datepicker" id="exp_has_carbon_monoxide_1" name="exp_has_carbon_monoxide_1" placeholder="YYYY" type="text" value="{{ old('exp_has_carbon_monoxide_1') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="loc_has_carbon_monoxide_2">Carbon Monoxide Location 2</label>
                                                                <input class="form-control" id="loc_has_carbon_monoxide_2" name="loc_has_carbon_monoxide_2" type="text" value="{{ old('loc_has_carbon_monoxide_2') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="t_has_carbon_monoxide_2">Carbon Monoxide Type 2</label>
                                                                <input class="form-control" id="t_has_carbon_monoxide_2" name="t_has_carbon_monoxide_2" type="text" value="{{ old('t_has_carbon_monoxide_2') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="exp_has_carbon_monoxide_2">Carbon Monoxide Exp Year 2</label>
                                                                <input class="form-control year-datepicker" id="exp_has_carbon_monoxide_2" name="exp_has_carbon_monoxide_2" placeholder="YYYY" type="text" value="{{ old('exp_has_carbon_monoxide_2') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <header class="panel-heading panel-border">
                                                Does GV Smoke Alarm manage the Gas Services?
                                                    <label class="radio radio-inline i-checks" for="gas_service_yes">
                                                        <input name="gas_service" id="gas_service_yes" value="Yes" type="radio" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                        <i></i> Yes
                                                    </label>
                                                    <label class="radio-inline i-checks" for="gas_service_no">
                                                        <input name="gas_service" id="gas_service_no" value="No" checked type="radio" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                        <i></i> No
                                                    </label>
                                            </header>
                                            <div class="panel-body" id="gas_date" style="display: none;">
                                                <div class="col-md-4" id="gas_date_div">
                                                    <div class="form-group">
                                                        <label for="last_gas_service">Last Gas Service Date</label>
                                                        <input class="form-control past-datepicker required" id="last_gas_service" name="last_gas_service" placeholder="DD-MM-YYYY" type="text" value="{{ old('last_gas_service') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="service_month_div_1">
                                                    <div class="form-group">
                                                        <label for="service_year_1">Service Year</label>
                                                        <input class="form-control year-datepicker" id="service_year_1" name="service_year_1"  type="text" value="{{ old('service_year_1') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                @if(\Auth::user()->role == 'admin')
                                                <div class="col-md-4" id="status_div_1">
                                                    <div class="form-group">
                                                        <label for="status_1">Status</label>
                                                        <select class="form-control" id="status_1" name="status_1" placeholder="Status" value="{{ old('status_1') }}" onchange="toggleBookedDate1(event)">
                                                            <option value="" {{ old('status_1') == '' ? 'selected' : '' }}>Select Status</option>
                                                            <option value="Completed" {{ old('status_1') == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                            <option value="Quoted" {{ old('status_1') == 'Quoted' ? 'selected' : '' }}>Quoted</option>
                                                            <option value="Booked In" {{ old('status_1') == 'Booked In' ? 'selected' : '' }}>Booked In</option>
                                                            <option value="Overdue" {{ old('status_1') == 'Overdue' ? 'selected' : '' }}>Overdue</option>
                                                            <option value="On Hold" {{ old('status_1') == 'On Hold' ? 'selected' : '' }}>On Hold</option>
                                                            <option value="Postponed" {{ old('status_1') == 'Postponed' ? 'selected' : '' }}>Postponed</option>
                                                            <option value="New" {{ old('status_1') == 'New' ? 'selected' : '' }}>New</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                @else
                                                <input type="hidden" name="status_1" id="status_1" value="New">
                                                @endif
                                                <div class="col-md-3 hidden width-20" id="booked_date_div_1">
                                                    <div class="form-group">
                                                        <label for="booked_date_1">Booked Date</label>
                                                        <input class="form-control datepicker" id="booked_date_1" name="booked_date_1" placeholder="DD-MM-YYYY" type="text" value="{{ old('booked_date_1') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 hidden width-20" id="technician_div_1">
                                                    <div class="form-group">
                                                        <label for="technician_1">Technician</label>
                                                        <select class="form-control" id="technician_1" name="technician_1" placeholder="Technician" value="{{ old('technician_1') }}">
                                                            <option value="" {{ old('technician_1') == '' ? 'selected' : '' }}>Select Technician</option>
                                                            <option value="Sam" {{ old('technician_1') == 'Sam' ? 'selected' : '' }}>Sam</option>
                                                            <option value="Tom" {{ old('technician_1') == 'Tom' ? 'selected' : '' }}>Tom</option>
                                                            <option value="Joel" {{ old('technician_1') == 'Joel' ? 'selected' : '' }}>Joel</option>
                                                            <option value="Lucas" {{ old('technician_1') == 'Lucas' ? 'selected' : '' }}>Lucas</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <header class="panel-heading panel-border">
                                                Does GV Smoke Alarm manage the Electrical Safety?
                                                    <label class="radio radio-inline i-checks" for="elec_service_yes">
                                                        <input name="elec_service" id="elec_service_yes" value="Yes" type="radio" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                        <i></i> Yes
                                                    </label>
                                                    <label class="radio-inline i-checks" for="elec_service_no">
                                                        <input name="elec_service" id="elec_service_no" value="No" checked type="radio" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                        <i></i> No
                                                    </label>
                                            </header>
                                            <div class="panel-body" id="elec_date" style="display: none;">
                                                <div class="col-md-4" id="elec_date_div">
                                                    <div class="form-group">
                                                        <label for="last_elec_service">Last Elec Service Date</label>
                                                        <input class="form-control past-datepicker required" id="last_elec_service" name="last_elec_service" placeholder="DD-MM-YYYY" type="text" value="{{ old('last_elec_service') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="service_month_div_2">
                                                    <div class="form-group">
                                                        <label for="service_year_2">Service Year</label>
                                                        <input class="form-control year-datepicker" id="service_year_2" name="service_year_2"  type="text" value="{{ old('service_year_2') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                @if(\Auth::user()->role == 'admin')
                                                <div class="col-md-4" id="status_div_2">
                                                    <div class="form-group">
                                                        <label for="status_2">Status</label>
                                                        <select class="form-control" id="status_2" name="status_2" placeholder="Status" value="{{ old('status_2') }}" onchange="toggleBookedDate2(event)">
                                                            <option value="" {{ old('status_2') == '' ? 'selected' : '' }}>Select Status</option>
                                                            <option value="Completed" {{ old('status_2') == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                            <option value="Quoted" {{ old('status_2') == 'Quoted' ? 'selected' : '' }}>Quoted</option>
                                                            <option value="Booked In" {{ old('status_2') == 'Booked In' ? 'selected' : '' }}>Booked In</option>
                                                            <option value="Overdue" {{ old('status_2') == 'Overdue' ? 'selected' : '' }}>Overdue</option>
                                                            <option value="On Hold" {{ old('status_2') == 'On Hold' ? 'selected' : '' }}>On Hold</option>
                                                            <option value="Postponed" {{ old('status_2') == 'Postponed' ? 'selected' : '' }}>Postponed</option>
                                                            <option value="New" {{ old('status_2') == 'New' ? 'selected' : '' }}>New</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                @else
                                                <input type="hidden" name="status_2" id="status_2" value="New">
                                                @endif
                                                <div class="col-md-3 hidden width-20" id="booked_date_div_2">
                                                    <div class="form-group">
                                                        <label for="booked_date_2">Booked Date</label>
                                                        <input class="form-control datepicker" id="booked_date_2" name="booked_date_2" placeholder="DD-MM-YYYY" type="text" value="{{ old('booked_date_2') }}" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 hidden width-20" id="technician_div_2">
                                                    <div class="form-group">
                                                        <label for="technician_2">Technician</label>
                                                        <select class="form-control" id="technician_2" name="technician_2" placeholder="Technician" value="{{ old('technician_2') }}">
                                                            <option value="" {{ old('technician_2') == '' ? 'selected' : '' }}>Select Technician</option>
                                                            <option value="Sam" {{ old('technician_2') == 'Sam' ? 'selected' : '' }}>Sam</option>
                                                            <option value="Tom" {{ old('technician_2') == 'Tom' ? 'selected' : '' }}>Tom</option>
                                                            <option value="Joel" {{ old('technician_2') == 'Joel' ? 'selected' : '' }}>Joel</option>
                                                            <option value="Lucas" {{ old('technician_2') == 'Lucas' ? 'selected' : '' }}>Lucas</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="append_main" id="append_row">
                                    <div class="row form-group append_main_tab">
                                        <label class="col-lg-2 col-form-label">Add Invoice:</label>
                                        <div class="col-lg-10">
                                            <div class="col-md-5">
                                                <input class="form-control" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/*" placeholder="Enter email" name="invoice_name[]" type="file" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                            </div>
                                            <div class="col-md-5">
                                                <select class="form-control" name="service_name[]" {{ \Auth::user()->role != 'admin' ? '' : ''}}>
                                                    <option value="Alarm" selected>Alarm</option>
                                                    <option value="Gas">Gas</option>
                                                    <option value="Elec">Elec</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-info btn_inline" id="add_new_invoice" {{ \Auth::user()->role != 'admin' ? '' : ''}}>Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix" style="margin-top: 20px;"></div>

                                <button type="submit" id="addJobButton" class="btn btn-primary pull-right m-5">Submit</button>
                                <a href="{{ route('job') }}" class="btn btn-danger pull-left m-5">Cancel</a>

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

$(document).ready(function() {
    $(".js-example-basic-select2").select2({
        placeholder: "Select Service"
    });
    let _count = 1;

    $('#add_new_invoice').on('click', function(e) {
        e.preventDefault();
        $('#append_row').append(`
                <div class="row form-group append_main_tab" id="myrow_`+_count+`">
                    <label class="col-lg-2 col-form-label">Add Invoice:</label>
                    <div class="col-lg-10">
                        <div class="col-md-5">
                            <input class="form-control" placeholder="Enter email" name="invoice_name[]" type="file">
                        </div>
                        <div class="col-md-5">
                            <select class="form-control" name="service_name[]">
                                <option value="Alarm" selected>Alarm</option>
                                <option value="Gas">Gas</option>
                                <option value="Elec">Elec</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn_inline removeme" row_id="myrow_`+_count+`">Remove</button>
                        </div>
                    </div>
                </div>
            `);
        _count++;
    });

    $(document).on('click', '.removeme', function(e) {
        e.preventDefault();
        const _removeid = $(this).attr('row_id');
        $('#'+_removeid).remove();
    });
 });

var placeSearch, autocomplete;

var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
    var options = {
     componentRestrictions: {country: ['au', 'nz']}
     // types: ['geocode']
  };
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'), options);

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete.setFields(['address_component']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle(
          {center: geolocation, radius: position.coords.accuracy});
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
</script>

<script>
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}


$("input[name=alarm_service]").change(function() {
    if($("input[name=alarm_service]:checked").val() == 'Yes'){
        $('#alarm_date').show();
    }else{
        $('#last_alarm_service').val(null);
        $('#alarm_date').hide();
    }
});
$("input[name=elec_service]").change(function() {
    if($("input[name=elec_service]:checked").val() == 'Yes'){
        $('#elec_date').show();
    }else{
        $('#last_elec_service').val(null);
        $('#elec_date').hide();
    }
});
$("input[name=gas_service]").change(function() {
    if($("input[name=gas_service]:checked").val() == 'Yes'){
        $('#gas_date').show();
    }else{
        $('#last_gas_service').val(null);
        $('#gas_date').hide();
    }
});

// function toggleServiceDates(){

//     var selectedValues = $('#services').val();
//     if(selectedValues){
//         if($.inArray("Alarm",selectedValues) !== -1){
//             $('#alarm_date').show();
//         }else{

//         }

//         if($.inArray("Gas",selectedValues) !== -1){
//             $('#gas_date').show();
//         }else{
//             $('#last_gas_service').val(null);
//             $('#gas_date').hide();
//         }

//         if($.inArray("Elec",selectedValues) !== -1){
//             $('#elec_date').show();
//         }else{
//             $('#last_elec_service').val(null);
//             $('#elec_date').hide();
//         }
//     }else{
//         $('#last_alarm_service').val(null);
//         $('#last_gas_service').val(null);
//         $('#last_elec_service').val(null);

//         $('#alarm_date').hide();
//         $('#gas_date').hide();
//         $('#elec_date').hide();
//     }
// }

function toggleBookedDate(event){
    console.log(event.target.value);
    if(event.target.value == 'Booked In'){
        $("#booked_date_div").removeClass('hidden');
        $("#technician_div").removeClass('hidden');
        $("#alarm_date_div").addClass('width-20');
        $("#status_div").addClass('width-20');
        $("#service_month_div").addClass('width-20');
    }else{
        $("#booked_date_div").addClass('hidden');
        $("#technician_div").addClass('hidden');
        $("#alarm_date_div").removeClass('width-20');
        $("#status_div").removeClass('width-20');
        $("#service_month_div").removeClass('width-20');
    }
}
function toggleBookedDate1(event){
    console.log(event.target.value);
    if(event.target.value == 'Booked In'){
        $("#booked_date_div_1").removeClass('hidden');
        $("#technician_div_1").removeClass('hidden');
        $("#gas_date_div").addClass('width-20');
        $("#status_div_1").addClass('width-20');
        $("#service_month_div_1").addClass('width-20');
    }else{
        $("#booked_date_div_1").addClass('hidden');
        $("#technician_div_1").addClass('hidden');
        $("#gas_date_div").removeClass('width-20');
        $("#status_div_1").removeClass('width-20');
        $("#service_month_div_1").removeClass('width-20');
    }
}
function toggleBookedDate2(event){
    console.log(event.target.value);
    if(event.target.value == 'Booked In'){
        $("#booked_date_div_2").removeClass('hidden');
        $("#technician_div_2").removeClass('hidden');
        $("#elec_date_div").addClass('width-20');
        $("#status_div_2").addClass('width-20');
        $("#service_month_div_2").addClass('width-20');
    }else{
        $("#booked_date_div_2").addClass('hidden');
        $("#technician_div_2").addClass('hidden');
        $("#elec_date_div").removeClass('width-20');
        $("#status_div_2").removeClass('width-20');
        $("#service_month_div_2").removeClass('width-20');
    }
}
function toggleBookedDate3(event){
    console.log(event.target.value);
    if(event.target.value == 'Booked In'){
        $("#booked_date_div_3").removeClass('hidden');
        $("#technician_div_3").removeClass('hidden');
    }else{
        $("#booked_date_div_3").addClass('hidden');
        $("#technician_div_3").addClass('hidden');
    }
}

$("input[name=has_gas_appliances]").change(function() {
    if($("input[name=has_gas_appliances]:checked").val() == 'Yes'){
        $("#has_gas_appliances_div").removeClass('hide');
    }else{
        $("#has_gas_appliances_div").addClass('hide');
    }
});
$("input[name=has_carbon_monoxide]").change(function() {
    if($("input[name=has_carbon_monoxide]:checked").val() == 'Yes'){
        $("#has_carbon_monoxide_div").removeClass('hide');
    }else{
        $("#has_carbon_monoxide_div").addClass('hide');
    }
});


$("#addJobButton").click(function(event){
    event.preventDefault();

    if($("#agency_id").val() == ''){
        toastr["error"]("Please Select Agency");
        $('#agency_id').focus();
        return false;
    }
    if($("#property_manager_name").val() == ''){
        toastr["error"]("Enter Property Manager Name");
        $('#property_manager_name').focus();
        return false;
    }

    if($("#landlord_email").val() != ''){
        if( !isEmail($("#landlord_email").val()) ){
            toastr["error"]('Invalid Email');
            $('#landlord_email').focus();
            return false;
        }
    }

    if($("#street_number").val() == ''){
        toastr["error"]("Please Enter No.");
        $('#street_number').focus();
        return false;

    }
    if($("#route").val() == ''){
        toastr["error"]("Please Enter Street");
        $('#route').focus();
        return false;

    }
    if($("#locality").val() == ''){
        toastr["error"]("Please Enter Suburb");
        $('#locality').focus();
        return false;

    }
    if($("#administrative_area_level_1").val() == ''){
        toastr["error"]("Please Enter State");
        $('#administrative_area_level_1').focus();
        return false;

    }
    if($("#country").val() == ''){
        toastr["error"]("Please Enter Country");
        $('#country').focus();
        return false;

    }
    if($("#postal_code").val() == ''){
        toastr["error"]("Please Enter Zip Code");
        $('#postal_code').focus();
        return false;

    }
    var selectedValues = $('#services').val();
    // if($.inArray("Alarm",selectedValues) !== -1){
    //     if($("#last_alarm_service").val() == '' ){
    //         toastr["error"]("Please Select Date");
    //         $("#last_alarm_service").focus();
    //         return false;
    //     }
    // }
    // if($.inArray("Gas",selectedValues) !== -1){
    //     if($("#last_gas_service").val() == '' ){
    //         toastr["error"]("Please Select Date");
    //         $("#last_gas_service").focus();
    //         return false;
    //     }
    // }
    // if($.inArray("Elec",selectedValues) !== -1){
    //     if($("#last_elec_service").val() == '' ){
    //         toastr["error"]("Please Select Date");
    //         $("#last_elec_service").focus();
    //         return false;
    //     }
    // }
    $("#addJobForm").submit();

});

</script>
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
<script>
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd-mm-yyyy',
            clearBtn: true
        });
        $('.year-datepicker').datepicker({
            viewMode: "years",
            minViewMode: "years",
            format: 'yyyy',
            autoclose: true,
            clearBtn: true

        });
        $('.past-datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd-mm-yyyy',
            endDate: '+0d',
            clearBtn: true
        });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('settings.googlePlacesAPIKey') }}&libraries=places&callback=initAutocomplete"></script>
@endpush
