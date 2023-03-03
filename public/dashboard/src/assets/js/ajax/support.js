$('#createSupport').click(function (event) {
    event.preventDefault();
    $('#createSupportModal').modal('show');
});


// $('#editSupport').click(function (event) {
//     event.preventDefault();
//     $('#editSupportModal').modal('show');
// });

$('body').on('click', '#editSupport', function (e) {
    e.preventDefault()
    var title = $(this).data('title');
    var id = $(this).data('id');
    var description = $(this).data('description');
    var image = $(this).data('image');

    $(".modal-body #name").val( title );
    $(".modal-body #id").val( id );
    $(".modal-body #description").val( description );
    $(".modal-body #support_image").attr('src', image );
    $('#editSupportModal').modal('show');
});


$('#btn-add-close').click(function (event) {
    event.preventDefault();
    $('#createSupportModal').modal('hide');
});

$('#btn-add-close').click(function (event) {
    event.preventDefault();
    $('#createSupportModal').modal('hide');
});
