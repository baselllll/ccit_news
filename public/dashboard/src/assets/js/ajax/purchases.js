const idsArr = [];
function calcItem(value){
    var qty = parseFloat($("#itemQTY_"+value).val());
    var itemPrice = parseFloat($("#itemPrice_"+value).val());
    itemPrice = qty * itemPrice ;
    $("#totalBeforeVAT_"+value).val(itemPrice)
    var VAT = parseFloat($("#VAT").val()) / 100;
    var VAT_value = itemPrice * VAT;
    VAT_value = parseFloat(VAT_value).toFixed(2)
    $("#VAT_value_"+value).val(VAT_value);
    var totalAfterVAT = parseFloat(itemPrice) + parseFloat(VAT_value);
    $("#totalAfterVAT_"+value).val(totalAfterVAT);
    idsArr.push(value);
    updateInvoice(idsArr);
}

function updateInvoice(idsArr)
{
    var unique = idsArr.filter(function(itm, i, idsArr) {
        return i == idsArr.indexOf(itm);
    });
    var totalBeforeDiscount = parseFloat(0);
    $.each(unique, function (key,itemID) {
        var qty = parseFloat($("#itemQTY_"+itemID).val());
        var itemPrice = parseFloat($("#itemPrice_"+itemID).val());
        itemPrice = qty * itemPrice ;
        totalBeforeDiscount += parseFloat(itemPrice);
    });
    $("#totalBeforeDiscount").val(totalBeforeDiscount);
    $("#totalBeforeVAT").val(totalBeforeDiscount);
    var VAT = parseFloat($("#VAT").val()) / 100;
    var VAT_value = totalBeforeDiscount * VAT;
    $("#VAT_price").val(VAT_value);
    var totalAfterVAT = VAT_value + totalBeforeDiscount;
    $("#totalAfterVAT").val(totalAfterVAT);
}

$(document).ready(function($){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const url= $('#getUrl').val();
    const deleteUrl = $('#deleteUrl').val();
    const vat = $('#VAT').val();

    var table = $('#purchases-table').DataTable( {
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
            {data:'taxNumber',name:'taxNumber', orderable:false, searchable:false},
            {data:'supplierName', name:'supplierName'},
            {data:'taxDate', name:'taxDate'},
            {data:'totalBeforeVAT', name:'totalBeforeVAT'},
            {data:'VAT_price', name:'VAT_price'},
            {data:'totalAfterVAT', name:'totalAfterVAT', orderable:false, searchable:false},
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
        myData.append('totalBeforeDiscount',$("#totalBeforeDiscount").val());
        myData.append('totalBeforeVAT',$("#totalBeforeVAT").val());
        myData.append('VAT_price',$("#VAT_price").val());
        myData.append('totalAfterVAT',$("#totalAfterVAT").val());
        myData.append('VAT_percentage',$("#VAT_percentage").val());
        create(myData);
    });

    $('#btn-add-close').click(function (event) {
        event.preventDefault();
        $('#addForm').trigger("reset");
        $('#createModal').modal('hide');
    });

    $('#btn-show-close').click(function (event) {
        event.preventDefault();
        $('#showModal').modal('hide');
    });

    var minlength = 1;
    var magicalTimeout=1000;
    var timeout;
    $("#supplier_id").on('change rightnow', function(event) {
        event.preventDefault();
        clearTimeout(timeout);

        var showSupplierByUUID_url = $('#showSupplierByUUID_url').val();
        var that = this,
            value = $(this).val();
        if (value) {
            value ='id='+ value;
            showSupplierByUUID_url = showSupplierByUUID_url.replace(':id',value);
            console.log(showSupplierByUUID_url)
            timeout=setTimeout(function(){
                getSupplierData(showSupplierByUUID_url)
                    ,magicalTimeout
            });
        }else if (value.length < minlength ){
            controlDisabledSupplierData(true);
        }
    }).triggerHandler('change rightnow');

    function getSupplierData(showSupplierByUUID_url)
    {
        $.ajax({
            url: showSupplierByUUID_url,
            data: {},
            type: "GET",
            cache: false,
            processData: false,
            contentType: false,
        })
            .done(function (data) {
                populateSupplier(data.supplier);
                controlDisabledSupplierData(false);
                fireToast(data.message)
            })
            .fail(function (res) {
                resetSupplierData();
                controlDisabledSupplierData(false);
                Snackbar.show({
                    text: res.responseJSON.message,
                    backgroundColor: '#e7515a',
                    showAction: false,
                    pos: 'top-center'
                });
            });
    }

    function populateSupplier(supplier)
    {
        $('#supplierName').val(supplier.name);
        $('#supplierAddress').val(supplier.address);
        $('#supplierTaxNumber').val(supplier.taxNumber);
    }

    function controlDisabledSupplierData(flag)
    {
        $('#supplierName').prop( "disabled", flag );
        $('#supplierAddress').prop( "disabled", flag );
        $('#supplierTaxNumber').prop( "disabled", flag );
    }

    function resetSupplierData()
    {
        $('#supplierName').val('');
        $('#supplierAddress').val('');
        $('#supplierTaxNumber').val('');
    }

    function create(myData)
    {
        // removeErrorMessages();
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
                        // $("#" + key).addClass('is-invalid');
                        // $("#" + key +'_error').text(value);
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


    $("#btn-addItem").click(function(){
        const randomNum = Math.floor((Math.random() * 100000) + 1);
        var template =  '<tr>\n' +
            '                                                <td style="padding: 10px 0px 10px 5px;">\n' +
            '                                                    <input\n' +
            '                                                        type="text"\n' +
            '                                                        name="items['+randomNum+'][itemName]"\n' +
            '                                                        id="itemName_'+randomNum+'"\n' +
            '                                                        required\n' +
            '                                                        class="form-control">\n' +
            '                                                </td>\n' +
            '                                                <td style="padding: 10px 0px 10px 5px;">\n' +
            '                                                    <input\n' +
            '                                                        type="text"\n' +
            '                                                        name="items['+randomNum+'][itemCode]"\n' +
            '                                                        id="itemCode_'+randomNum+'"\n' +
            '                                                        required\n' +
            '                                                        class="form-control">\n' +
            '                                                </td>\n' +
            '                                                <td style="padding: 10px 0px 10px 5px;">\n' +
            '                                                    <input\n' +
            '                                                        type="text"\n' +
            '                                                        name="items['+randomNum+'][itemNumber]"\n' +
            '                                                        id="itemNumber_'+randomNum+'"\n' +
            '                                                        required\n' +
            '                                                        class="form-control">\n' +
            '                                                </td>\n' +
            '                                                <td style="padding: 10px 0px 10px 5px;">\n' +
            '                                                    <input\n' +
            '                                                        type="text"\n' +
            '                                                        name="items['+randomNum+'][itemQTY]"\n' +
            '                                                        id="itemQTY_'+randomNum+'"\n' +
            '                                                        onchange="calcItem('+randomNum+');"\n' +
            '                                                        min="1"\n' +
            '                                                        value="1"\n' +
            '                                                        required\n' +
            '                                                        class="form-control">\n' +
            '                                                </td>\n' +
            '                                                <td style="padding: 10px 0px 10px 5px;">\n' +
            '                                                    <input\n' +
            '                                                        type="text"\n' +
            '                                                        name="items['+randomNum+'][itemPrice]"\n' +
            '                                                        id="itemPrice_'+randomNum+'"\n' +
            '                                                        onchange="calcItem('+randomNum+');" \n' +
            '                                                        value="0"\n' +
            '                                                        min="0"\n' +
            '                                                        required' +
            '                                                        class="form-control">\n' +
            '                                                </td>\n' +
            '                                                <td style="padding: 10px 0px 10px 5px;">\n' +
            '                                                    <input\n' +
            '                                                        type="text"\n' +
            '                                                        name="items['+randomNum+'][totalBeforeVAT]"\n' +
            '                                                        id="totalBeforeVAT_'+randomNum+'"\n' +
            '                                                        value="0"\n' +
            '                                                        min="0"\n' +
            '                                                        required\n' +
            '                                                        class="form-control">\n' +
            '                                                </td>\n' +
            '                                                <td style="padding: 10px 0px 10px 5px;">\n' +
            '                                                    <input\n' +
            '                                                        type="text"\n' +
            '                                                        name="items['+randomNum+'][VAT]"\n' +
            '                                                        id="VAT_'+randomNum+'"\n' +
            '                                                        min="0"\n' +
            '                                                        required\n' +
            '                                                        value="'+vat+'"' +
            '                                                        class="form-control VATOnItem">\n' +
            '                                                </td>\n' +
            '                                                <td style="padding: 10px 0px 10px 5px;">\n' +
            '                                                    <input\n' +
            '                                                        type="text"\n' +
            '                                                        name="items['+randomNum+'][VAT_value]"\n' +
            '                                                        id="VAT_value_'+randomNum+'"\n' +
            '                                                        min="0"\n' +
            '                                                        required\n' +
            '                                                        value="0"\n' +
            '                                                        class="form-control">\n' +
            '                                                </td>\n' +
            '                                                <td style="padding: 10px 0px 10px 5px;">\n' +
            '                                                    <input\n' +
            '                                                        type="text"\n' +
            '                                                        name="items['+randomNum+'][totalAfterVAT]"\n' +
            '                                                        id="totalAfterVAT_'+randomNum+'"\n' +
            '                                                        min="0"\n' +
            '                                                        required\n' +
            '                                                        value="0"\n' +
            '                                                        class="form-control">\n' +
            '                                                </td>\n' +
            '                                                <td style="padding: 10px 0px 10px 5px;">\n' +
            '                                                    <div class=" mt-2">\n' +
            '                                                        <a href="javascript:void(0);" class="remCF">\n' +
            '                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>\n' +
            '                                                        </a>\n' +
            '                                                    </div>\n' +
            '                                                </td>\n' +
            '                                            </tr>';
        $("#purchases-items-table").append(template);
    });

    $("#purchases-items-table").on('click','.remCF',function(){
        $(this).parent().parent().parent().remove();
    });


    $(document).on('click', '.btn-show', function (event) {
        event.preventDefault();
        var uuid = $(event.currentTarget).data('uuid');
        $('#showModal').modal('show');
        uuid = 'uuid='+ uuid;
        var showUrl = $('#showUrl').val();
        showUrl = showUrl.replace(':uuid',uuid);
        getOne(showUrl);
    });

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
                populateInvoice(data.purchase);
                populateItems(data.purchase.details);
                populateFiles(data.files);
                $('#qtySum').val(data.qtySum);
                $('#priceSum').val(data.priceSum);
                $('#totalBeforeVatSum').val(data.totalBeforeVatSum);
                $('#VAT_valueSum').val(data.VAT_valueSum);
                $('#totalAfterVATSum').val(data.totalAfterVATSum);
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


    function populateInvoice(invoice)
    {
        $('#purchaseNumberShow').text(invoice.taxNumber);
        $('#taxNumberShow').val(invoice.taxNumber);
        $('#totalBeforeDiscountShow').val(invoice.totalBeforeDiscount);
        $('#taxDateShow').val(invoice.taxDate);
        $('#discountPercentageShow').val(invoice.discountPercentage);
        $('#discountPriceShow').val(invoice.discountPrice);
        $('#totalBeforeVATShow').val(invoice.totalBeforeVAT);
        $('#VAT_priceShow').val(invoice.VAT_price);
        $('#totalAfterVATShow').val(invoice.totalAfterVAT);
        $('#supplierNameShow').val(invoice.supplier.name);
        $('#supplierAddressShow').val(invoice.supplier.address);
        $('#supplierTaxNumberShow').val(invoice.supplier.taxNumber);
    }

    function populateItems(items)
    {
        var template;
        var drawAll = '';
        $.each(items, function( index, item ) {
            template =  '<tr>\n' +
                '                                                <td style="padding: 10px 0px 10px 5px;">\n' +
                '                                                    <input\n' +
                '                                                        type="text"\n' +
                '                                                        value="'+item.itemName+'"\n' +
                '                                                        disabled\n' +
                '                                                        required\n' +
                '                                                        class="form-control">\n' +
                '                                                </td>\n' +
                '                                                <td style="padding: 10px 0px 10px 5px;">\n' +
                '                                                    <input\n' +
                '                                                        type="text"\n' +
                '                                                        value="'+item.itemCode+'"\n' +
                '                                                        disabled\n' +
                '                                                        required\n' +
                '                                                        class="form-control">\n' +
                '                                                </td>\n' +
                '                                                <td style="padding: 10px 0px 10px 5px;">\n' +
                '                                                    <input\n' +
                '                                                        type="text"\n' +
                '                                                        value="'+item.itemNumber+'"\n' +
                '                                                        disabled\n' +
                '                                                        required\n' +
                '                                                        class="form-control">\n' +
                '                                                </td>\n' +
                '                                                <td style="padding: 10px 0px 10px 5px;">\n' +
                '                                                    <input\n' +
                '                                                        type="text"\n' +
                '                                                        value="'+item.itemQTY+'"\n' +
                '                                                        disabled\n' +
                '                                                        min="1"\n' +
                '                                                        value="1"\n' +
                '                                                        required\n' +
                '                                                        class="form-control">\n' +
                '                                                </td>\n' +
                '                                                <td style="padding: 10px 0px 10px 5px;">\n' +
                '                                                    <input\n' +
                '                                                        type="text"\n' +
                '                                                        value="'+item.itemPrice+'"\n' +
                '                                                        disabled\n' +
                '                                                        value="0"\n' +
                '                                                        min="0"\n' +
                '                                                        required' +
                '                                                        class="form-control">\n' +
                '                                                </td>\n' +
                '                                                <td style="padding: 10px 0px 10px 5px;">\n' +
                '                                                    <input\n' +
                '                                                        type="text"\n' +
                '                                                        value="'+item.totalBeforeVAT+'"\n' +
                '                                                        disabled\n' +
                '                                                        value="0"\n' +
                '                                                        min="0"\n' +
                '                                                        required\n' +
                '                                                        class="form-control">\n' +
                '                                                </td>\n' +
                '                                                <td style="padding: 10px 0px 10px 5px;">\n' +
                '                                                    <input\n' +
                '                                                        type="text"\n' +
                '                                                        value="'+item.VAT+'"\n' +
                '                                                        disabled\n' +
                '                                                        min="0"\n' +
                '                                                        required\n' +
                '                                                        class="form-control VATOnItem">\n' +
                '                                                </td>\n' +
                '                                                <td style="padding: 10px 0px 10px 5px;">\n' +
                '                                                    <input\n' +
                '                                                        type="text"\n' +
                '                                                        value="'+item.VAT_value+'"\n' +
                '                                                        disabled\n' +
                '                                                        min="0"\n' +
                '                                                        required\n' +
                '                                                        value="0"\n' +
                '                                                        class="form-control">\n' +
                '                                                </td>\n' +
                '                                                <td style="padding: 10px 0px 10px 5px;">\n' +
                '                                                    <input\n' +
                '                                                        type="text"\n' +
                '                                                        value="'+item.totalAfterVAT+'"\n' +
                '                                                        disabled\n' +
                '                                                        min="0"\n' +
                '                                                        required\n' +
                '                                                        value="0"\n' +
                '                                                        class="form-control">\n' +
                '                                                </td>\n' +
                '                                            </tr>';
            drawAll += template;
            });
        $("#purchases-items-table-show").html(drawAll);
    }

    function populateFiles(files)
    {
        var template;
        var drawAll = '';
        $.each(files, function( index, file ) {
            template =
                '<div class="col-md-6">\n' +
                '  <a href="'+file.file+'" style="color: #0a53be" target="_blank">'+file.uuid+'</a>\n' +
                '</div>';
            drawAll += template;
        });
        $("#filesArea").html(drawAll);
    }

    function removeErrorMessages()
    {
        var validated = $('#addForm').serializeArray();
        $.each(validated, function (key, value) {
            $("#" + value['name']).removeClass('is-invalid');
            $("#" + value['name'] +'_error').text("");
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
