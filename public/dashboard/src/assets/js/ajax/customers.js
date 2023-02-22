$(document).ready(function($){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const url= $('#getUrl').val();
    const deleteUrl = $('#deleteUrl').val();
    var table = $('#customers-table').DataTable( {
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
        "ajax": {
            url : url,

        }
        ,
        "columns": [
            {data:'id', name:'id'},
            {data:'name', name:'name'},
            {data:'phone', name:'phone'},
            {data:'city', name:'city'},
            {data:'clothes_num', name:'clothes_num'},
            {data:'sizes', name:'sizes', orderable:false, searchable:false},
            {data:'actions', name:'actions'},
        ],
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false
        }]
    });

    function populateData(phoneSearch = '', idOrName = '', selectFromDate = '')
    {
        var searchTable = $('#customers-table').DataTable( {
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
                url : url,
                data: {
                    phoneSearch: phoneSearch,
                    idOrName: idOrName,
                    selectFromDate: selectFromDate,
                }
            }
            ,
            "columns": [
                {data:'id', name:'id'},
                {data:'name', name:'name'},
                {data:'phone', name:'phone'},
                {data:'city', name:'city'},
                {data:'clothes_num', name:'clothes_num'},
                {data:'sizes', name:'sizes', orderable:false, searchable:false},
                {data:'actions', name:'actions'},
            ],
            "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false
            }]
        } );
    }

    $("#btn-search-customer").click(function(event) {
        event.preventDefault();
        var phoneSearch = $('#phoneSearch').val();
        var idOrName = $('#idOrName').val();
        var selectFromDate = $('#selectFromDate').val();
        $('#customers-table').DataTable().clear().destroy();
        populateData(phoneSearch, idOrName, selectFromDate);
    });

    $('#create').click(function (event) {
        event.preventDefault();
        $('#createModal').modal('show');
    });

    $('#btn-edit-close').click(function (event) {
        event.preventDefault();
        $('#editForm').trigger("reset");
        $('#editModal').modal('hide');
    });

    $('#btn-show-close').click(function (event) {
        event.preventDefault();
        $('#showModal').modal('hide');
    });

    $('#btn-add-close').click(function (event) {
        event.preventDefault();
        $('#addForm').trigger("reset");
        $('#createModal').modal('hide');
    });

    $("#addForm").submit(function(event) {
        event.preventDefault();
        const myData = new FormData(this);
        create(myData);
    });

    $("#editForm").submit(function(event) {
        event.preventDefault();
        const editData = new FormData(this);
        update(editData);
    });


    $(document).on('click', '.btn-delete', function (event) {
        const uuid = $(event.currentTarget).data('uuid');
        deleteOne(uuid);
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

    $(document).on('click', '.btn-show', function (event) {
        event.preventDefault();
        var uuid = $(event.currentTarget).data('uuid');
        $('#showModal').modal('show');
        uuid = 'uuid='+ uuid;
        var showUrl = $('#showUrl').val();
        showUrl = showUrl.replace(':uuid',uuid);
        showOne(showUrl);
    });

    $(document).on('click', '.cust-show-order-log', function (event) {
        event.preventDefault();
        var uuid = $(event.currentTarget).data('uuid');
        uuid = 'uuid='+ uuid;
        var showOrderLogsUrl = $('#showOrderLogsUrl').val();
        showOrderLogsUrl = showOrderLogsUrl.replace(':orderUUID',uuid);
        console.log(showOrderLogsUrl)
        $('#showOrderLogsModal').modal('show');
        getOrderLogs(showOrderLogsUrl);
    });

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
                $('#name_edit').val(data.customer.name);
                $('#email_edit').val(data.customer.email);
                $('#phone_edit').val(data.customer.phone);
                $('#additional_phone_edit').val(data.customer.additional_phone);
                $('#city_edit').val(data.customer.city);
                $('#address_edit').val(data.customer.address);
                if (data.customer.customerSizes != null)
                {
                    populateSizes(data.customer.customerSizes, '_edit');
                }
                if (data.customer.special_customer === 1)
                {
                    $('#special_customer_edit').attr('checked',true);
                }else {
                    $('#special_customer_edit').attr('checked',false);
                }
                $('#id').val(data.customer.id);
                $('#uuid').val(data.customer.uuid);
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


    function getOrderLogs(showOrderLogsUrl)
    {
        $.ajax({
            url: showOrderLogsUrl,
            data: {},
            type: "GET",
            cache: false,
            processData: false,
            contentType: false,
        })
            .done(function (data) {
                if (data.logs != null)
                {
                    drawOrderLogs(data.logs);
                }
            })
            .fail(function (res) {
                $('#showOrderLogsModal').modal('hide');
                Snackbar.show({
                    text: res.responseJSON.message,
                    backgroundColor: '#e7515a',
                    showAction: false,
                    pos: 'top-center'
                });
            });
    }

    function drawOrderLogs(logs)
    {
        $('#timeline-line-logs').html('');
        $.each(logs, function (key, value) {
            $('#timeline-line-logs').append('<div class="item-timeline">\n' +
                '<p class="t-time">'+value.action+'</p>\n' +
                '<div class="t-dot t-dot-'+value.label_style+'">\n' +
                '</div>\n' +
                '<div class="t-text">\n' +
                '<p>'+value.description+'</p>\n' +
                '<p class="t-meta-time">'+value.created_at+'</p>\n' +
                '</div>\n' +
                '</div>')
        });
    }

    function showOne(showUrl)
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
                populateCustomer(data.customer);
                if (data.customer.customerSizes != null)
                {
                    populateSizes(data.customer.customerSizes, '_show');
                }

                if (data.customer.orders != null)
                {
                    drawOrders(data.customer.orders);
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

    function deleteOne(uuid)
    {
        Swal.fire({
            title: 'حذف عميل',
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


    function populateSizes(sizes, action)
    {
        $('#D1_TawlAmam' +action).val(sizes.D1_TawlAmam);
        $('#D2_Katef' +action).val(sizes.D2_Katef);
        $('#D3_YadSadda' +action).val(sizes.D3_YadSadda);
        $('#D4_WasaWest' +action).val(sizes.D4_WasaWest);
        $('#D5_RaqabaKalab' +action).val(sizes.D5_RaqabaKalab);
        $('#D6_WasaYad' +action).val(sizes.D6_WasaYad);
        $('#D7_Mafsal' + action).val(sizes.D7_Mafsal);
        $('#D8_Ibet' + action).val(sizes.D8_Ibet);
        $('#D9_BodKabk' + action).val(sizes.D9_BodKabk);
        $('#D10_Note1' + action).val(sizes.D10_Note1);
        $('#D11_TawlKalf' +action).val(sizes.D11_TawlKalf);
        $('#D12_TanzeletKatf' +action).val(sizes.D12_TanzeletKatf);
        $('#D13_YadKabak' +action).val(sizes.D13_YadKabak);
        $('#D14_Sader' +action).val(sizes.D14_Sader);
        $('#D15_Raqaba_Sada' +action).val(sizes.D15_Raqaba_Sada);
        $('#D16_WasatYad' +action).val(sizes.D16_WasatYad);
        $('#D17_Khaser' +action).val(sizes.D17_Khaser);
        $('#D18_Takhales' +action).val(sizes.D18_Takhales);
        $('#D19_Khatwa' +action).val(sizes.D19_Khatwa);
        $('#D20_Note2' +action).val(sizes.D20_Note2);
        $('#D21_Raqaba' +action).val(sizes.D21_Raqaba);
        $('#D22_Jabzor' +action).val(sizes.D22_Jabzor);
        $('#D23_Kabak' +action).val(sizes.D23_Kabak);
        $('#D24_JeebJanby' +action).val(sizes.D24_JeebJanby);
        $('#D25_Jeeb' +action).val(sizes.D25_Jeeb);
        $('#D26_Weight' +action).val(sizes.D26_Weight);
    }

    function populateCustomer(customer)
    {
        $('#name_show').val(customer.name);
        $('#email_show').val(customer.email);
        $('#phone_show').val(customer.phone);
        $('#additional_phone_show').val(customer.additional_phone);
        $('#city_show').val(customer.city);
        $('#address_show').val(customer.address);
        if (customer.special_customer === 1)
        {
            $('#special_customer_show').attr('checked',true);
        }else {
            $('#special_customer_show').attr('checked',false);
        }
        $('#id').val(customer.id);
        $('#uuid').val(customer.uuid);
    }

    function drawOrders(orders)
    {
        $('#customer-orders-table tbody').empty();
        $.each(orders, function (key, value) {
            console.log(value.code);
            $('#customer-orders-table tbody').append('<tr>\n' +
                '<td><div class="td-content product-brand text-primary">'+value.id+'</div></td>\n' +
                '<td><div class="td-content"><span class="badge badge-'+value.status_style+'">'+value.status+'</span></div></td>\n' +
                '<td><div class="td-content product-invoice">'+value.delivery_date+'</div></td>\n' +
                '<td><div class="td-content product-invoice">'+value.clothes_num+'</div></td>\n' +
                '<td><div class="td-content pricing"><span class="">'+value.total_price+'</span></div></td>\n' +
                '<td><div class="td-content pricing"><span class="">'+value.deposit+'</span></div></td>\n' +
                '<td><div class="td-content pricing">'+value.comment+'</div></td>\n' +
                '<td><div class="td-content pricing">' +
                '<a class="badge badge-light-primary text-start me-2 action-edit cust-show-order-log" title="عرض الحركات" data-uuid="'+value.uuid+'"><i class="far fa-chart-bar"></i></a>' +
                '<a class="badge badge-light-primary text-start me-2 action-edit" target="_blank" title="عرض تفاصيل الطلب" href="/admin/orders/edit/'+value.uuid+'"><i class="far fa-eye"></i></a>' +
                '<a class="badge badge-light-primary text-start me-2 action-edit" target="_blank" title="عرض مقاسات الثياب" href="/admin/orders/show/print/'+value.uuid+'"><i class="far fa-keyboard"></i></a>' +
                '<a class="badge badge-light-primary text-start me-2 action-edit" target="_blank" title="فاتورة" href="/admin/orders/show/invoice/'+value.uuid+'"><i class="far fa-money-bill-alt"></i></a>' +
                '</div></td>\n' +
                '</tr>')
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
