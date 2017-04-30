/**
 * Created by user on 26/04/2017.
 */


$(function(){
    $.validator.setDefaults({
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'small',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            error.addClass('has-error');
            error.insertAfter(element.parents('.fg-line'));
        }
    });

    //Validate
    $('#lecture_create_form').validate({
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
        }
    });
});

