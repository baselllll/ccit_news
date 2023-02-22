$(document).ready(function($){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    populateData();
    function populateData(selectFromDate = '')
    {
        const EODGetAllUrl= $('#EODGetAllUrl').val();
        $.ajax({
            url: EODGetAllUrl,
            data: {
                selectFromDate : selectFromDate
            },
            type: "GET",
            cache: true,
            processData: true,
            contentType: true,
        })
            .done(function (data) {
                $('.totalOrderPrice').text(data.EOD.totalOrderPrice);
                $('.clothsNum').text(data.EOD.clothsNum);
                populatePrepaid(data.EOD.prepaid, data.EOD.prepaidNetworks);
                populatePostpaid(data.EOD.postpaid, data.EOD.postpaidNetworks);
                populateTotal(data.EOD);
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

    function populatePrepaid(prepaid, prepaidNetworks)
    {
        $('#prepaidCash').text(prepaid.cash);
        $('#prepaidVisa').text(prepaidNetworks.visa);
        $('#prepaidMastercard').text(prepaidNetworks.mastercard);
        $('#prepaidAmex').text(prepaidNetworks.amex);
        $('#prepaidMada').text(prepaidNetworks.mada);
        $('#prepaidNetwork').text(prepaid.network);
        $('#prepaidBank').text(prepaid.bank);
        $('#totalPrepaidDeposits').text(prepaid.totalDeposits);
    }

    function populatePostpaid(postpaid, postpaidNetworks)
    {
        $('#postpaidCash').text(postpaid.cash);
        $('#postpaidVisa').text(postpaidNetworks.visa);
        $('#postpaidMastercard').text(postpaidNetworks.mastercard);
        $('#postpaidAmex').text(postpaidNetworks.amex);
        $('#postpaidMada').text(postpaidNetworks.mada);
        $('#postpaidNetwork').text(postpaid.network);
        $('#postpaidBank').text(postpaid.bank);
        $('#totalPostpaidDeposits').text(postpaid.totalDeposits);
    }

    function populateTotal(total)
    {
        $('.totalIncome').text(total.totalIncome);
        $('#totalVisa').text(total.totalVisa);
        $('#totalMaster').text(total.totalMaster);
        $('#totalCash').text(total.totalCash);
        $('#totalAmex').text(total.totalAmex);
        $('#totalMada').text(total.totalMada);
        $('#totalNetwork').text(total.totalNetwork);
        $('#totalBank').text(total.totalBank);
    }

    $("#btn-search-sales").click(function(event) {
        event.preventDefault();
        var selectFromDate = $('#selectFromDate').val();
        populateData(selectFromDate);
    });
});
