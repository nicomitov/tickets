$(document).on('click', '#create_tag', function(e) {
    e.preventDefault();
    $('#tag').modal('show');
    $action = $(this).data("action");
    $url = $(this).data("href");
    $("#tag_form")[0].reset();
});

$('body').on('click', '#tag_submit_btn', function() {
    let form = $("#tag_form");
    let formData = form.serialize();

    $('#tag-error').html( "" );

    $.ajax({
        url: $url,
        type: 'POST',
        data: formData,
        success:function(data) {
            if(data.errors) {
                if(data.errors.name){
                    $('#name-error').html( data.errors.name[0] );
                }
            }
            if(data.success) {
                $('#tag').modal('hide');

                $('#to_tags').append('<option value="'+data.id+'">'+data.name+'</option>');

                $('.content').append('<div class="alert alert-success" id="alert"><span class="close" data-dismiss="alert" role="button">&times;</span><i class="fa fa-check fa-lg fa-fw" aria-hidden="true"></i> Successfully created!</div>');
                $('#alert').delay(5000).hide(0);
                $('#to_tags').multiselect('rebuild');
                $('#to_tags').multiselect('select', data.id);
            }
        },
    });
});
