$(document).ready(function($){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const ordersGetUrl= $('#ordersGetUrl').val();
    const table = $('#orders-table').DataTable( {
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
            url : ordersGetUrl,

        }
        ,
        "columns": [
            {data:'code', name:'code'},
            {data:'customerName', name:'customerName'},
            {data:'customerPhone', name:'customerPhone'},
            {data:'status', name:'status'},
            {data:'delivery_date', name:'delivery_date'},
            {data:'total_price', name:'total_price'},
            {data:'comment', name:'comment', orderable:false, searchable:false},
            {data:'created_at', name:'created_at', orderable:false, searchable:false},
            {data:'actions', name:'actions'},
        ],
        "columnDefs": [
            {
                "targets": 'no-sort',
                "orderable": true
            },
            { targets: [0,5], visible: document.getElementById('userIsSuperAdmin').value === 'yes' }
        ]
    } );
    function populateData(
        phoneSearch = ''
        , selectOrderStatus = ''
        , selectFromDate = ''
        , orderCode = ''
        , idOrName = '')
    {
        const ordersGetUrl= $('#ordersGetUrl').val();
        var searchTable = $('#orders-table').DataTable( {
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
                url : ordersGetUrl,
                data: {
                    phoneSearch: phoneSearch,
                    selectOrderStatus: selectOrderStatus,
                    selectFromDate: selectFromDate,
                    orderCode: orderCode,
                    idOrName: idOrName,
                }
            }
            ,
            "columns": [
                {data:'code', name:'code'},
                {data:'customerName', name:'customerName'},
                {data:'customerPhone', name:'customerPhone'},
                {data:'status', name:'status'},
                {data:'delivery_date', name:'delivery_date'},
                {data:'total_price', name:'total_price'},
                {data:'comment', name:'comment', orderable:false, searchable:false},
                {data:'created_at', name:'created_at', orderable:false, searchable:false},
                {data:'actions', name:'actions'},
            ],
            "columnDefs": [
                {
                "targets": 'no-sort',
                "orderable": true
                },
                { targets: [0,5], visible: document.getElementById('userIsSuperAdmin').value === 'yes' }
            ]
        } );
    }



    $("#btn-search-order").click(function(event) {
        event.preventDefault();
        var phoneSearch = $('#phoneSearch').val();
        var selectOrderStatus = $('#selectOrderStatus').val();
        var selectFromDate = $('#selectFromDate').val();
        var orderCode = $('#orderCode').val();
        var idOrName = $('#idOrName').val();
        $('#orders-table').DataTable().clear().destroy();
        populateData(phoneSearch, selectOrderStatus, selectFromDate, orderCode, idOrName);
    });

    $("#addForm").submit(function(event) {
        event.preventDefault();
        const myData = new FormData(this);
        create(myData);
    });

    $('#create').click(function (event) {
        event.preventDefault();
        $('#createModal').modal('show');
    });

    $(document).on('click', '.btn-receiveOrder', function (event) {
        event.preventDefault();
        var uuid = $(event.currentTarget).data('uuid');
        $('#receiveOrderModal').modal('show');
        $('#order_uuid').val(uuid);
    });

    $(document).on('click', '.btn-showTracks', function (event) {
        event.preventDefault();
        var uuid = $(event.currentTarget).data('uuid');
        uuid = 'uuid='+ uuid;
        var showOrderLogsUrl = $('#showOrderLogsUrl').val();
        showOrderLogsUrl = showOrderLogsUrl.replace(':orderUUID',uuid);
        $('#showOrderLogsModal').modal('show');
        getOrderLogs(showOrderLogsUrl);
    });

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

    $(document).on('click', '.btn-sendOrderToStore', function (event) {
        var uuid = $(event.currentTarget).data('uuid');
        uuid = 'uuid='+ uuid;
        var sendToStoreUrl = $('#sendToStoreUrl').val();
        sendToStoreUrl = sendToStoreUrl.replace(':orderUUID',uuid);
        sendToStore(sendToStoreUrl);
    });

    function sendToStore(sendToStoreUrl)
    {
        Swal.fire({
            title: 'ارسال الطلب الى المتجر',
            text: 'هل انت متأكد من ارسال الطلب؟',
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
                    url: sendToStoreUrl,
                    data: {},
                    type: "POST",
                    cache: false,
                    processData: false,
                    contentType: false,
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

    $(document).on('click', '.btn-receiveOrderFromTailor', function (event) {
        var uuid = $(event.currentTarget).data('uuid');
        uuid = 'uuid='+ uuid;
        var receiveOrderFromTailorUrl = $('#receiveOrderFromTailorUrl').val();
        receiveOrderFromTailorUrl = receiveOrderFromTailorUrl.replace(':orderUUID',uuid);
        receiveOrderFromTailor(receiveOrderFromTailorUrl);
    });


    function receiveOrderFromTailor(receiveOrderFromTailorUrl)
    {
        Swal.fire({
            title: 'استلام الطلب من الخياط',
            text: 'هل انت متأكد من استلام الطلب من الخياط؟',
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
                    url: receiveOrderFromTailorUrl,
                    data: {},
                    type: "POST",
                    cache: false,
                    processData: false,
                    contentType: false,
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


    $("#receiveOrderForm").submit(function(event) {
        event.preventDefault();
        const myData = new FormData(this);
        receiveOrder(myData);
    });



    function receiveOrder(myData)
    {
        var receiveOrderUrl = $('#receiveOrderUrl').val();
        $.ajax({
            url: receiveOrderUrl,
            data: myData,
            type: "POST",
            cache: false,
            processData: false,
            contentType: false,
        })
            .done(function (data) {
                $('#receiveOrderForm').trigger("reset");
                $('#receiveOrderModal').modal('hide');
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
                resetCustomerData();
                controlDisabledCustomerData(true);
                controlDisabledSizes('_CreateOrder', true);
                resetSizes('_CreateOrder');
                fireToast(data.message);
                table.ajax.reload();
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

    var minlength = 10;
    var magicalTimeout=1000;
    var timeout;


    $("#phoneCreateOrder").on('keyup change rightnow', function(event) {
        event.preventDefault();
        clearTimeout(timeout);

        var showCustomerByPhoneUrl = $('#showCustomerByPhoneUrl').val();

        var that = this,
            value = $(this).val();
        if (value.length === minlength ) {
            value ='phone='+ value;
            showCustomerByPhoneUrl = showCustomerByPhoneUrl.replace(':phone',value);
            timeout=setTimeout(function(){
                getCustomerData(showCustomerByPhoneUrl)
            ,magicalTimeout
            });
        }else if (value.length != minlength ){
            controlDisabledSizes('_CreateOrder', true);
            controlDisabledCustomerData(true);
        }
    }).triggerHandler('keyup change rightnow');



    function getCustomerData(showCustomerByPhoneUrl)
    {
        $.ajax({
            url: showCustomerByPhoneUrl,
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
                    populateSizes(data.customer.customerSizes, '_CreateOrder');
                }
                controlDisabledCustomerData(false);
                controlDisabledSizes('_CreateOrder',false);
                fireToast(data.message)
            })
            .fail(function (res) {
                resetCustomerData();
                controlDisabledCustomerData(false);
                controlDisabledSizes('_CreateOrder', false);
                resetSizes('_CreateOrder');
                $('#newCustomer').val(1);
                Snackbar.show({
                    text: res.responseJSON.message,
                    backgroundColor: '#e7515a',
                    showAction: false,
                    pos: 'top-center'
                });
            });
    }

    function populateCustomer(customer)
    {
        $('#name_CreateOrder').val(customer.name);
        $('#email_CreateOrder').val(customer.email);
        $('#phone_CreateOrder').val(customer.phone);
        $('#additional_phone_CreateOrder').val(customer.additional_phone);
        $('#city_CreateOrder').val(customer.city);
        $('#address_CreateOrder').val(customer.address);
        $('#customer_id_CreateOrder').val(customer.id);
        if (customer.special_customer === 1)
        {
            $('#special_customer_CreateOrder').attr('checked',true);
        }else {
            $('#special_customer_CreateOrder').attr('checked',false);
        }
    }

    function controlDisabledCustomerData(flag)
    {
        $('#delivery_date').prop( "disabled", flag );
        $('#comment').prop( "disabled", flag );
        $('#name_CreateOrder').prop( "disabled", flag );
        $('#email_CreateOrder').prop( "disabled", flag );
        $('#additional_phone_CreateOrder').prop( "disabled", flag );
        $('#city_CreateOrder').prop( "disabled", flag );
        $('#address_CreateOrder').prop( "disabled", flag );
        $('#special_customer_CreateOrder').prop( "disabled", flag );
    }

    function resetCustomerData()
    {
        $('#name_CreateOrder').val('');
        $('#email_CreateOrder').val('');
        $('#phone_CreateOrder').val('');
        $('#additional_phone_CreateOrder').val('');
        $('#city_CreateOrder').val('');
        $('#address_CreateOrder').val('');
        $('#customer_id_CreateOrder').val('');
        if ($('#special_customer_CreateOrder').is(":checked"))
        {
            $('#special_customer_CreateOrder').attr('checked',false);
        }
    }

    function controlDisabledSizes(action, flag)
    {
        $('#D1_TawlAmam' +action).prop( "disabled", flag );
        $('#D2_Katef' +action).prop( "disabled", flag );
        $('#D3_YadSadda' +action).prop( "disabled", flag );
        $('#D4_WasaWest' +action).prop( "disabled", flag );
        $('#D5_RaqabaKalab' +action).prop( "disabled", flag );
        $('#D6_WasaYad' +action).prop( "disabled", flag );
        $('#D7_Mafsal' + action).prop( "disabled", flag );
        $('#D8_Ibet' + action).prop( "disabled", flag );
        $('#D9_BodKabk' + action).prop( "disabled", flag );
        $('#D10_Note1' + action).prop( "disabled", flag );
        $('#D11_TawlKalf' +action).prop( "disabled", flag );
        $('#D12_TanzeletKatf' +action).prop( "disabled", flag );
        $('#D13_YadKabak' +action).prop( "disabled", flag );
        $('#D14_Sader' +action).prop( "disabled", flag );
        $('#D15_Raqaba_Sada' +action).prop( "disabled", flag );
        $('#D16_WasatYad' +action).prop( "disabled", flag );
        $('#D17_Khaser' +action).prop( "disabled", flag );
        $('#D18_Takhales' +action).prop( "disabled", flag );
        $('#D19_Khatwa' +action).prop( "disabled", flag );
        $('#D20_Note2' +action).prop( "disabled", flag );
        $('#D21_Raqaba' +action).prop( "disabled", flag );
        $('#D22_Jabzor' +action).prop( "disabled", flag );
        $('#D23_Kabak' +action).prop( "disabled", flag );
        $('#D24_JeebJanby' +action).prop( "disabled", flag );
        $('#D25_Jeeb' +action).prop( "disabled", flag );
        $('#D26_Weight' +action).prop( "disabled", flag );
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

    function resetSizes(action)
    {
        $('#D1_TawlAmam' +action).val('');
        $('#D2_Katef' +action).val('');
        $('#D3_YadSadda' +action).val('');
        $('#D4_WasaWest' +action).val('');
        $('#D5_RaqabaKalab' +action).val('');
        $('#D6_WasaYad' +action).val('');
        $('#D7_Mafsal' + action).val('');
        $('#D8_Ibet' + action).val('');
        $('#D9_BodKabk' + action).val('');
        $('#D10_Note1' + action).val('');
        $('#D11_TawlKalf' +action).val('');
        $('#D12_TanzeletKatf' +action).val('');
        $('#D13_YadKabak' +action).val('');
        $('#D14_Sader' +action).val('');
        $('#D15_Raqaba_Sada' +action).val('');
        $('#D16_WasatYad' +action).val('');
        $('#D17_Khaser' +action).val('');
        $('#D18_Takhales' +action).val('');
        $('#D19_Khatwa' +action).val('');
        $('#D20_Note2' +action).val('');
        $('#D21_Raqaba' +action).val('');
        $('#D22_Jabzor' +action).val('');
        $('#D23_Kabak' +action).val('');
        $('#D24_JeebJanby' +action).val('');
        $('#D25_Jeeb' +action).val('');
        $('#D26_Weight' +action).val('');
    }

    function removeErrorMessages()
    {
        var validated = $('#addForm').serializeArray();

        $.each(validated, function (key, value) {
            if (value['name'] ==='phoneCreateOrder' || value['name'] ==='delivery_date' || value['name'] ==='email')
            {
                $("#" + value['name']).removeClass('is-invalid');
                $("#" + value['name'] +'_error').text("");
            }
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
