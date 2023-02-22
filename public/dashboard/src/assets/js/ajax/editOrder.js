function getShapeImage(shapeTypeUUID, imageUrl)
{
    $('#shapeImage_' + shapeTypeUUID).attr('src', imageUrl).show();
}

$(document).ready(function($){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const VAT = $('#generalSettingsVAT').val();

    $('#createNewDressBtn').click(function (event) {
        event.preventDefault();
        $('#createNewDressModal').modal('show');
    });


    $('#createNewDiscountBtn').click(function (event) {
        event.preventDefault();
        $('#createNewDiscountModal').modal('show');
        $('#modal-discount-title').text($(this).data('text'));
    });


    $(document).on('click', '.createIndividualDiscountBtn', function (event) {
        event.preventDefault();
        var uuid = $(event.currentTarget).data('uuid');
        uuid = 'uuid='+ uuid;
        var showSingleDressUrl = $('#showSingleDressUrl').val();
        showSingleDressUrl = showSingleDressUrl.replace(':dressUUID',uuid);
        $('#createIndividualDiscountModal').modal('show');
        getDressValue(showSingleDressUrl)
    });

    function getDressValue(showSingleDressUrl)
    {
        $.ajax({
            url: showSingleDressUrl,
            data: {},
            type: "GET",
            cache: false,
            processData: false,
            contentType: false,
        })
            .done(function (data) {
                console.log(data)
                $('#dress_uuid').val(data.dress.uuid);
                $('#total_dress_cost_create').val(data.dress.total);
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

    $("#createIndividualDiscountForm").submit(function(event) {
        event.preventDefault();
        const myData = new FormData(this);
        createSingleDiscount(myData);
    });

    $('#btn-createNewDressForm-close').click(function (event) {
        event.preventDefault();
        $('#createNewDressForm').trigger("reset");
        $('#createNewDressModal').modal('hide');
    });


    $('#btn-createNewDiscount-close').click(function (event) {
        event.preventDefault();
        $('#createNewDiscountForm').trigger("reset");
        $('#createNewDiscountModal').modal('hide');
    });

    $('#useOrderSizes_CreateDress').on('change', function() {
        if ($(this).prop('checked')) $('#orderSizes').hide();
        else $('#orderSizes').show();
    });

    $('#createNewDepositBtn').click(function (event) {
        event.preventDefault();
        $('#createNewDepositModal').modal('show');
    });

    $('#btn-createNewDeposit-close').click(function (event) {
        event.preventDefault();
        $('#createNewDepositForm').trigger("reset");
        $('#createNewDepositModal').modal('hide');
    });


    var magicalTimeout=1000;
    var timeout;

    $("#selectFabric").on('change rightnow', function(event) {
        event.preventDefault();
        clearTimeout(timeout);

        var getPriceByIdUrl = $('#getPriceByIdUrl').val();

        var that = this,
            value = $(this).val();
        value ='id='+ value;
        getPriceByIdUrl = getPriceByIdUrl.replace(':id',value);
        timeout=setTimeout(function(){
            getPriceForOneFabric(getPriceByIdUrl)
                ,magicalTimeout
        });
    }).triggerHandler('keyup change rightnow');

    $("#clothes_num").on('keyup change rightnow', function(event) {
        event.preventDefault();
        clearTimeout(timeout);

        var priceForOneDress = $('#price_for_one_fabric').val();
        var that = this,
            value = $(this).val();
        var maxNum = $(this).attr('max');
        timeout=setTimeout(function(){
            if (parseInt(value) > parseInt(maxNum)){
                $("#clothes_num").val(maxNum);
            }else{
                var total = priceForOneDress * value;
                $('#total').val(total);
                var grandTotal = parseFloat(total) + parseFloat(total * VAT);
                $('#grandTotal').text(grandTotal);
                $('#grandTotalInput').val(grandTotal);
            }
        });
    }).triggerHandler('keyup change rightnow');

    $("#accessories").on('change', function(event) {
        event.preventDefault();
        clearTimeout(timeout);

        var total = $('#total').val();
        var that = this,
            value = $(this).val();
        timeout=setTimeout(function(){
            var accessories = parseFloat(value) + parseFloat(value * VAT);
            var grandTotal = parseFloat(total) + parseFloat(total * VAT);
            grandTotal = parseFloat(grandTotal) + accessories;
            $('#grandTotal').text(grandTotal);
            $('#grandTotalInput').val(grandTotal);
        });
    }).triggerHandler('change');

    $("#embroidery").on(' change', function(event) {
        event.preventDefault();
        clearTimeout(timeout);

        var total = $('#total').val();
        var accessories = $('#accessories').val();
        var that = this,
            value = $(this).val();
        timeout=setTimeout(function(){
            var accessoriesVat = parseFloat(accessories) + parseFloat(value * VAT);
            var grandTotal = parseFloat(total) + parseFloat(total * VAT);
            var embroidery = parseFloat(value) + parseFloat(value * VAT);
            grandTotal = parseFloat(grandTotal) + accessoriesVat + embroidery;
            $('#grandTotal').text(grandTotal);
            $('#grandTotalInput').val(grandTotal);
        });
    }).triggerHandler('change');


    $("#urgent").on('change', function(event) {
        event.preventDefault();
        clearTimeout(timeout);

        var total = $('#total').val();
        var accessories = $('#accessories').val();
        var embroidery = $('#embroidery').val();
        var that = this,
            value = $(this).val();
        timeout=setTimeout(function(){
            var accessoriesVat = parseFloat(accessories) + parseFloat(value * VAT);
            var embroideryVat = parseFloat(embroidery) + parseFloat(value * VAT);
            var grandTotal = parseFloat(total) + parseFloat(total * VAT);
            var urgent = parseFloat(value) + parseFloat(value * VAT);
            grandTotal = parseFloat(grandTotal) + accessoriesVat + embroideryVat + urgent;
            $('#grandTotal').text(grandTotal);
            $('#grandTotalInput').val(grandTotal);
        });
    }).triggerHandler('change');

    $("#other").on('change', function(event) {
        event.preventDefault();
        clearTimeout(timeout);

        var total = $('#total').val();
        var accessories = $('#accessories').val();
        var embroidery = $('#embroidery').val();
        var urgent = $('#urgent').val();
        var that = this,
            value = $(this).val();
        timeout=setTimeout(function(){
            var accessoriesVat = parseFloat(accessories) + parseFloat(value * VAT);
            var embroideryVat = parseFloat(embroidery) + parseFloat(value * VAT);
            var urgentVat = parseFloat(urgent) + parseFloat(value * VAT);
            var grandTotal = parseFloat(total) + parseFloat(total * VAT);
            var other = parseFloat(value) + parseFloat(value * VAT);
            grandTotal = parseFloat(grandTotal) + accessoriesVat + embroideryVat + urgentVat + other;
            $('#grandTotal').text(grandTotal);
            $('#grandTotalInput').val(grandTotal);
        });
    }).triggerHandler('change');

    $("#price").on('keyup change rightnow', function(event) {
        event.preventDefault();
        clearTimeout(timeout);

        var that = this,
            value = $(this).val();
        timeout=setTimeout(function(){
            showDescription(value)
        });
    }).triggerHandler('keyup change rightnow');


    $('#network').on('change', function() {
        $('#networkTypeInput').val('Mada');
        $('#mada').attr('checked',true).attr('selected',true);
        var paymentType = ' عبر الشبكة - ';
        $('#paymentContainer').show();
        $('#bankTransfer').hide();
        $('#paymentTypeInput').val(paymentType);
        $('#depositTypeInput').val(' ( '+paymentType+' + "Mada" ) ');
        showDescription($('#price').val());
    });

    $('#prepaid_network').on('change', function() {
        $('#prepaid_networkTypeInput').val('Mada');
        $('#prepaid_mada').attr('checked',true).attr('selected',true);
        var paymentType = ' عبر الشبكة - ';
        $('#prePaidPaymentContainer').show();
        $('#prePaidBankTransfer').hide();
        $('#prepaid_paymentTypeInput').val(paymentType);
        $('#prepaid_depositTypeInput').val(' ( '+paymentType+' + "Mada" ) ');
    });

    $('#cash').on('change', function() {
        var paymentType = ' نقدي';
        $('#networkTypeInput').val('');
        $('#paymentContainer').hide();
        $('#bankTransfer').hide();
        $('#paymentTypeInput').val(paymentType);
        $('#depositTypeInput').val(' ( '+paymentType+' ) ');
        showDescription($('#price').val());
    });

    $('#prepaid_cash').on('change', function() {
        var paymentType = ' نقدي';
        $('#prepaid_networkTypeInput').val('');
        $('#prePaidPaymentContainer').hide();
        $('#prePaidBankTransfer').hide();
        $('#prepaid_paymentTypeInput').val(paymentType);
        $('#prepaid_depositTypeInput').val(' ( '+paymentType+' ) ');
    });

    $('#bank').on('change', function() {
        var paymentType = ' تحويل بنكي';
        $('#networkTypeInput').val('');
        $('#paymentContainer').hide();
        $('#bankTransfer').show();
        $('#paymentTypeInput').val(paymentType);
        $('#depositTypeInput').val(' ( '+paymentType+' ) ');
        showDescription($('#price').val());
    });

    $('#prepaid_bank').on('change', function() {
        var paymentType = ' تحويل بنكي';
        $('#prepaid_networkTypeInput').val('');
        $('#prePaidPaymentContainer').hide();
        $('#prePaidBankTransfer').show();
        $('#prepaid_paymentTypeInput').val(paymentType);
        $('#prepaid_depositTypeInput').val(' ( '+paymentType+' ) ');
    });

    $('#mada').on('change', function() {
        var paymentType = ' عبر الشبكة - ';
        $('#networkTypeInput').val('Mada');
        $('#depositTypeInput').val(' ( '+paymentType+' Mada ) ');
        showDescription($('#price').val());
    });

    $('#prepaid_mada').on('change', function() {
        var paymentType = ' عبر الشبكة - ';
        $('#prepaid_networkTypeInput').val('Mada');
        $('#prepaid_depositTypeInput').val(' ( '+paymentType+' Mada ) ');
    });

    $('#visa').on('change', function() {
        var paymentType = ' عبر الشبكة - ';
        $('#networkTypeInput').val('Visa');
        $('#depositTypeInput').val(' ( '+paymentType+' Visa ) ');
        showDescription($('#price').val());
    });

    $('#prepaid_visa').on('change', function() {
        var paymentType = ' عبر الشبكة - ';
        $('#prepaid_networkTypeInput').val('Visa');
        $('#prepaid_depositTypeInput').val(' ( '+paymentType+' Visa ) ');
    });

    $('#mastercard').on('change', function() {
        var paymentType = ' عبر الشبكة - ';
        $('#networkTypeInput').val('Master Card');
        $('#depositTypeInput').val(' ( '+paymentType+' Master Card ) ');
        showDescription($('#price').val());
    });

    $('#prepaid_mastercard').on('change', function() {
        var paymentType = ' عبر الشبكة - ';
        $('#prepaid_networkTypeInput').val('Master Card');
        $('#prepaid_depositTypeInput').val(' ( '+paymentType+' Master Card ) ');
    });

    $('#amex').on('change', function() {
        var paymentType = ' عبر الشبكة - ';
        $('#networkTypeInput').val('AMEX');
        $('#depositTypeInput').val(' ( '+paymentType+' AMEX ) ');
        showDescription($('#price').val());
    });

    $('#prepaid_amex').on('change', function() {
        var paymentType = ' عبر الشبكة - ';
        $('#prepaid_networkTypeInput').val('AMEX');
        $('#prepaid_depositTypeInput').val(' ( '+paymentType+' AMEX ) ');
    });

    function showDescription(price)
    {
        var description = 'دفعة من السيد / '
            + $('#customerName').val()
            +' ( '+$('#paymentTypeInput').val()+' '+$('#networkTypeInput').val()+' ) '
            + ' بقيمة '
            + parseFloat(price)
            + ' ريال '
            + 'لصالح الطلب رقم '
            + $('#orderCode').val();

        $('#description').val(description);
    }

    $("#createNewDiscountForm").submit(function(event) {
        event.preventDefault();
        const myData = new FormData(this);
        createDiscount(myData);
    });



    function getPriceForOneFabric(getPriceByIdUrl)
    {
        $.ajax({
            url: getPriceByIdUrl,
            data: {},
            type: "GET",
            cache: false,
            processData: false,
            contentType: false,
        })
            .done(function (data) {
                populatePrice(data.fabric.price_for_one_fabric,data.fabric.stock);
                fireToast(data.message)
                if (data.stockMessage != "")
                {
                    Snackbar.show({
                        text: data.stockMessage,
                        backgroundColor: '#ff9966',
                        showAction: false,
                        pos: 'top-center'
                    });
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

    $("#createNewDressForm").submit(function(event) {
        event.preventDefault();
        const myData = new FormData(this);
        create(myData);
    });

    $(".btn-submit-discount").click(function(event) {
        event.preventDefault();
        const myData = new FormData(this);
        createDiscount(myData);
    });

    $("#createNewDepositForm").submit(function(event) {
        event.preventDefault();
        const myData = new FormData(this);
        createDeposit(myData);
    });


    $("#discountPercentage").on('keyup change rightnow', function(event) {
        event.preventDefault();
        clearTimeout(timeout);
        var total_order_cost_create = $('#total_order_cost_create').val();
        var maxDiscountValue = $('#maxDiscountValue').val();
        var that = this,
            value = $(this).val();

        timeout=setTimeout(function(){
            if (value >100)
            {
                $("#discountPercentage").val(maxDiscountValue);
            }else{
                var discountValue = parseFloat(total_order_cost_create) * parseFloat(value /100);
                $('#discount_create_input').val(discountValue.toFixed(2));
                $('#discount_create_text').text(discountValue.toFixed(2));
                var totalAfterDiscount = parseFloat(total_order_cost_create) - parseFloat(discountValue);
                $('#after_discount_input').val(totalAfterDiscount.toFixed(2));
                $('#after_discount_text').text(totalAfterDiscount.toFixed(2));
            }
        });
    }).triggerHandler('keyup change rightnow');

    $("#discountPercentageDress").on('keyup change rightnow', function(event) {
        event.preventDefault();
        clearTimeout(timeout);
        var total_dress_cost_create = $('#total_dress_cost_create').val();
        var maxDiscountValue = $('#maxDiscountValue').val();
        var that = this,
            value = $(this).val();

        timeout=setTimeout(function(){
            if (value >100)
            {
                $("#discountPercentageDress").val(maxDiscountValue);
            }else{
                var discountValue = parseFloat(total_dress_cost_create) * parseFloat(value /100);
                $('#discount_create_input').val(discountValue.toFixed(2));
                $('#dress_discount_create_text').text(discountValue.toFixed(2));
                var totalAfterDiscount = parseFloat(total_dress_cost_create) - parseFloat(discountValue);
                $('#after_dress_discount_input').val(totalAfterDiscount.toFixed(2));
                $('#after_discount_text').text(totalAfterDiscount.toFixed(2));
            }
        });
    }).triggerHandler('keyup change rightnow');

    const changeStatusUrl = $('#changeStatusUrl').val();

    $(document).on('click', '.changeStatus', function (event) {
        const uuid = $(event.currentTarget).data('id');
        var active = $(event.currentTarget).data('active');
        if (active)
        {
            changeStatus(uuid, 0, 'الغاء الثوب');
        }else {
            changeStatus(uuid, 1, 'تفعيل الثوب');
        }
    });

    function changeStatus(uuid, active, text)
    {
        Swal.fire({
            title: 'هل تريد الاستمرار؟',
            text: text,
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
                    url: changeStatusUrl,
                    type:'POST',
                    datatype:'json',
                    data: {
                        uuid: uuid,
                        active: active
                    }
                })
                    .done(function (data) {
                        window.location.reload();
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

    const changeDepositStatusUrl = $('#changeDepositStatusUrl').val();

    $(document).on('click', '.changeDepositStatus', function (event) {
        const uuid = $(event.currentTarget).data('id');
        var active = $(event.currentTarget).data('active');
        if (active)
        {
            changeDepositStatus(uuid, 0, 'الغاء الدفعة');
        }else {
            changeDepositStatus(uuid, 1, 'تفعيل الدفعة');
        }
    });

    function changeDepositStatus(uuid, active, text)
    {
        Swal.fire({
            title: 'هل تريد الاستمرار؟',
            text: text,
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
                    url: changeDepositStatusUrl,
                    type:'POST',
                    datatype:'json',
                    data: {
                        uuid: uuid,
                        active: active
                    }
                })
                    .done(function (data) {
                        window.location.reload();
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



    function create(myData)
    {
        myData.append('price_for_one_fabric', $('#price_for_one_fabric').val());
        myData.append('total', $('#total').val());
        myData.append('grandTotal', $('#grandTotalInput').val());
        var createNewDressUrl = $('#createNewDressUrl').val();
        $.ajax({
            url: createNewDressUrl,
            data: myData,
            type: "POST",
            cache: false,
            processData: false,
            contentType: false,
        })
            .done(function (data) {
                $('#createNewDressForm').trigger("reset");
                $('#createNewDressModal').modal('hide');
                window.location.reload();
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

    function createDiscount(myData)
    {
        var createNewDiscountUrl = $('#createNewDiscountUrl').val();
        $.ajax({
            url: createNewDiscountUrl,
            data: myData,
            type: "POST",
            cache: false,
            processData: false,
            contentType: false,
        })
            .done(function (data) {
                $('#createNewDiscountForm').trigger("reset");
                $('#createNewDiscountModal').modal('hide');
                window.location.reload();
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

    function createSingleDiscount(myData)
    {
        var createIndividualDiscountUrl = $('#createIndividualDiscountUrl').val();
        $.ajax({
            url: createIndividualDiscountUrl,
            data: myData,
            type: "POST",
            cache: false,
            processData: false,
            contentType: false,
        })
            .done(function (data) {
                $('#createIndividualDiscountForm').trigger("reset");
                window.location.reload();
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

    function createDeposit(myData)
    {
        var createNewDepositUrl = $('#createNewDepositUrl').val();
        $.ajax({
            url: createNewDepositUrl,
            data: myData,
            type: "POST",
            cache: false,
            processData: false,
            contentType: false,
        })
            .done(function (data) {
                $('#createNewDepositForm').trigger("reset");
                $('#createNewDepositModal').modal('hide');
                window.location.reload();
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

    $('#editOrderForm').submit(function (event) {
        event.preventDefault();
        const myData = new FormData(this);
        var updateOrderUrl = $('#updateOrderUrl').val();
        var title = $('#statusToBeChanged').data('title');
        updateOrder(myData, updateOrderUrl, title);
    });


    $('#completeOrderBtn').click(function (event) {
        event.preventDefault();
        const myData = new FormData();
        myData.append('order_id',$('#orderID').val());
        myData.append('delivery_date',$('#delivery_date').val());
        myData.append('statusToBeChanged', 'complete');
        myData.append('comment', $('#comment').val());
        var updateOrderUrl = $('#updateOrderUrl').val();
        var title = 'اغلاق الطلب';
        updateOrder(myData, updateOrderUrl, title);
    });

    function updateOrder(myData, updateOrderUrl, title)
    {
        console.log("Ssssjssjsj")
        myData.append('action', title);
        Swal.fire({
            title: title,
            text: 'هل انت متأكد من ' + title + ' ؟',
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
                    url: updateOrderUrl,
                    data: myData,
                    type: "POST",
                    cache: false,
                    processData: false,
                    contentType: false,
                })
                    .done(function (data) {
                        window.location.reload();
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

    function populatePrice(priceForOneFabric,stock)
    {
        $('#price_for_one_fabric').val(priceForOneFabric);
        $('#total').val(priceForOneFabric);
        var total = parseFloat(priceForOneFabric) + parseFloat(priceForOneFabric * VAT);
        $('#clothes_num').val(1).attr('max',stock);
        $('#ending_text').show();
        $('#grandTotal').text(total);
        $('#grandTotalInput').val(total);
        $('#urgent').val(0);
        $('#embroidery').val(0);
        $('#accessories').val(0);
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
