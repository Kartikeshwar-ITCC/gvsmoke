
function format(d) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
        '<tr>' +
        '<td>Full name:</td>' +
        '<td>' + d.name + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Extension number:</td>' +
        '<td>' + d.extn + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Extra info:</td>' +
        '<td>And any further details here (images etc)...</td>' +
        '</tr>' +
        '</table>';
}

// Data Table

$('.convert-data-table').DataTable({
    "PaginationType": "bootstrap",
    dom: '<"tbl-head clearfix"T>,<"tbl-top clearfix"lfr>,t,<"tbl-footer clearfix"<"tbl-info pull-left"i><"tbl-pagin pull-right"p>>',
    tableTools: {
        "sSwfPath": "swf/copy_csv_xls_pdf.swf"
    }
});

$('.colvis-data-table').DataTable({
    "PaginationType": "bootstrap",
    dom: '<"tbl-head clearfix"C>,<"tbl-top clearfix"lfr>,t,<"tbl-footer clearfix"<"tbl-info pull-left"i><"tbl-pagin pull-right"p>>'
});

// $('.colvis-responsive-data-table thead tr').clone(true).appendTo( '.colvis-responsive-data-table thead' );
// $('.colvis-responsive-data-table thead tr:eq(1) th').each( function (i) {
//     if(i == $('.colvis-responsive-data-table thead tr:eq(1) th').length -1 ){
//         $(this).removeClass('sorting');
//         $(this).text('');
//         return true;
//     }
//     var title = $(this).text();
//     $(this).html( '<input type="text" class="form-control input-sm mb-10" placeholder="Search '+title+'" />' );

//     $( 'input', this ).on( 'keyup change', function () {
//         if ( job.column(i).search() !== this.value ) {
//             job
//                 .column(i)
//                 .search( this.value )
//                 .draw();
//         }
//     } );
// } );

var job = $('.colvis-responsive-data-table').DataTable({
    "PaginationType": "bootstrap",
    // responsive: true,
                // dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>><'row'<'col-sm-12'tr>>`,
    dom: '<"tbl-head clearfix"C>,<"tbl-top clearfix"lfr>,t,<"tbl-footer clearfix"<"tbl-info pull-left"i><"tbl-pagin pull-right"p>>',
    orderCellsTop: true,
    pageLength: 50,
    buttons: [
       'print'
    ],
    columnDefs: [{
    targets: window._table_targets,
    visible: false,
    }],
});

// $('.responsive-data-table thead tr').clone(true).appendTo( '.responsive-data-table thead' );
// $('.responsive-data-table thead tr:eq(1) th').each( function (i) {
//     if(i==3){
//         $(this).removeClass('sorting');
//         $(this).text('');
//         return true;
//     }
//     var title = $(this).text();
//     $(this).html( '<input type="text" class="form-control input-sm mb-10" placeholder="Search '+title+'" />' );

//     $( 'input', this ).on( 'keyup change', function () {
//         if ( agency.column(i).search() !== this.value ) {
//             agency
//                 .column(i)
//                 .search( this.value )
//                 .draw();
//         }
//     } );
// } );

var agency  = $('.responsive-data-table').DataTable({
    PaginationType: "bootstrap",
    orderCellsTop: true,
    pageLength: 50,
    dom: '<"tbl-top clearfix"lfr>,t,<"tbl-footer clearfix"<"tbl-info pull-left"i><"tbl-pagin pull-right"p>>'
});
