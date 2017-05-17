$(function(){
    $.validator.setDefaults({
        //for Chosen selects
        ignore: ":hidden:not(select)",
        highlight: function (element) {
            $(element).parents('.dl-horizontal').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).parents('.dl-horizontal').removeClass('has-error');
        },
        errorElement: 'small',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            error.addClass('has-error');
            error.insertAfter(element.parents('.fg-line'));
        }
    });


    //Validate
    $('#lecture_info_form').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            description: {
                required: true
            },
            course_id: {
                required: true
            }
        },
        submitHandler: function(form) {
            return form.valid();
        }
    });

    $('#inputDescription').summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert',['link']]
        ],
        disableDragAndDrop: true,
        minHeight: 500
    });

    //Delete Main
    $('.delete_form').on('submit', function(e){
        return confirm("Are you sure you wish to delete this resource?");
    });
});

