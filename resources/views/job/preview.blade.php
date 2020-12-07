@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}">
<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css')}}">
<style>
.panel-body { padding: 15px; }
.m-5 { margin: 5px; }
/*.text-success {
    color: #ff6c60 !important;
}
.text-danger {
    color: #23b9a9 !important;
}*/
.width-20{ width: 20% !important; }
</style>
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
                <li><a href="javascript:void(0)" class="active">Preview Changes</a></li>
            </ul>
        </div>
    </div>
    <!--page title and breadcrumb end -->

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <header class="panel-heading">
                    Preview Changes
                        <span class="pull-right">
                                <a href="{{ route('jobPostDecline', ['id' => $job->id]) }}" class="btn btn-sm btn-danger pull-left m-5">Decline</a>
                                <a href="{{ route('jobPostApprove', ['id' => $job->id]) }}" class="btn btn-sm btn-primary pull-right m-5">Approve</a>
                                <a href="{{ route('jobPreviewEditChanges', ['id' => $job->id]) }}" class="btn btn-sm btn-primary pull-right m-5">Edit</a>
                        </span>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="preview_tab">
                                @csrf

                                <input type="hidden" name="id" value="{{ $job->id }}">
                                <input type="hidden" name="agency_id" id="agency_id" value="{{ $job->agency_id }}">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="property_manager_name">Property Manager Name<span class="text-danger">&nbsp;*</span></label>
                                            @if($job->property_manager_name != $clonedJob->property_manager_name)
                                                <p class="text-danger m-0"><b><del>{{$job->property_manager_name}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->property_manager_name}}</b></p>
                                            @else
                                                <p>{{$job->property_manager_name}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="landlord">Landlord</label>
                                            @if($job->landlord != $clonedJob->landlord)
                                                <p class="text-danger m-0"><b><del>{{$job->landlord}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->landlord}}</b></p>
                                            @else
                                                <p>{{$job->landlord}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="landlord_contact">Landlord Contact</label>
                                            @if($job->landlord_contact != $clonedJob->landlord_contact)
                                                <p class="text-danger m-0"><b><del>{{$job->landlord_contact}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->landlord_contact}}</b></p>
                                            @else
                                                <p>{{$job->landlord_contact}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="landlord_email">Landlord Email</label>
                                            @if($job->landlord_email != $clonedJob->landlord_email)
                                                <p class="text-danger m-0"><b><del>{{$job->landlord_email}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->landlord_email}}</b></p>
                                            @else
                                                <p>{{$job->landlord_email}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="street_number">No.<span class="text-danger">&nbsp;*</span></label>
                                            @if($job->address_line_1 != $clonedJob->address_line_1)
                                                <p class="text-danger m-0"><b><del>{{$job->address_line_1}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->address_line_1}}</b></p>
                                            @else
                                                <p>{{$job->address_line_1}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="route">Street<span class="text-danger">&nbsp;*</span></label>
                                            @if($job->address_line_2 != $clonedJob->address_line_2)
                                                <p class="text-danger m-0"><b><del>{{$job->address_line_2}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->address_line_2}}</b></p>
                                            @else
                                                <p>{{$job->address_line_2}}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="locality">Suburb<span class="text-danger">&nbsp;*</span></label>
                                            @if($job->city != $clonedJob->city)
                                                <p class="text-danger m-0"><b><del>{{$job->city}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->city}}</b></p>
                                            @else
                                                <p>{{$job->city}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="administrative_area_level_1">State<span class="text-danger">&nbsp;*</span></label>
                                            @if($job->state != $clonedJob->state)
                                                <p class="text-danger m-0"><b><del>{{$job->state}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->state}}</b></p>
                                            @else
                                                <p>{{$job->state}}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="country">Country<span class="text-danger">&nbsp;*</span></label>
                                            @if($job->country != $clonedJob->country)
                                                <p class="text-danger m-0"><b><del>{{$job->country}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->country}}</b></p>
                                            @else
                                                <p>{{$job->country}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="postal_code">Postal Code<span class="text-danger">&nbsp;*</span></label>
                                            @if($job->postal_code != $clonedJob->postal_code)
                                                <p class="text-danger m-0"><b><del>{{$job->postal_code}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->postal_code}}</b></p>
                                            @else
                                                <p>{{$job->postal_code}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="location_area">Area Location</label>
                                            @if($job->location_area != $clonedJob->location_area)
                                                <p class="text-danger m-0"><b><del>{{$job->location_area}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->location_area}}</b></p>
                                            @else
                                                <p>{{$job->location_area}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="key">Key #</label>
                                            @if($job->key != $clonedJob->key)
                                                <p class="text-danger m-0"><b><del>{{$job->key}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->key}}</b></p>
                                            @else
                                                <p>{{$job->key}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tenant">Tenant</label>
                                            @if($job->tenant != $clonedJob->tenant)
                                                <p class="text-danger m-0"><b><del>{{$job->tenant}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->tenant}}</b></p>
                                            @else
                                                <p>{{$job->tenant}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="contact_details">Contact Details</label>
                                            @if($job->contact_details != $clonedJob->contact_details)
                                                <p class="text-danger m-0"><b><del>{{$job->contact_details}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->contact_details}}</b></p>
                                            @else
                                                <p>{{$job->contact_details}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tenant_email">Tenant Email</label>
                                            @if($job->tenant_email != $clonedJob->tenant_email)
                                                <p class="text-danger m-0"><b><del>{{$job->tenant_email}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->tenant_email}}</b></p>
                                            @else
                                                <p>{{$job->tenant_email}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tenant_1">Tenant 1</label>
                                            @if($job->tenant_1 != $clonedJob->tenant_1)
                                                <p class="text-danger m-0"><b><del>{{$job->tenant_1}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->tenant_1}}</b></p>
                                            @else
                                                <p>{{$job->tenant_1}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="contact_details_1">Contact Details 1</label>
                                            @if($job->contact_details_1 != $clonedJob->contact_details_1)
                                                <p class="text-danger m-0"><b><del>{{$job->contact_details_1}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->contact_details_1}}</b></p>
                                            @else
                                                <p>{{$job->contact_details_1}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tenant_email_1">Tenant Email 1</label>
                                            @if($job->tenant_email_1 != $clonedJob->tenant_email_1)
                                                <p class="text-danger m-0"><b><del>{{$job->tenant_email_1}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->tenant_email_1}}</b></p>
                                            @else
                                                <p>{{$job->tenant_email_1}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="comments">Comments</label>
                                            @if($job->comments != $clonedJob->comments)
                                                <p class="text-danger m-0"><b><del>{{$job->comments}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->comments}}</b></p>
                                            @else
                                                <p>{{$job->comments}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="alarm_service">Does GV Smoke Alarm manage the Alarm Services?</label>
                                            @if($job->alarm_service != $clonedJob->alarm_service)
                                                <p class="text-danger m-0"><b><del>{{ $job->alarm_service }}</del></b></p>
                                                <p class="text-success m-0"><b>{{ $clonedJob->alarm_service }}</b></p>
                                            @else
                                                <p>{{ $job->alarm_service }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="display: {{ $job->alarm_service=='Yes' ? 'block' : 'none' }}">
                                    <div class="col-md-4" id="alarm_date">
                                        <div class="form-group">
                                            <label for="last_alarm_service">Last Alarm Service Date</label>
                                            @if($job->last_alarm_service != $clonedJob->last_alarm_service)
                                                <p class="text-danger m-0"><b><del>{{ $job->last_alarm_service != null ? \Carbon\Carbon::parse($job->last_alarm_service)->format('d-m-Y') : '' }}</del></b></p>
                                                <p class="text-success m-0"><b>{{ $clonedJob->last_alarm_service != null ? \Carbon\Carbon::parse($clonedJob->last_alarm_service)->format('d-m-Y') : '' }}</b></p>
                                            @else
                                                <p>{{ $job->last_alarm_service != null ? \Carbon\Carbon::parse($job->last_alarm_service)->format('d-m-Y') : '' }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="service_month">Service Month</label>
                                            @if($job->service_month != $clonedJob->service_month)
                                                <p class="text-danger m-0"><b><del>{{$job->service_month}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->service_month}}</b></p>
                                            @else
                                                <p>{{$job->service_month}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            @if($job->status != $clonedJob->status || $job->booked_date != $clonedJob->booked_date || $job->technician != $clonedJob->technician)
                                                <p class="text-danger m-0"><b><del>{{$job->status}} @if($job->status == 'Booked In') - {{ $job->booked_date != null ? \Carbon\Carbon::parse($job->booked_date)->format('d M Y') : '' }} {{ $job->technician ?? '' }} @endif</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->status}} @if($clonedJob->status == 'Booked In') - {{ $clonedJob->booked_date != null ? \Carbon\Carbon::parse($clonedJob->booked_date)->format('d M Y') : '' }} {{ $clonedJob->technician ?? '' }} @endif</b></p>
                                            @else
                                                <p>{{$job->status}} @if($job->status == 'Booked In') - {{ $job->booked_date != null ? \Carbon\Carbon::parse($job->booked_date)->format('d M Y') : '' }} {{ $job->technician ?? '' }} @endif</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="display: {{ $job->alarm_service=='Yes' ? 'block' : 'none' }}">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loc_custom_field_1">Location 1</label>
                                            @if($job->loc_custom_field_1 != $clonedJob->loc_custom_field_1)
                                                <p class="text-danger m-0"><b><del>{{$job->loc_custom_field_1}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->loc_custom_field_1}}</b></p>
                                            @else
                                                <p>{{$job->loc_custom_field_1}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="t_custom_field_1">Type 1</label>
                                            @if($job->t_custom_field_1 != $clonedJob->t_custom_field_1)
                                                <p class="text-danger m-0"><b><del>{{$job->t_custom_field_1}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->t_custom_field_1}}</b></p>
                                            @else
                                                <p>{{$job->t_custom_field_1}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exp_custom_field_1">Exp Date 1</label>
                                            @if($job->exp_custom_field_1 != $clonedJob->exp_custom_field_1)
                                                <p class="text-danger m-0"><b><del>{{ $job->exp_custom_field_1 }}</del></b></p>
                                                <p class="text-success m-0"><b>{{ $clonedJob->exp_custom_field_1 }}</b></p>
                                            @else
                                                <p>{{ $job->exp_custom_field_1 ?? '' }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="display: {{ $job->alarm_service=='Yes' ? 'block' : 'none' }}">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loc_custom_field_2">Location 2</label>
                                            @if($job->loc_custom_field_2 != $clonedJob->loc_custom_field_2)
                                                <p class="text-danger m-0"><b><del>{{$job->loc_custom_field_2}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->loc_custom_field_2}}</b></p>
                                            @else
                                                <p>{{$job->loc_custom_field_2}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="t_custom_field_2">Type 2</label>
                                            @if($job->t_custom_field_2 != $clonedJob->t_custom_field_2)
                                                <p class="text-danger m-0"><b><del>{{$job->t_custom_field_2}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->t_custom_field_2}}</b></p>
                                            @else
                                                <p>{{$job->t_custom_field_2}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exp_custom_field_2">Exp Date 2</label>
                                            @if($job->exp_custom_field_2 != $clonedJob->exp_custom_field_2)
                                                <p class="text-danger m-0"><b><del>{{ $job->exp_custom_field_2 ?? '' }}</del></b></p>
                                                <p class="text-success m-0"><b>{{ $clonedJob->exp_custom_field_2 ?? '' }}</b></p>
                                            @else
                                                <p>{{ $job->exp_custom_field_2 ?? '' }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="display: {{ $job->alarm_service=='Yes' ? 'block' : 'none' }}">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loc_custom_field_3">Location 3</label>
                                            @if($job->loc_custom_field_3 != $clonedJob->loc_custom_field_3)
                                                <p class="text-danger m-0"><b><del>{{$job->loc_custom_field_3}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->loc_custom_field_3}}</b></p>
                                            @else
                                                <p>{{$job->loc_custom_field_3}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="t_custom_field_3">Type 3</label>
                                            @if($job->t_custom_field_3 != $clonedJob->t_custom_field_3)
                                                <p class="text-danger m-0"><b><del>{{$job->t_custom_field_3}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->t_custom_field_}}</b></p>
                                            @else
                                                <p>{{$job->t_custom_field_3}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exp_custom_field_3">Exp Date 3</label>
                                            @if($job->exp_custom_field_3 != $clonedJob->exp_custom_field_3)
                                                <p class="text-danger m-0"><b><del>{{ $job->exp_custom_field_3 ?? '' }}</del></b></p>
                                                <p class="text-success m-0"><b>{{ $clonedJob->exp_custom_field_3 ?? '' }}</b></p>
                                            @else
                                                <p>{{ $job->exp_custom_field_3 ?? '' }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="display: {{ $job->alarm_service=='Yes' ? 'block' : 'none' }}">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loc_custom_field_4">Location 4</label>
                                            @if($job->loc_custom_field_4 != $clonedJob->loc_custom_field_4)
                                                <p class="text-danger m-0"><b><del>{{$job->loc_custom_field_4}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->loc_custom_field_4}}</b></p>
                                            @else
                                                <p>{{$job->loc_custom_field_4}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="t_custom_field_4">Type 4</label>
                                            @if($job->t_custom_field_4 != $clonedJob->t_custom_field_4)
                                                <p class="text-danger m-0"><b><del>{{$job->t_custom_field_4}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->t_custom_field_4}}</b></p>
                                            @else
                                                <p>{{$job->t_custom_field_4}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exp_custom_field_4">Exp Date 4</label>
                                            @if($job->exp_custom_field_4 != $clonedJob->exp_custom_field_4)
                                                <p class="text-danger m-0"><b><del>{{ $job->exp_custom_field_4 ?? '' }}</del></b></p>
                                                <p class="text-success m-0"><b>{{ $clonedJob->exp_custom_field_4 ?? '' }}</b></p>
                                            @else
                                                <p>{{ $job->exp_custom_field_4 ?? '' }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="display: {{ $job->alarm_service=='Yes' ? 'block' : 'none' }}">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="service_plan">Service Plan</label>
                                            @if($job->service_plan != $clonedJob->service_plan)
                                                <p class="text-danger m-0"><b><del>{{$job->service_plan}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->service_plan}}</b></p>
                                            @else
                                                <p>{{$job->service_plan}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Does this property have Gas Appliances?</label>
                                            @if($job->has_gas_appliances != $clonedJob->has_gas_appliances)
                                                <p class="text-danger m-0"><b><del>{{$job->has_gas_appliances}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->has_gas_appliances}}</b></p>
                                            @else
                                                <p>{{$job->has_gas_appliances}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="display: {{ $job->has_gas_appliances=='Yes' ? 'block' : 'none' }}">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="loc_has_gas_appliances">Gas Appliances Location 1</label>
                                            @if($job->loc_has_gas_appliances != $clonedJob->loc_has_gas_appliances)
                                                <p class="text-danger m-0"><b><del>{{$job->loc_has_gas_appliances}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->loc_has_gas_appliances}}</b></p>
                                            @else
                                                <p>{{$job->loc_has_gas_appliances}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="t_has_gas_appliances">Gas Appliances Type 1</label>
                                            @if($job->t_has_gas_appliances != $clonedJob->t_has_gas_appliances)
                                                <p class="text-danger m-0"><b><del>{{$job->t_has_gas_appliances}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->t_has_gas_appliances}}</b></p>
                                            @else
                                                <p>{{$job->t_has_gas_appliances}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="loc_has_gas_appliances_1">Gas Appliances Location 2</label>
                                            @if($job->loc_has_gas_appliances_1 != $clonedJob->loc_has_gas_appliances_1)
                                                <p class="text-danger m-0"><b><del>{{$job->loc_has_gas_appliances_1}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->loc_has_gas_appliances_1}}</b></p>
                                            @else
                                                <p>{{$job->loc_has_gas_appliances_1}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="t_has_gas_appliances_1">Gas Appliances Type 2</label>
                                            @if($job->t_has_gas_appliances_1 != $clonedJob->t_has_gas_appliances_1)
                                                <p class="text-danger m-0"><b><del>{{$job->t_has_gas_appliances_1}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->t_has_gas_appliances_1}}</b></p>
                                            @else
                                                <p>{{$job->t_has_gas_appliances_1}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="loc_has_gas_appliances_2">Gas Appliances Location 3</label>
                                            @if($job->loc_has_gas_appliances_2 != $clonedJob->loc_has_gas_appliances_2)
                                                <p class="text-danger m-0"><b><del>{{$job->loc_has_gas_appliances_2}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->loc_has_gas_appliances_2}}</b></p>
                                            @else
                                                <p>{{$job->loc_has_gas_appliances_2}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="t_has_gas_appliances_2">Gas Appliances Type 3</label>
                                            @if($job->t_has_gas_appliances_2 != $clonedJob->t_has_gas_appliances_2)
                                                <p class="text-danger m-0"><b><del>{{$job->t_has_gas_appliances_2}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->t_has_gas_appliances_2}}</b></p>
                                            @else
                                                <p>{{$job->t_has_gas_appliances_2}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="loc_has_gas_appliances_3">Gas Appliances Location 4</label>
                                            @if($job->loc_has_gas_appliances_3 != $clonedJob->loc_has_gas_appliances_3)
                                                <p class="text-danger m-0"><b><del>{{$job->loc_has_gas_appliances_3}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->loc_has_gas_appliances_3}}</b></p>
                                            @else
                                                <p>{{$job->loc_has_gas_appliances_3}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="t_has_gas_appliances_3">Gas Appliances Type 4</label>
                                            @if($job->t_has_gas_appliances_3 != $clonedJob->t_has_gas_appliances_3)
                                                <p class="text-danger m-0"><b><del>{{$job->t_has_gas_appliances_3}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->t_has_gas_appliances_3}}</b></p>
                                            @else
                                                <p>{{$job->t_has_gas_appliances_3}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exp_has_gas_appliances">Gas Appliances Exp Date</label>
                                            @if($job->exp_has_gas_appliances != $clonedJob->exp_has_gas_appliances)
                                                <p class="text-danger m-0"><b><del>{{ $job->exp_has_gas_appliances ?? '' }}</del></b></p>
                                                <p class="text-success m-0"><b>{{ $clonedJob->exp_has_gas_appliances ?? '' }}</b></p>
                                            @else
                                                <p>{{ $job->exp_has_gas_appliances ?? '' }}</p>
                                            @endif
                                        </div>
                                    </div> --}}
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Does this property have Carbon Monoxide Alarm?</label>
                                            @if($job->has_carbon_monoxide != $clonedJob->has_carbon_monoxide)
                                                <p class="text-danger m-0"><b><del>{{$job->has_carbon_monoxide}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->has_carbon_monoxide}}</b></p>
                                            @else
                                                <p>{{$job->has_carbon_monoxide}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="display: {{ $job->has_carbon_monoxide=='Yes' ? 'block' : 'none' }}">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_3">Status</label>
                                            @if($job->status_3 != $clonedJob->status_3 || $job->booked_date_3 != $clonedJob->booked_date_3 || $job->technician_3 != $clonedJob->technician_3)
                                                <p class="text-danger m-0"><b><del>{{$job->status_3}} @if($job->status_3 == 'Booked In') - {{ $job->booked_date_3 != null ? \Carbon\Carbon::parse($job->booked_date_3)->format('d M Y') : '' }} {{ $job->technician_3 ?? '' }} @endif</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->status_3}} @if($clonedJob->status_3 == 'Booked In') - {{ $clonedJob->booked_date_3 != null ? \Carbon\Carbon::parse($clonedJob->booked_date_3)->format('d M Y') : '' }} {{ $clonedJob->technician_3 ?? '' }} @endif</b></p>
                                            @else
                                                <p>{{$job->status_3}} @if($job->status_3 == 'Booked In') - {{ $job->booked_date_3 != null ? \Carbon\Carbon::parse($job->booked_date_3)->format('d M Y') : '' }} {{ $job->technician_3 ?? '' }} @endif</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loc_has_carbon_monoxide_1">Carbon Monoxide Alarm Location 1</label>
                                            @if($job->loc_has_carbon_monoxide_1 != $clonedJob->loc_has_carbon_monoxide_1)
                                                <p class="text-danger m-0"><b><del>{{$job->loc_has_carbon_monoxide_1}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->loc_has_carbon_monoxide_1}}</b></p>
                                            @else
                                                <p>{{$job->loc_has_carbon_monoxide_1}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="t_has_carbon_monoxide_1">Carbon Monoxide Type 1</label>
                                            @if($job->t_has_carbon_monoxide_1 != $clonedJob->t_has_carbon_monoxide_1)
                                                <p class="text-danger m-0"><b><del>{{$job->t_has_carbon_monoxide_1}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->t_has_carbon_monoxide_1}}</b></p>
                                            @else
                                                <p>{{$job->t_has_carbon_monoxide_1}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exp_has_carbon_monoxide_1">Carbon Monoxide Exp Year 1</label>
                                            @if($job->exp_has_carbon_monoxide_1 != $clonedJob->exp_has_carbon_monoxide_1)
                                                <p class="text-danger m-0"><b><del>{{$job->exp_has_carbon_monoxide_1}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->exp_has_carbon_monoxide_1}}</b></p>
                                            @else
                                                <p>{{$job->exp_has_carbon_monoxide_1}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="display: {{ $job->has_carbon_monoxide=='Yes' ? 'block' : 'none' }}">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loc_has_carbon_monoxide_1">Carbon Monoxide Alarm Location 2</label>
                                            @if($job->loc_has_carbon_monoxide_2 != $clonedJob->loc_has_carbon_monoxide_2)
                                                <p class="text-danger m-0"><b><del>{{$job->loc_has_carbon_monoxide_2}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->loc_has_carbon_monoxide_2}}</b></p>
                                            @else
                                                <p>{{$job->loc_has_carbon_monoxide_2}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="t_has_carbon_monoxide_2">Carbon Monoxide Type 2</label>
                                            @if($job->t_has_carbon_monoxide_2 != $clonedJob->t_has_carbon_monoxide_2)
                                                <p class="text-danger m-0"><b><del>{{$job->t_has_carbon_monoxide_2}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->t_has_carbon_monoxide_2}}</b></p>
                                            @else
                                                <p>{{$job->t_has_carbon_monoxide_2}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exp_has_carbon_monoxide_2">Carbon Monoxide Exp Year 2</label>
                                            @if($job->exp_has_carbon_monoxide_2 != $clonedJob->exp_has_carbon_monoxide_2)
                                                <p class="text-danger m-0"><b><del>{{$job->exp_has_carbon_monoxide_2}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->exp_has_carbon_monoxide_2}}</b></p>
                                            @else
                                                <p>{{$job->exp_has_carbon_monoxide_2}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="gas_service">Does GV Smoke Alarm manage the Gas Services?</label>
                                            @if($job->gas_service != $clonedJob->gas_service)
                                                <p class="text-danger m-0"><b><del>{{ $job->gas_service }}</del></b></p>
                                                <p class="text-success m-0"><b>{{ $clonedJob->gas_service }}</b></p>
                                            @else
                                                <p>{{ $job->gas_service }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="display: {{ $job->gas_service=='Yes' ? 'block' : 'none' }}">
                                    <div class="col-md-4" id="gas_date" >
                                        <div class="form-group">
                                            <label for="last_gas_service">Last Gas Service Date</label>
                                            @if($job->last_gas_service != $clonedJob->last_gas_service)
                                                <p class="text-danger m-0"><b><del>{{ $job->last_gas_service != null ? \Carbon\Carbon::parse($job->last_gas_service)->format('d-m-Y') : '' }}</del></b></p>
                                                <p class="text-success m-0"><b>{{ $clonedJob->last_gas_service != null ? \Carbon\Carbon::parse($clonedJob->last_gas_service)->format('d-m-Y') : '' }}</b></p>
                                            @else
                                                <p>{{ $job->last_gas_service != null ? \Carbon\Carbon::parse($job->last_gas_service)->format('d-m-Y') : '' }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="service_year_1">Service Year</label>
                                            @if($job->service_year_1 != $clonedJob->service_year_1)
                                                <p class="text-danger m-0"><b><del>{{$job->service_year_1}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->service_year_1}}</b></p>
                                            @else
                                                <p>{{$job->service_year_1}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_1">Status</label>
                                            @if($job->status_1 != $clonedJob->status_1 || $job->booked_date_1 != $clonedJob->booked_date_1 || $job->technician_1 != $clonedJob->technician_1)
                                                <p class="text-danger m-0"><b><del>{{$job->status_1}} @if($job->status_1 == 'Booked In') - {{ $job->booked_date_1 != null ? \Carbon\Carbon::parse($job->booked_date_1)->format('d M Y') : '' }} {{ $job->technician_1 ?? '' }} @endif</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->status_1}} @if($clonedJob->status_1 == 'Booked In') - {{ $clonedJob->booked_date_1 != null ? \Carbon\Carbon::parse($clonedJob->booked_date_1)->format('d M Y') : '' }} {{ $clonedJob->technician_1 ?? '' }} @endif</b></p>
                                            @else
                                                <p>{{$job->status_1}} @if($job->status_1 == 'Booked In') - {{ $job->booked_date_1 != null ? \Carbon\Carbon::parse($job->booked_date_1)->format('d M Y') : '' }} {{ $job->technician_1 ?? '' }} @endif</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="elec_service">Does GV Smoke Alarm manage the Electrical Safety?</label>
                                            @if($job->elec_service != $clonedJob->elec_service)
                                                <p class="text-danger m-0"><b><del>{{ $job->elec_service }}</del></b></p>
                                                <p class="text-success m-0"><b>{{ $clonedJob->elec_service }}</b></p>
                                            @else
                                                <p>{{ $job->elec_service }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="display: {{ $job->elec_service=='Yes' ? 'block' : 'none' }}">
                                    <div class="col-md-4" id="elec_date">
                                        <div class="form-group">
                                            <label for="last_elec_service">Last Elec Service Date</label>
                                            @if($job->last_elec_service != $clonedJob->last_elec_service)
                                                <p class="text-danger m-0"><b><del>{{ $job->last_elec_service != null ? \Carbon\Carbon::parse($job->last_elec_service)->format('d-m-Y') : '' }}</del></b></p>
                                                <p class="text-success m-0"><b>{{ $clonedJob->last_elec_service != null ? \Carbon\Carbon::parse($clonedJob->last_elec_service)->format('d-m-Y') : '' }}</b></p>
                                            @else
                                                <p>{{ $job->last_elec_service != null ? \Carbon\Carbon::parse($job->last_elec_service)->format('d-m-Y') : '' }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="service_year_2">Service Year</label>
                                            @if($job->service_year_2 != $clonedJob->service_year_2)
                                                <p class="text-danger m-0"><b><del>{{$job->service_year_2}}</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->service_year_2}}</b></p>
                                            @else
                                                <p>{{$job->service_year_2}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status_2">Status</label>
                                            @if($job->status_2 != $clonedJob->status_2 || $job->booked_date_2 != $clonedJob->booked_date_2 || $job->technician_2 != $clonedJob->technician_2)
                                                <p class="text-danger m-0"><b><del>{{$job->status_2}} @if($job->status_2 == 'Booked In') - {{ $job->booked_date_2 != null ? \Carbon\Carbon::parse($job->booked_date_2)->format('d M Y') : '' }} {{ $job->technician_2 ?? '' }} @endif</del></b></p>
                                                <p class="text-success m-0"><b>{{$clonedJob->status_2}} @if($clonedJob->status_2 == 'Booked In') - {{ $clonedJob->booked_date_2 != null ? \Carbon\Carbon::parse($clonedJob->booked_date_2)->format('d M Y') : '' }} {{ $clonedJob->technician_2 ?? '' }} @endif</b></p>
                                            @else
                                                <p>{{$job->status_2}} @if($job->status_2 == 'Booked In') - {{ $job->booked_date_2 != null ? \Carbon\Carbon::parse($job->booked_date_2)->format('d M Y') : '' }} {{ $job->technician_2 ?? '' }} @endif</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>



                                <a href="{{ route('jobPostDecline', ['id' => $job->id]) }}" class="btn btn-sm btn-danger pull-left m-5">Decline</a>
                                <a href="{{ route('jobPostApprove', ['id' => $job->id]) }}" class="btn btn-sm btn-primary pull-right m-5">Approve</a>
                                <a href="{{ route('jobPreviewEditChanges', ['id' => $job->id]) }}" class="btn btn-sm btn-primary pull-right m-5">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
@endpush
