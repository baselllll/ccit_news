$(document).ready(function($){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#editForm").submit(function(event) {
        event.preventDefault();
        const editData = new FormData(this);
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
                $('#maxDiscount').val(data.settings.maxDiscount);
                $('#VAT').val(data.settings.VAT);
                $('#title').val(data.settings.title);
                $('#taxNumber').val(data.settings.taxNumber);
                $('#phoneNumber').val(data.settings.phoneNumber);
                $('#email').val(data.settings.email);
                $('#address').text(data.settings.address).val(data.settings.address);
                $('#invoiceFooter').text(data.settings.invoiceFooter).val(data.settings.invoiceFooter);
                $('#black_logo_image').attr('src', data.urls.black_logo_url).show();
                $('#white_logo_image').attr('src', data.urls.white_logo_url).show();
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
                        $("#" + key + '_error').text(value);
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

    function removeErrorMessagesEditForm()
    {
        var validated = $('#editForm').serializeArray();
        $.each(validated, function (key, value) {
            $("#" + value['name']).removeClass('is-invalid');
            $("#" + value['name'] + '_error').text("");
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
