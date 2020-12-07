@extends('layouts.app')

@push('styles')
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-tabletools/css/dataTables.tableTools.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-colvis/css/dataTables.colVis.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.css" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-scroller/css/scroller.dataTables.scss') }}" rel="stylesheet">
    <style>
        table.dataTable tbody td {word-break: break-word !important;vertical-align: top;}
        .i-checks { margin:0; }
        .i-checks > i { width: 15px !important; height: 15px !important;margin-right: 10px !important;}
        .btn_inline { padding: 2px 10px !important; }
        .table { width: 100% !important; }
        .label { color: #626262;}
        div.ColVis { margin: 0 10px;}
        button.ColVis_Button.ColVis_MasterButton { background: #4aa9e9 !important; color: #FFF !important; border-color: #4aa9e9 !important; }
        .buttons-print { background: #62549a !important; color: #FFF !important; border-color: #62549a !important; }
        table.dataTable tbody td { word-break: break-word !important; vertical-align: top; }
        table.dataTable tbody th, table.dataTable tbody td { padding: 4px 7px; font-size: 13px; }
        table.dataTable thead th, table.dataTable tfoot th { font-weight: 600; font-size: 13px; }
        .panel-body { padding: 15px 5px; }
        .dt-buttons { float: right; }
        .dt-buttons button { outline: none; background: #f3f3f3; border-color: #ddd; border: 1px solid #999; color: black; border-radius: 2px; height: 30px; padding: 3px 8px; }
        .dataTables_wrapper .dataTables_info { padding-top: 10px !important; }
    </style>
@endpush


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
                <li><a href="#" class="active">Agencies</a></li>
            </ul>
        </div>
    </div>
    <!--page title and breadcrumb end -->

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading panel-border">
                    &nbsp;
                    <span class="new_button pull-right">
                        <a href="{{ route('agencyAdd') }}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Add New Agency</a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="table table-responsive">
                    <table class="table responsive-data-table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th> Actions </th>
                            <th> Agency Name </th>
                            <th> Property Manager Name </th>
                            <th> Email </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($agencies as $agency)
                        <tr>
                            <td>
                                <a href="{{ route('agencyEdit', ['id' => $agency->id]) }}" class="btn btn-primary btn_inline">View</a>
                                <button onclick="openDeleteDialog('#deleteAgency{{$agency->id}}');" class="btn btn-danger btn_inline">Delete</button>
                            </td>
                            <td> {{ $agency->name }} </td>
                            <td> {{ $agency->property_manager_name }} </td>
                            <td> {{ $agency->email }} </td>
                            <form id="deleteAgency{{$agency->id}}" action="{{ route('agencyPostDelete') }}" method="POST">
                                <input type="hidden" name="id" value="{{$agency->id}}">
                                @method('DELETE')
                                @csrf
                            </form>
                        </tr>
                        @endforeach


                        </tbody>
                    </table>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection


@push('scripts')

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('bower_components/datatables-tabletools/js/dataTables.tableTools.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.js"></script>
<script src="{{ asset('bower_components/datatables-colvis/js/dataTables.colVis.js') }}"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
<script src="{{ asset('bower_components/datatables-scroller/js/dataTables.scroller.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script src="{{ asset('dist/js/init-datatables.js') }}"></script>

<script>
function openDeleteDialog(formId){
    Swal.fire({
        title: 'Are you sure?',
        html : "All Jobs associated with agency will be deleted..!<br>You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $(formId).submit();
        }
    })
}
</script>

@endpush
