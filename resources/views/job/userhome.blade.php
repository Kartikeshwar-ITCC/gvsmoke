@extends('layouts.app')

@push('styles')
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-tabletools/css/dataTables.tableTools.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-colvis/css/dataTables.colVis.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.css" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-scroller/css/scroller.dataTables.scss') }}" rel="stylesheet">
    <style type="text/css">
        ul.ColVis_collection{
            width: 200px;
        }
    </style>
@endpush


@section('content')

    <!--page title and breadcrumb start -->
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title">
                @if(request()->route()->getName() == 'job') Job Lists @endif
                @if(request()->route()->getName() == 'jobPending') Pending Jobs @endif
                @if(request()->route()->getName() == 'jobDeleted') Deleted Jobs @endif

                <small></small>
            </h1>
        </div>
        <div class="col-md-4">
            <ul class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="javascript:void(0)" class="active">
                @if(request()->route()->getName() == 'job') Job Lists @endif
                @if(request()->route()->getName() == 'jobPending') Pending Jobs @endif
                @if(request()->route()->getName() == 'jobDeleted') Deleted Jobs @endif
                </a></li>
            </ul>
        </div>
    </div>
    <!--page title and breadcrumb end -->

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading panel-border"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                    &nbsp;
                    <button class="btn btn-default btn-sm text-center font-bold" id="kt_reset">
                        <span>
                            <i class="la la-search"></i>
                            <span>Show All</span>
                        </span>
                    </button>
                    <button class="btn btn-default bg-green btn-sm kt_search text-center font-bold" value="Completed">
                        <span>
                            <i class="la la-search"></i>
                            <span>Completed</span>
                        </span>
                    </button>
                    <button class="btn btn-default bg-orange btn-sm kt_search text-center font-bold" value="Quoted">
                        <span>
                            <i class="la la-search"></i>
                            <span>Quoted</span>
                        </span>
                    </button>
                    <button class="btn btn-default bg-blue btn-sm kt_search text-center font-bold" value="Booked In">
                        <span>
                            <i class="la la-search"></i>
                            <span>Booked In</span>
                        </span>
                    </button>
                    <button class="btn btn-default bg-red btn-sm kt_search text-center font-bold" value="Overdue">
                        <span>
                            <i class="la la-search"></i>
                            <span>Overdue</span>
                        </span>
                    </button>
                    <button class="btn btn-default bg-purple btn-sm kt_search text-center font-bold" value="On Hold">
                        <span>
                            <i class="la la-search"></i>
                            <span>On Hold</span>
                        </span>
                    </button>
                    <button class="btn btn-default bg-pink btn-sm kt_search text-center font-bold" value="Postponed">
                        <span>
                            <i class="la la-search"></i>
                            <span>Postponed</span>
                        </span>
                    </button>
                    <button class="btn btn-default bg-yellow btn-sm kt_search text-center font-bold" value="New">
                        <span>
                            <i class="la la-search"></i>
                            <span>New</span>
                        </span>
                    </button>
                    <span class="pull-right">
                        @if(request()->route()->getName() == 'job')
                        <a href="{{ route('jobAdd') }}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Add New Job</a>
                        @endif
                    </span>
                </header>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="table table-responsive">
            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                <table class="table colvis-responsive-data-table table-striped dataTable table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th> Actions </th>
                            <th> Property Manager</th>
                            <th> Landlord </th>
                            <th> Landlord Contact</th>
                            <th> Landlord Email </th>
                            <th> No. </th>
                            <th> Street </th>
                            <th> Suburb </th>
                            <th> State </th>
                            <th> Postal Code </th>
                            <th> Country </th>
                            <th> Area Location </th>
                            <th> Key </th>
                            <th> Tenant </th>
                            <th> Contact Details </th>
                            <th> Tenant Email </th>
                            <th> Tenant 1 </th>
                            <th> Contact Details 1 </th>
                            <th> Tenant Email 1 </th>
                            <th> Last Alarm Service </th>
                            <th> Alarm Service </th>
                            <th> Smoke Alarm Status </th>
                            <th> Alarm Booked Date </th>
                            <th> Smoke Alarm Tech. </th>
                            <th> Alarm Location 1 </th>
                            <th> Alarm Type 1 </th>
                            <th> Alarm Exp Year 1 </th>
                            <th> Alarm Location 2 </th>
                            <th> Alarm Type 2 </th>
                            <th> Alarm Exp Year 2 </th>
                            <th> Alarm Location 3 </th>
                            <th> Alarm Type 3 </th>
                            <th> Alarm Exp Year 3 </th>
                            <th> Alarm Location 4 </th>
                            <th> Alarm Type 4 </th>
                            <th> Alarm Exp Year 4 </th>
                            <th> Service Plan </th>
                            <th> Last Gas Service </th>
                            <th> Gas Service </th>
                            <th> Gas Status </th>
                            <th> Gas Booked Date </th>
                            <th> Gas Tech. </th>
                            <th> Last Elec Service </th>
                            <th> Elec Service </th>
                            <th> Elec Status </th>
                            <th> Elec Booked Date </th>
                            <th> Elec Tech. </th>
                            <th> Has Gas Appliances? </th>
                            <th> Gas Appliances Location 1 </th>
                            <th> Gas Appliances Type 1 </th>
                            <th> Gas Appliances Location 2 </th>
                            <th> Gas Appliances Type 2 </th>
                            <th> Gas Appliances Location 3 </th>
                            <th> Gas Appliances Type 3 </th>
                            <th> Gas Appliances Location 4 </th>
                            <th> Gas Appliances Type 4 </th>
                            <th> Has Carbon Monoxide? </th>
                            <th> Co. Status </th>
                            <th> Co. Booked Date </th>
                            <th> Co. Tech. </th>
                            <th> Carbon Monoxide Location 1 </th>
                            <th> Carbon Monoxide Type 1 </th>
                            <th> Carbon Monoxide Exp Year 1 </th>
                            <th> Carbon Monoxide Location 2 </th>
                            <th> Carbon Monoxide Type 2 </th>
                            <th> Carbon Monoxide Exp Year 2 </th>
                            <th> Comments </th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($clonedJobs)
                        @foreach($clonedJobs as $job)
                        <tr>
                            <td>
                                <a href="{{ route('jobEdit', ['id' => $job->job_id]) }}" class="btn btn-primary btn_inline">View</a>
                            </td>
                            <td> {{ $job->property_manager_name }} </td>
                            <td> {{ $job->landlord }} </td>
                            <td> {{ $job->landlord_contact }} </td>
                            <td> {{ $job->landlord_email }} </td>
                            <td> <p class="m-0" data-toggle="tooltip" data-placement="top" title="{{$job->address_line_1}}">{{ Illuminate\Support\Str::limit($job->address_line_1, 20) }}</p> </td>
                            <td> <p class="m-0" data-toggle="tooltip" data-placement="top" title="{{$job->address_line_2}}">{{ Illuminate\Support\Str::limit($job->address_line_2, 20) }}</p> </td>
                            <td> {{ $job->city }} </td>
                            <td> {{ $job->state }} </td>
                            <td> {{ $job->postal_code }} </td>
                            <td> {{ $job->country }} </td>
                            <td> {{ $job->location_area }} </td>
                            <td> {{ $job->key }} </td>
                            <td> <p class="m-0" data-toggle="tooltip" data-placement="top" title="{{$job->tenant}}">{{ Illuminate\Support\Str::limit($job->tenant, 15) }} </p></td>
                            <td> {{ $job->contact_details }} </td>
                            <td> {{ $job->tenant_email }} </td>
                            <td> <p class="m-0" data-toggle="tooltip" data-placement="top" title="{{$job->tenant_1}}">{{ Illuminate\Support\Str::limit($job->tenant_1, 15) }} </p></td>
                            <td> {{ $job->contact_details_1 }} </td>
                            <td> {{ $job->tenant_email_1 }} </td>
                            <td> {{ $job->last_alarm_service != '' ? \Carbon\Carbon::parse($job->last_alarm_service)->format('d M Y') : '' }} </td>
                            <td class="{{ $job->service_month == 'NA' ? 'bg-red' : '' }}">{{ $job->service_month }}</td>
                            <td class="text-center font-bold {{ $job->status == 'Completed' ? 'bg-green' : '' }} {{ $job->status == 'Quoted' ? 'bg-orange' : '' }} {{ $job->status == 'New' ? 'bg-yellow' : '' }} {{ $job->status == 'Booked In' ? 'bg-blue' : '' }} {{ $job->status == 'Overdue' ? 'bg-red' : '' }} {{ $job->status == 'On Hold' ? 'bg-purple' : '' }} {{ $job->status == 'Postponed' ? 'bg-pink' : '' }}">{{ $job->status }}</span> @if($job->status == 'Booked In')<br>{{ $job->booked_date != null ? \Carbon\Carbon::parse($job->booked_date)->format('d M Y') : '' }}@endif </td>
                            <td> {{ $job->booked_date }} </td>
                            <td> {{ $job->technician }} </td>
                            <td> {{ $job->loc_custom_field_1 }} </td>
                            <td> {{ $job->t_custom_field_1 }} </td>
                            <td> {{ $job->exp_custom_field_1 ?? ''}} </td>
                            <td> {{ $job->loc_custom_field_2 }} </td>
                            <td> {{ $job->t_custom_field_2 }} </td>
                            <td> {{ $job->exp_custom_field_2 ?? ''}} </td>
                            <td> {{ $job->loc_custom_field_3 }} </td>
                            <td> {{ $job->t_custom_field_3 }} </td>
                            <td> {{ $job->exp_custom_field_3 ?? ''}} </td>
                            <td> {{ $job->loc_custom_field_4 }} </td>
                            <td> {{ $job->t_custom_field_4 }} </td>
                            <td> {{ $job->exp_custom_field_4 ?? ''}} </td>
                            <td> {{ $job->service_plan }} </td>
                            <td> {{ $job->last_gas_service != '' ? \Carbon\Carbon::parse($job->last_gas_service)->format('d M Y') : '' }} </td>
                            <td> {{ $job->service_year_1 }} </td>
                            <td class="text-center font-bold {{ $job->status_1 == 'Completed' ? 'bg-green' : '' }} {{ $job->status_1 == 'Quoted' ? 'bg-orange' : '' }} {{ $job->status_1 == 'New' ? 'bg-yellow' : '' }} {{ $job->status_1 == 'Booked In' ? 'bg-blue' : '' }} {{ $job->status_1 == 'Overdue' ? 'bg-red' : '' }} {{ $job->status_1 == 'On Hold' ? 'bg-purple' : '' }} {{ $job->status_1 == 'Postponed' ? 'bg-pink' : '' }}">{{ $job->status_1 }}</span> @if($job->status_1 == 'Booked In')<br>{{ $job->booked_date_1 != null ? \Carbon\Carbon::parse($job->booked_date_1)->format('d M Y') : '' }}@endif </td>
                            <td> {{ $job->booked_date_1 }} </td>
                            <td> {{ $job->technician_1 }} </td>
                            <td> {{ $job->last_elec_service != '' ? \Carbon\Carbon::parse($job->last_elec_service)->format('d M Y') : '' }} </td>
                            <td> {{ $job->service_year_2 }} </td>
                            <td class="text-center font-bold {{ $job->status_2 == 'Completed' ? 'bg-green' : '' }} {{ $job->status_2 == 'Quoted' ? 'bg-orange' : '' }} {{ $job->status_2 == 'New' ? 'bg-yellow' : '' }} {{ $job->status_2 == 'Booked In' ? 'bg-blue' : '' }} {{ $job->status_2 == 'Overdue' ? 'bg-red' : '' }} {{ $job->status_2 == 'On Hold' ? 'bg-purple' : '' }} {{ $job->status_2 == 'Postponed' ? 'bg-pink' : '' }}">{{ $job->status_2 }}</span> @if($job->status_2 == 'Booked In')<br>{{ $job->booked_date_2 != null ? \Carbon\Carbon::parse($job->booked_date_2)->format('d M Y') : '' }}@endif </td>
                            <td> {{ $job->booked_date_2 }} </td>
                            <td> {{ $job->technician_2 }} </td>
                            <td> {{ $job->has_gas_appliances }} </td>
                            <td> {{ $job->loc_has_gas_appliances }} </td>
                            <td> {{ $job->t_has_gas_appliances }} </td>
                            <td> {{ $job->loc_has_gas_appliances_1 }} </td>
                            <td> {{ $job->t_has_gas_appliances_1 }} </td>
                            <td> {{ $job->loc_has_gas_appliances_2 }} </td>
                            <td> {{ $job->t_has_gas_appliances_2 }} </td>
                            <td> {{ $job->loc_has_gas_appliances_3 }} </td>
                            <td> {{ $job->t_has_gas_appliances_3 }} </td>
                            <td> {{ $job->has_carbon_monoxide }} </td>
                            <td> {{ $job->status_3 }} </td>
                            <td> {{ $job->booked_date_3 }} </td>
                            <td> {{ $job->technician_3 }} </td>
                            <td> {{ $job->loc_has_carbon_monoxide_1 }} </td>
                            <td> {{ $job->t_has_carbon_monoxide_1 }} </td>
                            <td> {{ $job->exp_has_carbon_monoxide_1 }} </td>
                            <td> {{ $job->loc_has_carbon_monoxide_2 }} </td>
                            <td> {{ $job->t_has_carbon_monoxide_2 }} </td>
                            <td> {{ $job->exp_has_carbon_monoxide_2 }} </td>
                            <td> {{ $job->comments }} </td>
                        </tr>
                        @endforeach
                        @endisset
                        @foreach($jobs as $job)
                        <tr>
                            <td>
                                <a href="{{ route('jobEdit', ['id' => $job->id]) }}" class="btn btn-primary btn_inline">View</a>
                            </td>
                            <td> {{ $job->property_manager_name }} </td>
                            <td> {{ $job->landlord }} </td>
                            <td> {{ $job->landlord_contact }} </td>
                            <td> {{ $job->landlord_email }} </td>
                            <td> <p class="m-0" data-toggle="tooltip" data-placement="top" title="{{$job->address_line_1}}">{{ Illuminate\Support\Str::limit($job->address_line_1, 20) }}</p> </td>
                            <td> <p class="m-0" data-toggle="tooltip" data-placement="top" title="{{$job->address_line_2}}">{{ Illuminate\Support\Str::limit($job->address_line_2, 20) }}</p> </td>
                            <td> {{ $job->city }} </td>
                            <td> {{ $job->state }} </td>
                            <td> {{ $job->postal_code }} </td>
                            <td> {{ $job->country }} </td>
                            <td> {{ $job->location_area }} </td>
                            <td> {{ $job->key }} </td>
                            <td> <p class="m-0" data-toggle="tooltip" data-placement="top" title="{{$job->tenant}}">{{ Illuminate\Support\Str::limit($job->tenant, 15) }} </p></td>
                            <td> {{ $job->contact_details }} </td>
                            <td> {{ $job->tenant_email }} </td>
                            <td> <p class="m-0" data-toggle="tooltip" data-placement="top" title="{{$job->tenant_1}}">{{ Illuminate\Support\Str::limit($job->tenant_1, 15) }} </p></td>
                            <td> {{ $job->contact_details_1 }} </td>
                            <td> {{ $job->tenant_email_1 }} </td>
                            <td> {{ $job->last_alarm_service != '' ? \Carbon\Carbon::parse($job->last_alarm_service)->format('d M Y') : '' }} </td>
                            <td class="{{ $job->service_month == 'NA' ? 'bg-red' : '' }}">{{ $job->service_month }}</td>
                            @if( $job->alarm_service == 'No')
                                <td class="text-center"> </td>
                            @else
                                <td class="text-center font-bold {{ $job->status == 'Completed' ? 'bg-green' : '' }} {{ $job->status == 'Quoted' ? 'bg-orange' : '' }} {{ $job->status == 'New' ? 'bg-yellow' : '' }} {{ $job->status == 'Booked In' ? 'bg-blue' : '' }} {{ $job->status == 'Overdue' ? 'bg-red' : '' }} {{ $job->status == 'On Hold' ? 'bg-purple' : '' }} {{ $job->status == 'Postponed' ? 'bg-pink' : '' }} ">{{ $job->status }}</span> @if($job->status == 'Booked In')<br>{{ $job->booked_date != null ? \Carbon\Carbon::parse($job->booked_date)->format('d M Y') : '' }}@endif </td>
                            @endif
                            <td> {{ $job->booked_date }} </td>
                            <td> {{ $job->technician }} </td>
                            <td> {{ $job->loc_custom_field_1 }} </td>
                            <td> {{ $job->t_custom_field_1 }} </td>
                            <td> {{ $job->exp_custom_field_1 ?? ''}} </td>
                            <td> {{ $job->loc_custom_field_2 }} </td>
                            <td> {{ $job->t_custom_field_2 }} </td>
                            <td> {{ $job->exp_custom_field_2 ?? ''}} </td>
                            <td> {{ $job->loc_custom_field_3 }} </td>
                            <td> {{ $job->t_custom_field_3 }} </td>
                            <td> {{ $job->exp_custom_field_3 ?? ''}} </td>
                            <td> {{ $job->loc_custom_field_4 }} </td>
                            <td> {{ $job->t_custom_field_4 }} </td>
                            <td> {{ $job->exp_custom_field_4 ?? ''}} </td>
                            <td> {{ $job->service_plan }} </td>
                            <td> {{ $job->last_gas_service != '' ? \Carbon\Carbon::parse($job->last_gas_service)->format('d M Y') : '' }} </td>
                            <td> {{ $job->service_year_1 }} </td>
                            @if($job->has_gas_appliences == 'No' || $job->has_gas_appliances == 'Unsure')
                                <td class="text-center"> </td>
                            @else
                                <td class="text-center font-bold {{ $job->status_1 == 'Completed' ? 'bg-green' : '' }} {{ $job->status_1 == 'Quoted' ? 'bg-orange' : '' }} {{ $job->status_1 == 'New' ? 'bg-yellow' : '' }} {{ $job->status_1 == 'Booked In' ? 'bg-blue' : '' }} {{ $job->status_1 == 'Overdue' ? 'bg-red' : '' }} {{ $job->status_1 == 'On Hold' ? 'bg-purple' : '' }} {{ $job->status_1 == 'Postponed' ? 'bg-pink' : '' }}">{{ $job->status_1 }}</span> @if($job->status_1 == 'Booked In')<br>{{ $job->booked_date_1 != null ? \Carbon\Carbon::parse($job->booked_date_1)->format('d M Y') : '' }}@endif </td>
                            @endif
                            <td> {{ $job->booked_date_1 }} </td>
                            <td> {{ $job->technician_1 }} </td>
                            <td> {{ $job->last_elec_service != '' ? \Carbon\Carbon::parse($job->last_elec_service)->format('d M Y') : '' }} </td>
                            <td> {{ $job->service_year_2 }} </td>
                            @if($job->elec_service == 'No' || $job->elec_service == 'Unsure')
                                <td class="text-center"> </td>
                            @else
                                <td class="text-center font-bold {{ $job->status_2 == 'Completed' ? 'bg-green' : '' }} {{ $job->status_2 == 'Quoted' ? 'bg-orange' : '' }} {{ $job->status_2 == 'New' ? 'bg-yellow' : '' }} {{ $job->status_2 == 'Booked In' ? 'bg-blue' : '' }} {{ $job->status_2 == 'Overdue' ? 'bg-red' : '' }} {{ $job->status_2 == 'On Hold' ? 'bg-purple' : '' }} {{ $job->status_2 == 'Postponed' ? 'bg-pink' : '' }}">{{ $job->status_2 }}</span> @if($job->status_2 == 'Booked In')<br>{{ $job->booked_date_2 != null ? \Carbon\Carbon::parse($job->booked_date_2)->format('d M Y') : '' }}@endif </td>
                            @endif
                            <td> {{ $job->booked_date_2 }} </td>
                            <td> {{ $job->technician_2 }} </td>
                            <td> {{ $job->has_gas_appliances }} </td>
                            <td> {{ $job->loc_has_gas_appliances }} </td>
                            <td> {{ $job->t_has_gas_appliances }} </td>
                            <td> {{ $job->loc_has_gas_appliances_1 }} </td>
                            <td> {{ $job->t_has_gas_appliances_1 }} </td>
                            <td> {{ $job->loc_has_gas_appliances_2 }} </td>
                            <td> {{ $job->t_has_gas_appliances_2 }} </td>
                            <td> {{ $job->loc_has_gas_appliances_3 }} </td>
                            <td> {{ $job->t_has_gas_appliances_3 }} </td>
                            <td> {{ $job->has_carbon_monoxide }} </td>
                             @if($job->has_carbon_monoxide == 'No' || $job->has_carbon_monoxide == 'Unsure')
                                <td class="text-center"> </td>
                            @else
                                <td class="text-center font-bold {{ $job->status_3 == 'Completed' ? 'bg-green' : '' }} {{ $job->status_3 == 'Quoted' ? 'bg-orange' : '' }} {{ $job->status_3 == 'New' ? 'bg-yellow' : '' }} {{ $job->status_3 == 'Booked In' ? 'bg-blue' : '' }} {{ $job->status_3 == 'Overdue' ? 'bg-red' : '' }} {{ $job->status_3 == 'On Hold' ? 'bg-purple' : '' }} {{ $job->status_3 == 'Postponed' ? 'bg-pink' : '' }}"> {{ $job->status_3 }} </span> @if($job->status_3 == 'Booked In')<br>{{ $job->booked_date_3 != null ? \Carbon\Carbon::parse($job->booked_date_3)->format('d M Y') : '' }}@endif </td>
                            @endif
                            <td> {{ $job->booked_date_3 }} </td>
                            <td> {{ $job->technician_3 }} </td>
                            <td> {{ $job->loc_has_carbon_monoxide_1 }} </td>
                            <td> {{ $job->t_has_carbon_monoxide_1 }} </td>
                            <td> {{ $job->exp_has_carbon_monoxide_1 }} </td>
                            <td> {{ $job->loc_has_carbon_monoxide_2 }} </td>
                            <td> {{ $job->t_has_carbon_monoxide_2 }} </td>
                            <td> {{ $job->exp_has_carbon_monoxide_2 }} </td>
                            <td> {{ $job->comments }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

<script>
    window._table_targets = [2,3,4,8,9,10,11,15,16,17,18,19,20,22,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,40,42,43,45,47,48,49,50,51,52,53,54,55,56,58,60,61,62,63,64,65,66];
</script>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('bower_components/datatables-tabletools/js/dataTables.tableTools.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.js"></script>
<script src="{{ asset('bower_components/datatables-colvis/js/dataTables.colVis.js') }}"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
<script src="{{ asset('bower_components/datatables-scroller/js/dataTables.scroller.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
{{-- <script src="{{ asset('dist/js/init-datatables.js') }}"></script> --}}
<script>

var KTDatatablesSearchOptionsAdvancedSearch = function() {

    var initTable1 = function() {
        // begin first table
        var table = $('#kt_table_1').DataTable({
            responsive: false,
            // Pagination settings
            dom: `<<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'BCf>>
            <<'col-sm-12't>>
            <<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'p>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html
            buttons: [
                {
                    extend: 'print',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    exportOptions: {
                        columns: ':visible'
                    },
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' );

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    }
                }
            ],
            language: {
                'lengthMenu': 'Display _MENU_',
            },
            lengthMenu: [5, 10, 50, 100, 500, 1000],
            pageLength: 50,
            bServerSide:false,
            searchDelay: 1000,
            processing: false,
            aaSorting: [],
            serverSide: false,
            cache:false,
            columnDefs: [{
                targets: window._table_targets,
                visible: false,
            },{
                    targets: 30,
                    orderable: false,
                    sortable: false,
                    selector: false,
                    width:'4%',
            }],
        });

        var filter = function() {
            var val = $.fn.dataTable.util.escapeRegex($(this).val());
            table.column($(this).data('col-index')).search(val ? val : '', false, false).draw();
        };

        var asdasd = function(value, index) {
            var val = $.fn.dataTable.util.escapeRegex(value);
            table.column(index).search(val ? val : '', false, true);
        };

        $('.kt_search').on('click', function(e) {
            e.preventDefault();
            let status = $(this).attr('value');
            table.column([21, 39, 44, 57]).search(status, false, false);
            table.table().draw();

        });

        $('#kt_reset').on('click', function(e) {
            e.preventDefault();
            table.column([21, 39, 44, 57]).search('', false, false);
            table.table().draw();
        });

    };

    return {

        //main function to initiate the module
        init: function() {
            initTable1();
        },

    };

}();

jQuery(document).ready(function() {
    KTDatatablesSearchOptionsAdvancedSearch.init();
});
</script>
@endpush
