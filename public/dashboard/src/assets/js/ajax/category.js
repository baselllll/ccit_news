$('#createCategory').click(function (event) {
    event.preventDefault();
    $('#createCategoryModal').modal('show');
});

    $('body').on('click', '#editCategory', function (e) {
    e.preventDefault()
    var title = $(this).data('title');
    var id = $(this).data('id');
    var content = $(this).data('content');
    var image = $(this).data('image');
    var type = $(this).data('type');
    var video_link = $(this).data('video_link');

    console.log(title,id,content,image,type)

    $(".modal-body #title").val( title );
    $(".modal-body #id").val( id );
    $(".modal-body #content").val( content );
    $(".modal-body #image").attr('src', image );
    $(".modal-body #type").val( type );
    $(".modal-body #video_link").val( video_link );
    $('#editCategoryModal').modal('show');
});



$('#btn-add-close').click(function (event) {
    event.preventDefault();
    $('#createCategoryModal').modal('hide');
});

$('#btn-add-close').click(function (event) {
    event.preventDefault();
    $('#createCategoryModal').modal('hide');
});
