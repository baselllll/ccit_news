$(document).ready(function($){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const url= $('#getUrl').val();
    const deleteUrl = $('#deleteUrl').val();
    var table = $('#roles-table').DataTable( {
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
        "ordering": false,
        searching: true,
        "processing": false,
        "serverSide": true,
        "ajax": url
        ,
        "columns": [
            {data:'name', name:'name'},
            {data:'actions', name:'actions', orderable:false, searchable:false},
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

    $('#btn-edit-close').click(function (event) {
        event.preventDefault();
        $('#editForm').trigger("reset");
        $('#editModal').modal('hide');
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
        const id = $(event.currentTarget).data('id');
        deleteOne(id);
    });

    $(document).on('click', '.btn-edit', function (event) {
        event.preventDefault();
        var id = $(event.currentTarget).data('id');
        $('#editModal').modal('show');
        id = 'id='+ id;
        var showUrl = $('#showUrl').val();
        showUrl = showUrl.replace(':id',id);
        getOne(showUrl);
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
                $('#name_edit').val(data.role.name);
                $('#id').val(data.role.id);
                const rolePermissions = data.rolePermissions;
                $.each(rolePermissions, function (key, value) {
                    $("#permissions_edit option").each(function(k, val)
                    {
                        if (key === $(this).val())
                        {
                            let select = document.getElementById('permissions_edit');
                            let instance = select.tomselect;
                            instance.addItem(key)
                            instance.refreshItems();
                        }
                    });
                });
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

    function deleteOne(id)
    {
        Swal.fire({
            title: 'حذف مجموعة صلاحيات',
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
                        id: id
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
            if (value['name'] != 'permissions[]')
            {
                $("#" + value['name']).removeClass('is-invalid');
                $("#" + value['name'] +'_error').text("");
            }
        });
    }

    function removeErrorMessagesEditForm()
    {
        var validated = $('#editForm').serializeArray();
        $.each(validated, function (key, value) {
            if (value['name'] != 'permissions[]')
            {
                $("#" + value['name'] +'_edit').removeClass('is-invalid');
                $("#" + value['name'] +'_edit_error').text("");
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
