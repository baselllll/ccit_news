$(document).ready(function($){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function printNew() {
        var restorepage = $('body').html();
        var printcontent = $('#modal_body_PrintPayment').clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
        window.location.href = window.location.href;
    }
    $("#btn-print").on("click", function () {
        printNew();
    });

    const url= $('#getUrl').val();
    const deleteUrl = $('#deleteUrl').val();

    var table = $('#voucher-payments-table').DataTable( {
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
        "ajax": url
        ,
        "columns": [
            {data:'id', name:'id'},
            {data:'customer_name', name:'customer_name'},
            {data:'created_at', name:'created_at'},
            {data:'price', name:'price'},
            {data:'payment_type', name:'payment_type', orderable:false, searchable:false},
            {data:'actions', name:'actions'},
        ],
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false
        }]
    } );

    $('#create').click(function (event) {
        event.preventDefault();
        $('#createModal').modal('show');
    });

    $("#addForm").submit(function(event) {
        event.preventDefault();
        const myData = new FormData(this);
        myData.append('price_text',$('#price_text').val());
        create(myData);
    });

    $('#btn-add-close').click(function (event) {
        event.preventDefault();
        $('#addForm').trigger("reset");
        $('#createModal').modal('hide');
    });

    var magicalTimeout=1000;
    var timeout;


    $("#price").on('change rightnow', function(event) {
        event.preventDefault();
        clearTimeout(timeout);

        var getAmountOfUrl = $('#getAmountOfUrl').val();

        var that = this,
            value = $(this).val();
        value ='price='+ value;
        getAmountOfUrl = getAmountOfUrl.replace(':price',value);
        timeout=setTimeout(function(){
            getAmountOf(getAmountOfUrl,'')
                ,magicalTimeout
        });
    }).triggerHandler('change rightnow');

    $("#price_edit").on('change rightnow', function(event) {
        event.preventDefault();
        clearTimeout(timeout);

        var getAmountOfUrl = $('#getAmountOfUrl').val();

        var that = this,
            value = $(this).val();
        value ='price='+ value;
        getAmountOfUrl = getAmountOfUrl.replace(':price',value);
        timeout=setTimeout(function(){
            getAmountOf(getAmountOfUrl, '_edit')
                ,magicalTimeout
        });
    }).triggerHandler('change rightnow');


    function getAmountOf(getAmountOfUrl, action)
    {
        $.ajax({
            url: getAmountOfUrl,
            data: {},
            type: "GET",
            cache: false,
            processData: false,
            contentType: false,
        })
            .done(function (data) {
                $('#price_text'+action).val(data.price_text);
            })
            .fail(function (res) {
                $('#price_text'+action).val('');
                Snackbar.show({
                    text: res.responseJSON.message,
                    backgroundColor: '#e7515a',
                    showAction: false,
                    pos: 'top-center'
                });
            });
    }


    function create(myData)
    {
        removeErrorMessages();
        var saveUrl = $('#saveUrl').val();
        $.ajax({
            url: saveUrl,
            data: myData,
            type: "POST",
            cache: false,
            processData: false,
            contentType: false,
        })
            .done(function (data) {
                $('#addForm').trigger("reset");
                $('#createModal').modal('hide');
                table.ajax.reload();
                fireToast(data.message)
            })
            .fail(function (res) {
                if (res.status === 422)
                {
                    $.each(res.responseJSON.errors, function (key, value) {
                        Snackbar.show({
                            text: value,
                            backgroundColor: '#e7515a',
                            showAction: false,
                            pos: 'top-center'
                        });
                        $("#" + key).addClass('is-invalid');
                        $("#" + key +'_error').text(value);
                    });
                }else {
                    Snackbar.show({
                        text: res.responseJSON.message,
                        backgroundColor: '#e7515a',
                        showAction: false,
                        pos: 'top-center'
                    });
                }
            });
    }

    $('#btn-edit-close').click(function (event) {
        event.preventDefault();
        $('#editForm').trigger("reset");
        $('#editModal').modal('hide');
    });

    $('#btn-print-close').click(function (event) {
        event.preventDefault();
        $('#printModal').modal('hide');
    });

    $(document).on('click', '.btn-edit', function (event) {
        event.preventDefault();
        var uuid = $(event.currentTarget).data('uuid');
        $('#editModal').modal('show');
        uuid = 'uuid='+ uuid;
        var showUrl = $('#showUrl').val();
        showUrl = showUrl.replace(':uuid',uuid);
        getOne(showUrl);
    });



    $("#editForm").submit(function(event) {
        event.preventDefault();
        const editData = new FormData(this);
        editData.append('price_text',$('#price_text_edit').val());
        update(editData);
    });

    function update(editData)
    {
        removeErrorMessagesEditForm();
        var updateUrl = $('#updateUrl').val();
        $.ajax({
            url: updateUrl,
            data: editData,
            type: "POST",
            cache: false,
            processData: false,
            contentType: false,
        })
            .done(function (data) {
                $('#editForm').trigger("reset");
                $('#editModal').modal('hide');
                table.ajax.reload();
                fireToast(data.message)
            })
            .fail(function (res) {
                if (res.status === 422)
                {
                    $.each(res.responseJSON.errors, function (key, value) {
                        Snackbar.show({
                            text: value,
                            backgroundColor: '#e7515a',
                            showAction: false,
                            pos: 'top-center'
                        });
                        $("#" + key +'_edit').addClass('is-invalid');
                        $("#" + key +'_edit_error').text(value);
                    });
                }else {
                    Snackbar.show({
                        text: res.responseJSON.message,
                        backgroundColor: '#e7515a',
                        showAction: false,
                        pos: 'top-center'
                    });
                }
            });
    }

    function getOne(showUrl)
    {
        $.ajax({
            url: showUrl,
            data: {},
            type: "GET",
            cache: false,
            processData: false,
            contentType: false,
        })
            .done(function (data) {
                $('#customer_name_edit').val(data.payment.customer_name);
                $('#price_edit').val(data.payment.price);
                $('#price_text_edit').val(data.payment.price_text);
                $('#for_edit').val(data.payment.for);
                $('#id').val(data.payment.id);
                $('#uuid').val(data.payment.uuid);
                if (data.payment.payment_type === 'cash')
                {
                    $('#cash_edit').attr('checked',true);
                }else if(data.payment.payment_type === 'check'){
                    $('#check_edit').attr('checked',true);
                }
            })
            .fail(function (res) {
                Snackbar.show({
                    text: res.responseJSON.message,
                    backgroundColor: '#e7515a',
                    showAction: false,
                    pos: 'top-center'
                });
            });
    }

    $(document).on('click', '.btn-print', function (event) {
        event.preventDefault();
        var uuid = $(event.currentTarget).data('uuid');
        $('#printModal').modal('show');
        uuid = 'uuid='+ uuid;
        var showUrl = $('#showUrl').val();
        showUrl = showUrl.replace(':uuid',uuid);
        preparePrint(showUrl);
    });

    function preparePrint(showUrl)
    {
        $.ajax({
            url: showUrl,
            data: {},
            type: "GET",
            cache: false,
            processData: false,
            contentType: false,
        })
            .done(function (data) {
                $('#paymentID').text(data.payment.id);
                $('#paymentDate').text(data.payment_date);
                $('#customerName').text(data.payment.customer_name);
                $('#priceText').text(data.payment.price_text);
                $('#paymentType').text(data.payment_type);
                $('#andThatForPrint').text(data.payment.for);
            })
            .fail(function (res) {
                Snackbar.show({
                    text: res.responseJSON.message,
                    backgroundColor: '#e7515a',
                    showAction: false,
                    pos: 'top-center'
                });
            });
    }

    $(document).on('click', '.btn-delete', function (event) {
        const uuid = $(event.currentTarget).data('uuid');
        deleteOne(uuid);
    });

    function deleteOne(uuid)
    {
        Swal.fire({
            title: 'حذف سند صرف',
            text: 'لن تتمكن من التراجع عن هذا!',
            type: 'warning',
            iconHtml: '؟',
            showCancelButton: true,
            showCloseButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'نعم',
            cancelButtonText: 'لا',
        }).then((result) => {
            if (result.value)
            {
                $.ajax
                ({
                    url: deleteUrl,
                    type:'delete',
                    datatype:'json',
                    data: {
                        uuid: uuid
                    }
                })
                    .done(function (data) {
                        table.ajax.reload();
                        fireToast(data.message)
                    })
                    .fail(function (res) {
                        Snackbar.show({
                            text: res.responseJSON.message,
                            backgroundColor: '#e7515a',
                            showAction: false,
                            pos: 'top-center'
                        });
                    });
            }
        })
    }

    function removeErrorMessages()
    {
        var validated = $('#addForm').serializeArray();
        $.each(validated, function (key, value) {
            $("#" + value['name']).removeClass('is-invalid');
            $("#" + value['name'] +'_error').text("");
        });
    }

    function removeErrorMessagesEditForm()
    {
        var validated = $('#editForm').serializeArray();
        $.each(validated, function (key, value) {
            $("#" + value['name'] +'_edit').removeClass('is-invalid');
            $("#" + value['name'] +'_edit_error').text("");
        });
    }

    function fireToast(message)
    {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: message
        })
    }

});
