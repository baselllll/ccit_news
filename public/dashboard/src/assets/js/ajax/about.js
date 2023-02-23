$('#createAbout').click(function (event) {
    event.preventDefault();
    $('#createAboutModal').modal('show');
});


$('#editAbout').click(function (event) {
    event.preventDefault();
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
