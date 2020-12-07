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
                @if(request()->route()->getName() == 'jobPending') Pending Jobs @endif
                <small></small>
            </h1>
        </div>
        <div class="col-md-4">
            <ul class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="javascript:void(0)" class="active">
                @if(request()->route()->getName() == 'jobPending') Pending Jobs @endif
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
                </header>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" id="kt_table_1">
                        <thead>
                            <tr>
                            <th> Agency Name </th>
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
                            <th> Alarm Status </th>
                            <th> Alarm Booked Date </th>
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
                            <th> Last Elec Service </th>
                            <th> Elec Service </th>
                            <th> Elec Status </th>
                            <th> Elec Booked Date </th>
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
                            <th> Carbon Monoxide Location 1 </th>
                            <th> Carbon Monoxide Type 1 </th>
                            <th> Carbon Monoxide Exp Year 1 </th>
                            <th> Carbon Monoxide Location 2 </th>
                            <th> Carbon Monoxide Type 2 </th>
                            <th> Carbon Monoxide Exp Year 2 </th>
                            <th> Comments </th>
                            <th> Co. Alarm Status</th>
                            <th> Co. Alarm Booked Date</th>
                            <th> Smoke Alarm Tech. </th>
                            <th> Elec Tech.</th>
                            <th> Gas Tech. </th>
                            <th> Co Alarm Tech. </th>
                            <th> Actions </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </section>
        </div>
    </div>

@endsection


@push('scripts')

<script>
    // window._table_targets = [ 1,2,3,4,9,11,12,15,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38 ];
    window._table_targets = [1,2,3,4,9,10,11,15,16,17,18,19,20,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,39,40,41,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,62,63,64,65,66];
</script>


<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('bower_components/datatables-tabletools/js/dataTables.tableTools.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.js"></script>
<script src="{{ asset('bower_components/datatables-colvis/js/dataTables.colVis.js') }}"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
<script src="{{ asset('bower_components/datatables-scroller/js/dataTables.scroller.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script>

var KTDatatablesSearchOptionsAdvancedSearch = function() {

    $.fn.dataTable.Api.register('column().title()', function() {
        return $(this.header()).text().trim();
    });

    var initTable1 = function() {
        // begin first table
        var table = $('#kt_table_1').DataTable({
            responsive: true,
            // Pagination settings
            dom: `<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'BCf>>
            <'row'<'col-sm-12't>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'p>>`,
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
            bServerSide:true,

            searchDelay: 1000,
            processing: false,
            aaSorting: [],
            serverSide: true,
            cache:false,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('postPendingIndex') }}',
                type: 'POST',
                dataSrc: 'jobs',
            },
            columns: [
                {data: 'agency.name'},
                {data: 'property_manager_name'},
                {data: 'landlord'},
                {data: 'landlord_contact'},
                {data: 'landlord_email'},
                {data: 'address_line_1'},
                {data: 'address_line_2'},
                {data: 'city'},
                {data: 'state'},
                {data: 'postal_code'},
                {data: 'country'},
                {data: 'location_area'},
                {data: 'key'},
                {data: 'tenant'},
                {data: 'contact_details'},
                {data: 'tenant_email'},
                {data: 'tenant_1'},
                {data: 'contact_details_1'},
                {data: 'tenant_email_1'},
                {data: 'last_alarm_service'},
                {data: 'service_month'},
                {data: 'status'},
                {data: 'booked_date'},
                {data: 'loc_custom_field_1'},
                {data: 't_custom_field_1'},
                {data: 'exp_custom_field_1'},
                {data: 'loc_custom_field_2'},
                {data: 't_custom_field_2'},
                {data: 'exp_custom_field_2'},
                {data: 'loc_custom_field_3'},
                {data: 't_custom_field_3'},
                {data: 'exp_custom_field_3'},
                {data: 'loc_custom_field_4'},
                {data: 't_custom_field_4'},
                {data: 'exp_custom_field_4'},
                {data: 'service_plan'},
                {data: 'last_gas_service'},
                {data: 'service_year_1'},
                {data: 'status_1'},
                {data: 'booked_date_1'},
                {data: 'last_elec_service'},
                {data: 'service_year_2'},
                {data: 'status_2'},
                {data: 'booked_date_2'},
                {data: 'has_gas_appliances'},
                {data: 'loc_has_gas_appliances'},
                {data: 't_has_gas_appliances'},
                {data: 'loc_has_gas_appliances_1'},
                {data: 't_has_gas_appliances_1'},
                {data: 'loc_has_gas_appliances_2'},
                {data: 't_has_gas_appliances_2'},
                {data: 'loc_has_gas_appliances_3'},
                {data: 't_has_gas_appliances_3'},
                {data: 'has_carbon_monoxide'},
                {data: 'loc_has_carbon_monoxide_1'},
                {data: 't_has_carbon_monoxide_1'},
                {data: 'exp_has_carbon_monoxide_1'},
                {data: 'loc_has_carbon_monoxide_2'},
                {data: 't_has_carbon_monoxide_2'},
                {data: 'exp_has_carbon_monoxide_2'},
                {data: 'comments'},
                {data: 'status_3'},
                {data: 'booked_date_3'},
                {data: 'technician'},
                {data: 'technician_1'},
                {data: 'technician_2'},
                {data: 'technician_3'},
                {data: 'id'},
            ],

            columnDefs: [
                {
                    targets: window._table_targets,
                    visible: false,
                },
                {
                    targets: 67,
                    title: 'Actions',
                    orderable: false,
                    sortable: false,
                    selector: false,
                    render: function(data, type, full, meta) {
                        return `<a href="preview/`+full.job_id+`" class="btn btn-primary btn_inline">View</a>`;
                    },
                },
                {
                    targets: 1,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.property_manager_name){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.property_manager_name+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 2,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.landlord){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.landlord+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 3,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.landlord_contact){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.landlord_contact+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 4,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.landlord_email){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.landlord_email+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 5,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.address_line_1){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.address_line_1+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 6,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.address_line_2){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.address_line_2+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 7,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.city){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.city+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 8,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.state){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.state+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 9,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.postal_code){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.postal_code+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 10,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.country){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.country+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 12,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.key){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.key+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 11,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.location_area){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.location_area+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 20,
                    render: function(data, type, full, meta) {
                        var status = {
                            'NA' : {'title': 'NA', 'class': 'bg-red'},
                            'January' : {'title': 'January', 'class': ''},
                            'February' : {'title': 'February', 'class': ''},
                            'March' : {'title': 'March', 'class': ''},
                            'April' : {'title': 'April', 'class': ''},
                            'May' : {'title': 'May', 'class': ''},
                            'June' : {'title': 'June', 'class': ''},
                            'July' : {'title': 'July', 'class': ''},
                            'August' : {'title': 'August', 'class': ''},
                            'September' : {'title': 'September', 'class': ''},
                            'October' : {'title': 'October', 'class': ''},
                            'November' : {'title': 'November', 'class': ''},
                            'December' : {'title': 'December', 'class': ''},
                        };
                        if(data == null && full.original_job.service_month == null){
                            return '';
                        }else if(data == null){
                            return '<p class="text-danger m-0"><del>'+status[full.original_job.service_month].title+'<del></p><p class="text-success m-0"></p>';
                        }else if(full.original_job.service_month == null){
                            return '<p class="text-danger m-0"><del><del></p><p class="text-success m-0">'+status[data].title+'</p>';
                        }else if(data == full.original_job.service_month){
                            return status[data].title;
                        }else{
                            return '<p class="text-danger m-0"><del>'+status[full.original_job.service_month].title+'<del></p><p class="text-success m-0">'+status[data].title+'</p>';
                        }
                    }
                },
                {
                    targets: 37,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.service_year_1){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.service_year_1+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 41,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.service_year_2){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.service_year_2+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 13,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.tenant){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.tenant+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 16,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.tenant_1){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.tenant_1+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 14,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.contact_details){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.contact_details+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 17,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.contact_details_1){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.contact_details_1+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 21,
                    render: function(data, type, full, meta) {
                        var status = {
                            'Completed' : {'title': 'Completed', 'class': 'bg-green'},
                            'Quoted' : {'title': 'Quoted', 'class': ' bg-orange'},
                            'Booked In' : {'title': 'Booked In', 'class': ' bg-blue'},
                            'Overdue' : {'title': 'Overdue', 'class': ' bg-red'},
                            'On Hold' : {'title': 'On Hold', 'class': ' bg-purple'},
                            'Postponed' : {'title': 'Postponed', 'class': ' bg-pink'},
                            'New' : {'title': 'New', 'class': ' bg-yellow'}
                        };
                        // console.log(data);
                        // console.log(full.original_job.status);
                        if (data == null && full.original_job.status == null) {
                            return ''
                        }
                        if (data == null) {
                            return '<p class="text-danger m-0"><del>'+status[full.original_job.status].title+'<del></p><p class="text-success m-0"></p>';
                        }
                        if (full.original_job.status == null) {
                            return '<p class="text-danger m-0"><del><del></p><p class="text-success m-0">'+status[data].title+'</p>';
                        }
                        if(data == full.original_job.status){
                            return status[data].title;
                        }else{
                            return '<p class="text-danger m-0"><del>'+status[full.original_job.status].title+'<del></p><p class="text-success m-0">'+status[data].title+'</p>';
                        }
                    }
                },
                {
                    targets: 38,
                    render: function(data, type, full, meta) {
                        var status = {
                            'Completed' : {'title': 'Completed', 'class': 'bg-green'},
                            'Quoted' : {'title': 'Quoted', 'class': ' bg-orange'},
                            'Booked In' : {'title': 'Booked In', 'class': ' bg-blue'},
                            'Overdue' : {'title': 'Overdue', 'class': ' bg-red'},
                            'On Hold' : {'title': 'On Hold', 'class': ' bg-purple'},
                            'Postponed' : {'title': 'Postponed', 'class': ' bg-pink'},
                            'New' : {'title': 'New', 'class': ' bg-yellow'}
                        };
                        // console.log(data);
                        // console.log(full.original_job.status_1);
                        if (data == null && full.original_job.status_1 == null) {
                            return ''
                        }
                        if (data == null) {
                            return '<p class="text-danger m-0"><del>'+status[full.original_job.status_1].title+'<del></p><p class="text-success m-0"></p>';
                        }
                        if (full.original_job.status_1 == null) {
                            return '<p class="text-danger m-0"><del><del></p><p class="text-success m-0">'+status[data].title+'</p>';
                        }
                        if(data == full.original_job.status_1){
                            return status[data].title;
                        }else{
                            return '<p class="text-danger m-0"><del>'+status[full.original_job.status_1].title+'<del></p><p class="text-success m-0">'+status[data].title+'</p>';
                        }
                    }
                },
                {
                    targets: 42,
                    render: function(data, type, full, meta) {
                        var status = {
                            'Completed' : {'title': 'Completed', 'class': 'bg-green'},
                            'Quoted' : {'title': 'Quoted', 'class': ' bg-orange'},
                            'Booked In' : {'title': 'Booked In', 'class': ' bg-blue'},
                            'Overdue' : {'title': 'Overdue', 'class': ' bg-red'},
                            'On Hold' : {'title': 'On Hold', 'class': ' bg-purple'},
                            'Postponed' : {'title': 'Postponed', 'class': ' bg-pink'},
                            'New' : {'title': 'New', 'class': ' bg-yellow'}
                        };
                        // console.log(data);
                        // console.log(full.original_job.status_2);
                        if (data == null && full.original_job.status_2 == null) {
                            return ''
                        }
                        if (data == null) {
                            return '<p class="text-danger m-0"><del>'+status[full.original_job.status_2].title+'<del></p><p class="text-success m-0"></p>';
                        }
                        if (full.original_job.status_2 == null) {
                            return '<p class="text-danger m-0"><del><del></p><p class="text-success m-0">'+status[data].title+'</p>';
                        }
                        if(data == full.original_job.status_2){
                            return status[data].title;
                        }else{
                            return '<p class="text-danger m-0"><del>'+status[full.original_job.status_2].title+'<del></p><p class="text-success m-0">'+status[data].title+'</p>';
                        }
                    }
                },
                {
                    targets: 61,
                    render: function(data, type, full, meta) {
                        var status = {
                            'Completed' : {'title': 'Completed', 'class': 'bg-green'},
                            'Quoted' : {'title': 'Quoted', 'class': ' bg-orange'},
                            'Booked In' : {'title': 'Booked In', 'class': ' bg-blue'},
                            'Overdue' : {'title': 'Overdue', 'class': ' bg-red'},
                            'On Hold' : {'title': 'On Hold', 'class': ' bg-purple'},
                            'Postponed' : {'title': 'Postponed', 'class': ' bg-pink'},
                            'New' : {'title': 'New', 'class': ' bg-yellow'}
                        };
                        // console.log(data);
                        // console.log(full.original_job.status_2);
                        if (data == null && full.original_job.status_3 == null) {
                            return ''
                        }
                        if (data == null) {
                            return '<p class="text-danger m-0"><del>'+status[full.original_job.status_3].title+'<del></p><p class="text-success m-0"></p>';
                        }
                        if (full.original_job.status_3 == null) {
                            return '<p class="text-danger m-0"><del><del></p><p class="text-success m-0">'+status[data].title+'</p>';
                        }
                        if(data == full.original_job.status_3){
                            return status[data].title;
                        }else{
                            return '<p class="text-danger m-0"><del>'+status[full.original_job.status_3].title+'<del></p><p class="text-success m-0">'+status[data].title+'</p>';
                        }
                    }
                },
                {
                    targets: 22,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.booked_date){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.booked_date+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 39,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.booked_date_1){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.booked_date_1+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 63,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.technician){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.technician+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 64,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.technician_1){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.technician_1+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 65,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.technician_2){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.technician_2+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 66,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.technician_3){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.technician_3+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 43,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.booked_date_2){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.booked_date_2+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 62,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.booked_date_3){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.booked_date_3+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 23,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.loc_custom_field_1){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.loc_custom_field_1+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 24,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.t_custom_field_1){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.t_custom_field_1+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 25,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.exp_custom_field_1){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.exp_custom_field_1+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 26,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.loc_custom_field_2){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.loc_custom_field_2+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 27,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.t_custom_field_2){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.t_custom_field_2+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 28,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.exp_custom_field_2){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.exp_custom_field_2+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 29,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.loc_custom_field_3){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.loc_custom_field_3+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 30,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.t_custom_field_3){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.t_custom_field_3+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 31,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.exp_custom_field_3){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.exp_custom_field_3+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 32,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.loc_custom_field_4){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.loc_custom_field_4+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 33,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.t_custom_field_4){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.t_custom_field_4+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 34,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.exp_custom_field_4){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.exp_custom_field_4+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 44,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.has_gas_appliances){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.has_gas_appliances+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 39,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.loc_has_gas_appliances){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.loc_has_gas_appliances+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 46,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.t_has_gas_appliances){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.t_has_gas_appliances+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 47,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.loc_has_gas_appliances_1){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.loc_has_gas_appliances_1+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 48,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.t_has_gas_appliances_1){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.t_has_gas_appliances_1+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 49,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.loc_has_gas_appliances_2){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.loc_has_gas_appliances_2+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 50,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.t_has_gas_appliances_2){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.t_has_gas_appliances_2+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 51,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.loc_has_gas_appliances_3){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.loc_has_gas_appliances_3+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 52,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.t_has_gas_appliances_3){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.t_has_gas_appliances_3+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 53,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.has_carbon_monoxide){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.has_carbon_monoxide+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 54,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.loc_has_carbon_monoxide_1){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.loc_has_carbon_monoxide_1+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 55,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.t_has_carbon_monoxide_1){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.t_has_carbon_monoxide_1+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 56,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.exp_has_carbon_monoxide_1){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.exp_has_carbon_monoxide_1+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 57,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.loc_has_carbon_monoxide_2){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.loc_has_carbon_monoxide_2+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 58,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.t_has_carbon_monoxide_2){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.t_has_carbon_monoxide_2+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 59,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.exp_has_carbon_monoxide_2){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.exp_has_carbon_monoxide_2+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 60,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.comments){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.comments+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 35,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.service_plan){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.service_plan+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 19,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.last_alarm_service){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.last_alarm_service+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 36,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.last_gas_service){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.last_gas_service+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
                {
                    targets: 40,
                    render: function(data, type, full, meta) {
                        if(data == full.original_job.last_elec_service){
                            return data;
                        }else{
                            return '<p class="text-danger m-0"><del>'+full.original_job.last_elec_service+'<del></p><p class="text-success m-0">'+data+'</p>';
                        }
                    }
                },
            ],
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
            table.column(17).search(status, false, false);
            table.table().draw();

        });

        $('#kt_reset').on('click', function(e) {
            e.preventDefault();
            table.column(17).search('', false, false);
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
