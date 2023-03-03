$('#createAbout').click(function (event) {
    event.preventDefault();
    $('#createAboutModal').modal('show');
});


// $('#editAbout').click(function (event) {
//     event.preventDefault();
//     $('#editAboutModal').modal('show');
// });
//

$('body').on('click', '#editAbout', function (e) {
    e.preventDefault()
    var title = $(this).data('title');
    var id = $(this).data('id');
    var description = $(this).data('description');
    var image = $(this).data('image');

    $(".modal-body #title").val( title );
    $(".modal-body #id").val( id );
    $(".modal-body #description").val( description );
    $(".modal-body #about_image").attr('src', image );
    $('#editAboutModal').modal('show');
});


$('#btn-add-close').click(function (event) {
    event.preventDefault();
    $('#addAdminForm').trigger("reset");
    $('#createAboutModal').modal('hide');
});

$('#btn-add-close').click(function (event) {
    event.preventDefault();
    $('#addAdminForm').trigger("reset");
    $('#createAboutModal').modal('hide');
});
