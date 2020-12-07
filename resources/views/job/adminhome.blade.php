@extends('layouts.app')

@push('styles')
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-tabletools/css/dataTables.tableTools.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-colvis/css/dataTables.colVis.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.css" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-scroller/css/scroller.dataTables.scss') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css')}}">
    <style>
        table.dataTable tbody td {word-break: break-word !important;vertical-align: top;}
        .i-checks { margin:0; }
        .i-checks > i { width: 15px !important; height: 15px !important;margin-right: 10px !important;}
        .btn_inline { padding: 2px 10px !important; }
        .table { width: 100% !important; }
        .label { color: #626262;}
        div.ColVis { margin: 0 10px;}
        button.ColVis_Button.ColVis_MasterButton { background: #4aa9e9 !important; color: #FFF !important; border-color: #4aa9e9 !important; }
        .buttons-print, .buttons-copy, .buttons-excel, .buttons-csv { background: #4aa9e9 !important; color: #FFF !important; border-color: #4aa9e9 !important; }
        table.dataTable tbody td { word-break: break-word !important; vertical-align: top; }
        table.dataTable tbody th, table.dataTable tbody td { padding: 4px 7px; font-size: 13px; }
        table.dataTable thead th, table.dataTable tfoot th { font-weight: 600; font-size: 13px; }
        .panel-body { padding: 15px 5px; }
        .dt-buttons { float: right; }
        .dt-buttons button { outline: none; background: #f3f3f3; border-color: #ddd; border: 1px solid #999; color: black; border-radius: 2px; height: 30px; padding: 3px 8px; }
        .dataTables_wrapper .dataTables_info { padding-top: 10px !important; }
        thead .input-sm{width: 100% !important;}
        ul.ColVis_collection{
            width: 200px;
        }
        .select2{
            font-size: 12px!important;
        }

        .dt-button-collection {
            position: fixed;
            z-index: 999;
            float: right;
            margin: 0 !important;
        }

       .dt-button-collection .dt-button {
           display:block;
           width:100%;
           margin: 2px 0;
           font-size: 12px;
            width: 61px;
        }

        .dt-buttons button {
            outline: none;
            background: #f3f3f3;
            border-color: #ddd;
            border: 1px solid #999;
            color: black;
            border-radius: 2px;
            height: 30px;
            padding: 3px 8px;
            font-size: 12px;
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
                    <div class="col-md-5" style="width: 20%;">
                        <select class="form-control input-sm select2" multiple id="mySelect2" name="services">
                            <option value="Alarm">Smoke Alarm</option>
                            <option value="Gas">Gas</option>
                            <option value="Elec">Elec</option>
                            <option value="Co">CO Alarm</option>
                        </select>
                    </div>
                    <div class="col-md-2" style="width: 11%;">
                        <input class="form-control input-sm datepicker" id="booked_datepicker" name="booked_datepicker" placeholder="DD-MM-YYYY" type="text"  style="font-size: 12px !important;">
                    </div>
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
                            <th></th>
                            <th> Actions </th>
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
                            <th> Co. Alarm Status </th>
                            <th> Co. Alarm Booked Date </th>
                            <th> Co. Alarm Tech. </th>
                            <th> Carbon Monoxide Location 1 </th>
                            <th> Carbon Monoxide Type 1 </th>
                            <th> Carbon Monoxide Exp Year 1 </th>
                            <th> Carbon Monoxide Location 2 </th>
                            <th> Carbon Monoxide Type 2 </th>
                            <th> Carbon Monoxide Exp Year 2 </th>
                            <th> Comments </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <button class="btn btn-primary btn-sm btn_inline" id="update_status">Reset Status</button>

@endsection


@push('scripts')

<script>
@if( Auth::user()->role == 'admin' )
    window._table_targets = [3,4,5,6,10,11,12,13,17,18,19,20,21,22,24,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,42,44,45,47,49,50,51,52,53,54,55,56,57,58,60,62,63,64,65,66,67,68];
@endif
</script>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('bower_components/datatables-tabletools/js/dataTables.tableTools.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.js"></script>
<script src="{{ asset('bower_components/datatables-colvis/js/dataTables.colVis.js') }}"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
<script src="{{ asset('bower_components/datatables-scroller/js/dataTables.scroller.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>

<script>

var KTDatatablesSearchOptionsAdvancedSearch = function() {

    $.fn.dataTable.Api.register('column().title()', function() {
        return $(this.header()).text().trim();
    });

    var initTable1 = function() {

        $('.colvis-responsive-data-table thead tr').clone(true).appendTo( '.colvis-responsive-data-table thead' );
        $('.colvis-responsive-data-table thead tr:eq(1) th').each( function (i) {
            // if(i == $('.colvis-responsive-data-table thead tr:eq(1) th').length -1 || i == 0){
            if(i == 0 || i == 1){
                $(this).removeClass('sorting');
                $(this).text('');
                return true;
            }
            var title = $(this).text();
            $(this).html( '<input type="text" class="form-control input-sm" placeholder="'+title+'" />' );
            $( 'input', this ).on( 'keyup change', function () {

                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            });
        });

        // begin first table
        var table = $('#kt_table_1').DataTable({
            responsive: false,
            orderCellsTop: true,
            colReorder: true,
            // Pagination settings
            dom: `<<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'BCf>><<'col-md-12'p>>
            <<'col-sm-12't>>
            <<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'p>>`,
            buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
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
            },
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            }
            ],
            language: {
                'lengthMenu': 'Display _MENU_',
            },
            lengthMenu: [5, 10, 50, 100, 500, 1000],
            // scrollX: true,
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
                url: '{{ route('postJob') }}',
                type: 'POST',
                dataSrc: 'jobs',
            },
            columns: [
                {data: 'id'},
                {data: 'id'},
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
                {data: 'technician'},
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
                {data: 'technician_1'},
                {data: 'last_elec_service'},
                {data: 'service_year_2'},
                {data: 'status_2'},
                {data: 'booked_date_2'},
                {data: 'technician_2'},
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
                {data: 'status_3'},
                {data: 'booked_date_3'},
                {data: 'technician_3'},
                {data: 'loc_has_carbon_monoxide_1'},
                {data: 't_has_carbon_monoxide_1'},
                {data: 'exp_has_carbon_monoxide_1'},
                {data: 'loc_has_carbon_monoxide_2'},
                {data: 't_has_carbon_monoxide_2'},
                {data: 'exp_has_carbon_monoxide_2'},
                {data: 'comments'},
            ],

            columnDefs: [
                {
                    targets: window._table_targets,
                    visible: false,
                },
                {
                    targets: 0,
                    title: '',
                    orderable: false,
                    sortable: false,
                    selector: false,
                    width:'1%',
                    render: function(data, type, full, meta) {
                        return `<label class="i-checks"><input type="checkbox" name="check_job[]" value="`+data+`"><i></i></label>`;
                    },
                },
                {
                    targets: 22,
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
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        meta.settings.aoColumns[22].sClass = status[data].class;
                        return status[data].title;

                    },
                },
                {
                    targets: 40,
                    render: function(data, type, full, meta) {
                        if (typeof data === 'undefined') {
                            return data;
                        }
                        if(data == 'NA'){
                            meta.settings.aoColumns[40].sClass = 'bg-red';
                            return data;
                        }
                        meta.settings.aoColumns[40].sClass = '';
                        return data;

                    },
                },
                {
                    targets: 45,
                    render: function(data, type, full, meta) {
                        if (typeof data === 'undefined') {
                            return data;
                        }
                        if(data == 'NA'){
                            meta.settings.aoColumns[45].sClass = 'bg-red';
                            return data;
                        }
                        meta.settings.aoColumns[45].sClass = '';
                        return data;

                    },
                },
                {
                    targets: 23,
                    class: '',
                    render: function(data, type, full, meta) {
                        meta.settings.aoColumns[23].sClass = '';
                        if(full.alarm_service == 'No'){
                            var status = {
                                'New' : {'title': '', 'class': 'text-center'},
                            };
                        }else{
                            var status = {
                                'Completed' : {'title': 'Completed', 'class': 'text-center font-bold bg-green'},
                                'Quoted' : {'title': 'Quoted', 'class': ' text-center font-bold bg-orange'},
                                'Booked In' : {'title': 'Booked In', 'class': ' text-center font-bold bg-blue'},
                                'Overdue' : {'title': 'Overdue', 'class': ' text-center font-bold bg-red'},
                                'On Hold' : {'title': 'On Hold', 'class': ' text-center font-bold bg-purple'},
                                'Postponed' : {'title': 'Postponed', 'class': ' text-center font-bold bg-pink'},
                                'New' : {'title': 'New', 'class': ' text-center font-bold bg-yellow'}
                            };
                        }
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        meta.settings.aoColumns[23].sClass = status[data].class;
                        if ((data == 'Booked In' || data == 'Overdue') && full.booked_date != '') {
                            return status[data].title+'<br>\n'+moment(full.booked_date).format('D-MM-Y');
                        }else{
                            return status[data].title;
                        }
                    },
                },
                {
                    targets: 41,
                    class: '',
                    render: function(data, type, full, meta) {
                        meta.settings.aoColumns[41].sClass = '';
                         if(full.has_gas_appliances == 'No' || full.has_gas_appliances == 'Unsure'){
                            var status = {
                                'New' : {'title': '', 'class': 'text-center'},
                            };
                        }else{
                            var status = {
                                'Completed' : {'title': 'Completed', 'class': 'text-center font-bold bg-green'},
                                'Quoted' : {'title': 'Quoted', 'class': ' text-center font-bold bg-orange'},
                                'Booked In' : {'title': 'Booked In', 'class': ' text-center font-bold bg-blue'},
                                'Overdue' : {'title': 'Overdue', 'class': ' text-center font-bold bg-red'},
                                'On Hold' : {'title': 'On Hold', 'class': ' text-center font-bold bg-purple'},
                                'Postponed' : {'title': 'Postponed', 'class': ' text-center font-bold bg-pink'},
                                'New' : {'title': 'New', 'class': ' text-center font-bold bg-yellow'}
                            };
                        }
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        meta.settings.aoColumns[41].sClass = status[data].class;
                        if ((data == 'Booked In' || data == 'Overdue') && full.booked_date_1 != '') {
                            return status[data].title+'<br>\n'+moment(full.booked_date_1).format('D-MM-Y');
                        }else{
                            return status[data].title;
                        }
                    },
                },
                {
                    targets: 46,
                    class: '',
                    render: function(data, type, full, meta) {
                        meta.settings.aoColumns[46].sClass = '';
                         if(full.elec_service == 'No' || full.elec_service == 'Unsure'){
                            var status = {
                                'New' : {'title': '', 'class': 'text-center'},
                            };
                        }else{
                            var status = {
                                'Completed' : {'title': 'Completed', 'class': 'text-center font-bold bg-green'},
                                'Quoted' : {'title': 'Quoted', 'class': ' text-center font-bold bg-orange'},
                                'Booked In' : {'title': 'Booked In', 'class': ' text-center font-bold bg-blue'},
                                'Overdue' : {'title': 'Overdue', 'class': ' text-center font-bold bg-red'},
                                'On Hold' : {'title': 'On Hold', 'class': ' text-center font-bold bg-purple'},
                                'Postponed' : {'title': 'Postponed', 'class': ' text-center font-bold bg-pink'},
                                'New' : {'title': 'New', 'class': ' text-center font-bold bg-yellow'}
                            };
                        }
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        meta.settings.aoColumns[46].sClass = status[data].class;
                        if ((data == 'Booked In' || data == 'Overdue') && full.booked_date_2 != '') {
                            return status[data].title+'<br>\n'+moment(full.booked_date_2).format('DD-MM-Y');
                        }else{
                            return status[data].title;
                        }
                    },
                },
                {
                    targets: 59,
                    class: '',
                    render: function(data, type, full, meta) {
                        meta.settings.aoColumns[59].sClass = '';
                        if(full.has_carbon_monoxide == 'No' || full.has_carbon_monoxide == 'Unsure'){
                            var status = {
                                'New' : {'title': '', 'class': 'text-center'},
                            };
                        }else{
                            var status = {
                                'Completed' : {'title': 'Completed', 'class': 'text-center font-bold bg-green'},
                                'Quoted' : {'title': 'Quoted', 'class': ' text-center font-bold bg-orange'},
                                'Booked In' : {'title': 'Booked In', 'class': ' text-center font-bold bg-blue'},
                                'Overdue' : {'title': 'Overdue', 'class': ' text-center font-bold bg-red'},
                                'On Hold' : {'title': 'On Hold', 'class': ' text-center font-bold bg-purple'},
                                'Postponed' : {'title': 'Postponed', 'class': ' text-center font-bold bg-pink'},
                                'New' : {'title': 'New', 'class': ' text-center font-bold bg-yellow'}
                            };
                        }
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        meta.settings.aoColumns[59].sClass = status[data].class;
                        if ((data == 'Booked In' || data == 'Overdue') && full.booked_date_3 != '') {
                            return status[data].title+'<br>\n'+moment(full.booked_date_3).format('DD-MM-Y');
                        }else{
                            return status[data].title;
                        }
                    },
                },
                {
                    targets: [2, 7, 8, 15,16, 18],
                    render: function(data, type, full, meta) {
                        if( data != null ) {
                            if(data.length > 20){
                                return '<p class="m-0 cursor-help" data-toggle="tooltip" data-placement="top" title="'+data+'">'+data.substr(0,15)+'... </p>';
                            }else{
                                return data;
                            }
                        }
                        return '';
                    }
                },
                {
                    targets: [28, 31, 34, 37],
                    render: function(data, type, full, meta) {
                        meta.settings.aoColumns[meta.col].sClass = '';
                        if(data != null){
                            if(moment(data).isBefore()){
                                meta.settings.aoColumns[meta.col].sClass = 'bg-red';
                            }
                            return moment(data).format('Y');
                        }else{
                            return data;
                        }
                    }
                },
                {
                    targets: [21, 39, 44],
                    render: function(data, type, full, meta) {
                        if(data != null){
                            return moment(data).format('DD-MM-Y');
                        }else{
                            return '';
                        }

                    }
                },
                {
                    targets: 1,
                    title: 'Actions',
                    orderable: false,
                    sortable: false,
                    selector: false,
                    width:'1%',
                    render: function(data, type, full, meta) {
                        return `<a href="job/edit/`+data+`" class="btn btn-primary btn_inline">View</a>`;
                    },
                },
            ],
        });


        table.columns().eq( 0 ).each( function ( colIdx ) {
            $('input, select', table.column(colIdx).header()).on('click', function(e) {
                    e.stopPropagation();
                });
        } );

        var filter = function() {
            var val = $.fn.dataTable.util.escapeRegex($(this).val());
            table.column($(this).data('col-index')).search(val ? val : '', false, false).draw();
        };

        var asdasd = function(value, index) {
            var val = $.fn.dataTable.util.escapeRegex(value);
            table.column(index).search(val ? val : '', false, true);
        };


        $('#mySelect2').on('change', function(e) {
            if($('#booked_datepicker').val() != ''){
                $('#booked_datepicker').trigger('change');
            }
        });

        $('#booked_datepicker').on('change', function(e) {
            e.preventDefault();
                table.column(24).search('', false, false);
                table.column(42).search('', false, false);
                table.column(47).search('', false, false);
                table.column(60).search('', false, false);
            if(this.value != ''){
                var xarray = $("select[name='services']").val();
                if(!xarray || xarray.length == 0){
                    table.column(24).search(this.value, false, false);
                    table.column(42).search(this.value, false, false);
                    table.column(47).search(this.value, false, false);
                    table.column(60).search(this.value, false, false);
                }else{
                    if($.inArray("Alarm", xarray) !== -1){
                        table.column(24).search(this.value, false, false);
                    }
                    if($.inArray("Gas", xarray) !== -1){
                        table.column(42).search(this.value, false, false);
                    }
                    if($.inArray("Elec", xarray) !== -1){
                        table.column(47).search(this.value, false, false);
                    }
                    if($.inArray("Co", xarray) !== -1){
                        table.column(60).search(this.value, false, false);
                    }
                }
            }else{
                table.column(24).search('', false, false);
                table.column(42).search('', false, false);
                table.column(47).search('', false, false);
                table.column(60).search('', false, false);
            }

            table.table().draw();
        });

        $('.kt_search').on('click', function(e) {
            e.preventDefault();
            let status = $(this).attr('value');
            var xarray = $("select[name='services']").val();

            table.column(23).search('', false, false);
            table.column(41).search('', false, false);
            table.column(46).search('', false, false);
            table.column(59).search('', false, false);

            if(!xarray || xarray.length == 0){
                table.column(23).search(status, false, false);
                table.column(41).search(status, false, false);
                table.column(46).search(status, false, false);
                table.column(59).search(status, false, false);
            }else{
                if($.inArray("Alarm", xarray) !== -1){
                    table.column(23).search(status, false, false);
                }
                if($.inArray("Gas", xarray) !== -1){
                    table.column(41).search(status, false, false);
                }
                if($.inArray("Elec", xarray) !== -1){
                    table.column(46).search(status, false, false);
                }
                if($.inArray("Co", xarray) !== -1){
                    table.column(59).search(status, false, false);
                }
            }


            table.table().draw();

        });

        $('#kt_reset').on('click', function(e) {
            e.preventDefault();
            $('#mySelect2').val(null).trigger('change');

            $("#booked_datepicker").val('')
            table.column(23).search('', false, false);
            table.column(41).search('', false, false);
            table.column(46).search('', false, false);
            table.column(59).search('', false, false);
            table.column(24).search('', false, false);
            table.column(42).search('', false, false);
            table.column(47).search('', false, false);
            table.column(60).search('', false, false);
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
<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            autoclose: true,
            clearBtn: true,
            todayHighlight: true,
            format: 'dd-mm-yyyy'
        });
        $("#mySelect2").select2({
            placeholder: "Select Service",
            allowClear: true
        });
        $("#checkall").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $(document).on('click', '#update_status', function(e) {
            e.preventDefault();
            var checkedNum = $('input[name="check_job[]"]:checked').length;
            if (!checkedNum) {
                // User didn't check any checkboxes
                toastr["error"]('Please select atleast one checkbox');
            } else {
                var job_ids = [];
                $.each($("input[name='check_job[]']:checked"), function(){
                    job_ids.push($(this).val());
                });
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: '{{ route('changeJobBulkStatus') }}',
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        job_ids: job_ids
                    },
                    success: function(res) {
                        console.log(res);
                        location.reload();
                    }
                }); // end ajax
            }
        });
    });
</script>
@endpush
