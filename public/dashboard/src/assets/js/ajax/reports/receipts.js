$(document).ready(function($){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const reportType = $('#reportType').val();

    populateData();
    function populateData(selectFromDate = '')
    {
        const receiptsGetAll= $('#receiptsGetAll').val();
        var receiptsGetAllTable = $('#receipts-report-table').DataTable( {
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>' },
                "sInfo": "إظهار الصفحة _PAGE_ من _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "بحث...",
                "sLengthMenu": " النتيجة :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [10, 20, 50],
            "pageLength": 10,
            "ordering": true,
            searching: true,
            "processing": false,
            "serverSide": true,
            retrieve: true,
            "ajax": {
                url : receiptsGetAll,
                data: {
                    selectFromDate: selectFromDate,
                    reportType: reportType,
                }
            }
            ,
            "columns": [
                {data:'knittingDate', name:'knittingDate'},
                {data:'orderCode', name:'orderCode'},
                {data:'collectDate', name:'collectDate', orderable:false, searchable:false},
                {data:'id', name:'id'},
                {data:'depositTypeInput', name:'depositTypeInput'},
                {data:'customerID', name:'customerID'},
                {data:'customerName', name:'customerName'},
                {data:'orderDiscount', name:'orderDiscount'},
                {data:'price', name:'price', orderable:false, searchable:false},
            ],
            "columnDefs": [
                {
                    "targets": 'no-sort',
                    "orderable": true
                },
                { targets:[] }
            ]
        } );
    }

    $("#btn-search-receipts").click(function(event) {
        event.preventDefault();
        var selectFromDate = $('#selectFromDate').val();
        $('#receipts-report-table').DataTable().clear().destroy();
        populateData(selectFromDate);
    });
});
