@extends('layouts.app')

@push('styles')
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-tabletools/css/dataTables.tableTools.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-colvis/css/dataTables.colVis.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.css" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-scroller/css/scroller.dataTables.scss') }}" rel="stylesheet">
@endpush


@section('content')

    <!--page title and breadcrumb start -->
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title">
                @if(request()->route()->getName() == 'jobDeleted') No Longer Managed Jobs @endif

                <small></small>
            </h1>
        </div>
        <div class="col-md-4">
            <ul class="breadcrumb pull-right">
                <li><a href="/">Home</a></li>
                <li><a href="javascript:void(0)" class="active">
                @if(request()->route()->getName() == 'jobDeleted') No Longer Managed Jobs @endif
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
                    <span class="new_button pull-right">
                    </span>
                </header>
                <div class="panel-body">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
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
                                <th> Key </th>
                                <th> Country </th>
                                <th> Area Location </th>
                                <th> Alarm Service Month </th>
                                <th> Gas Service Month </th>
                                <th> Elec Service Month </th>
                                <th> Tenant </th>
                                <th> Tenant 1 </th>
                                <th> Contact Details </th>
                                <th> Contact Details 1 </th>
                                <th> Alarm Status </th>
                                <th> Gas Status </th>
                                <th> Elec Status </th>
                                <th> Alarm Booked Date </th>
                                <th> Gas Booked Date </th>
                                <th> Elec Booked Date </th>
                                <th> Location 1 </th>
                                <th> Type 1 </th>
                                <th> Exp Date 1 </th>
                                <th> Location 2 </th>
                                <th> Type 2 </th>
                                <th> Exp Date 2 </th>
                                <th> Location 3 </th>
                                <th> Type 3 </th>
                                <th> Exp Date 3 </th>
                                <th> Location 4 </th>
                                <th> Type 4 </th>
                                <th> Exp Date 4 </th>
                                <th> Has Gas Appliances? </th>
                                <th> Loc Gas Appliances 1 </th>
                                <th> Type Gas Appliances 1 </th>
                                <th> Loc Gas Appliances 2 </th>
                                <th> Type Gas Appliances 2 </th>
                                <th> Loc Gas Appliances 3 </th>
                                <th> Type Gas Appliances 3 </th>
                                <th> Exp Gas Appliances </th>
                                <th> Has Carbon Monoxide? </th>
                                <th> Loc Carbon Monoxide </th>
                                <th> Comments </th>
                                <th> Service Plan </th>
                                <th> Services </th>
                                <th> Last Alarm Service </th>
                                <th> Last Gas Service </th>
                                <th> Last Elec Service </th>
                                <th> Tenant Email </th>
                                <th> Tenant Email 1 </th>
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
    window._table_targets = [ 1,2,3,4,9,11,12,14,15,17,18,19,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55 ];
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
                url: '{{ route('postDeletedIndex') }}',
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
                {data: 'key'},
                {data: 'country'},
                {data: 'location_area'},
                {data: 'service_month'},
                {data: 'service_month_1'},
                {data: 'service_month_2'},
                {data: 'tenant'},
                {data: 'tenant_1'},
                {data: 'contact_details'},
                {data: 'contact_details_1'},
                {data: 'status'},
                {data: 'status_1'},
                {data: 'status_2'},
                {data: 'booked_date'},
                {data: 'booked_date_1'},
                {data: 'booked_date_2'},
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
                {data: 'has_gas_appliances'},
                {data: 'loc_has_gas_appliances'},
                {data: 't_has_gas_appliances'},
                {data: 'loc_has_gas_appliances_1'},
                {data: 't_has_gas_appliances_1'},
                {data: 'loc_has_gas_appliances_2'},
                {data: 't_has_gas_appliances_2'},
                {data: 'exp_has_gas_appliances'},
                {data: 'has_carbon_monoxide'},
                {data: 'loc_has_carbon_monoxide_1'},
                {data: 'comments'},
                {data: 'service_plan'},
                {data: 'services'},
                {data: 'last_alarm_service'},
                {data: 'last_gas_service'},
                {data: 'last_elec_service'},
                {data: 'tenant_email'},
                {data: 'tenant_email_1'},
                {data: 'id'},
            ],

            columnDefs: [
                {
                    targets: window._table_targets,
                    visible: false,
                },
                {
                    targets: 56,
                    title: 'Actions',
                    orderable: false,
                    sortable: false,
                    selector: false,
                    width:'5%',
                    render: function(data, type, full, meta) {
                        return `<button data-toggle="tooltip" data-placement="top" title="Restore" onclick="openRestoreDialog(`+data+`);" class="btn btn-primary btn_inline">Restore</button>`;
                    },
                },
                {
                    targets: [5, 6, 16],
                    render: function(data, type, full, meta) {
                        if( data != null ) {
                            return '<p class="m-0" data-toggle="tooltip" data-placement="top" title="'+data+'">'+data.substr(0,15)+' </p>';
                        }
                        return '';
                    }
                },
                {
                    targets: 20,
                    render: function(data, type, full, meta) {
                        meta.settings.aoColumns[20].sClass = '';
                        var status = {
                            'Completed' : {'title': 'Completed', 'class': 'text-center font-bold bg-green'},
                            'Quoted' : {'title': 'Quoted', 'class': ' text-center font-bold bg-orange'},
                            'Booked In' : {'title': 'Booked In', 'class': ' text-center font-bold bg-blue'},
                            'Overdue' : {'title': 'Overdue', 'class': ' text-center font-bold bg-red'},
                            'On Hold' : {'title': 'On Hold', 'class': ' text-center font-bold bg-purple'},
                            'Postponed' : {'title': 'Postponed', 'class': ' text-center font-bold bg-pink'},
                            'New' : {'title': 'New', 'class': ' text-center font-bold bg-yellow'}
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }

                        meta.settings.aoColumns[20].sClass = status[data].class;
                        if (data == 'Booked In') {
                            return status[data].title +'<br>'+ full.booked_date;
                        }else{
                            return status[data].title;
                        }
                    },
                },
                {
                    targets: 21,
                    render: function(data, type, full, meta) {
                        meta.settings.aoColumns[21].sClass = '';
                        var status = {
                            'Completed' : {'title': 'Completed', 'class': 'text-center font-bold bg-green'},
                            'Quoted' : {'title': 'Quoted', 'class': ' text-center font-bold bg-orange'},
                            'Booked In' : {'title': 'Booked In', 'class': ' text-center font-bold bg-blue'},
                            'Overdue' : {'title': 'Overdue', 'class': ' text-center font-bold bg-red'},
                            'On Hold' : {'title': 'On Hold', 'class': ' text-center font-bold bg-purple'},
                            'Postponed' : {'title': 'Postponed', 'class': ' text-center font-bold bg-pink'},
                            'New' : {'title': 'New', 'class': ' text-center font-bold bg-yellow'}
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }

                        meta.settings.aoColumns[21].sClass = status[data].class;
                        if (data == 'Booked In') {
                            return status[data].title +'<br>'+ full.booked_date_1;
                        }else{
                            return status[data].title;
                        }
                    },
                },
                {
                    targets: 22,
                    render: function(data, type, full, meta) {
                        meta.settings.aoColumns[22].sClass = '';
                        var status = {
                            'Completed' : {'title': 'Completed', 'class': 'text-center font-bold bg-green'},
                            'Quoted' : {'title': 'Quoted', 'class': ' text-center font-bold bg-orange'},
                            'Booked In' : {'title': 'Booked In', 'class': ' text-center font-bold bg-blue'},
                            'Overdue' : {'title': 'Overdue', 'class': ' text-center font-bold bg-red'},
                            'On Hold' : {'title': 'On Hold', 'class': ' text-center font-bold bg-purple'},
                            'Postponed' : {'title': 'Postponed', 'class': ' text-center font-bold bg-pink'},
                            'New' : {'title': 'New', 'class': ' text-center font-bold bg-yellow'}
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }

                        meta.settings.aoColumns[22].sClass = status[data].class;
                        if (data == 'Booked In') {
                            return status[data].title +'<br>'+ full.booked_date_2;
                        }else{
                            return status[data].title;
                        }
                    },
                },
                {
                    targets: 13,
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
                        meta.settings.aoColumns[13].sClass = status[data].class;
                        return '<span class="' + status[data].class + '">' + status[data].title + '</span>';

                    },
                },
                {
                    targets: 14,
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
                        meta.settings.aoColumns[14].sClass = status[data].class;
                        return '<span class="' + status[data].class + '">' + status[data].title + '</span>';

                    },
                },
                {
                    targets: 15,
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
                        meta.settings.aoColumns[15].sClass = status[data].class;
                        return '<span class="' + status[data].class + '">' + status[data].title + '</span>';

                    },
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
            table.column(20).search(status, false, false);
            table.table().draw();

        });

        $('#kt_reset').on('click', function(e) {
            e.preventDefault();
            table.column(20).search('', false, false);
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
function openRestoreDialog(jobId){

    var url = '/job/restore/' + jobId;
    Swal.fire({
        title: 'Are you sure?',
        html : "The Selected Job Will be Restored..!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, restore it..!',
        showLoaderOnConfirm: true,
        preConfirm: (jobId) => {
            return fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error()
                }
                return response.json()
            }).catch(error => {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Something Went Wrong..!',
                })
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.value.code  != 200) {
                Swal.fire({
                    type: 'error',
                    title: result.value.title,
                    text: result.value.message
                })
            }else{
                Swal.fire({
                    type: 'success',
                    title: result.value.title,
                    text: result.value.message,
                    onClose: () => {
                        window.location.href =  '{{ route('jobDeleted') }}';
                    }
                });

            }
        })
    }
</script>
@endpush
