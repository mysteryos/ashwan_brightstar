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
    $('#course_create_form').validate({
        rules: {

            course_id: {
                required: true,
                maxlength: 5
            },


            name: {
                required: true,
                maxlength: 255
            },
            description: {
                required: true
            },
            duration_months: {
                required: true,
                digits: true,
                max: 12,
                min: 1
            },
        }
    });
});


