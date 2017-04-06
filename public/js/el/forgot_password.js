/**
 * Created by kpudaruth on 26/10/2015.
 */

/*
 * Validate
 */
$(function () {

    // override jquery validate plugin defaults
    $.validator.setDefaults({
        highlight: function (element) {
            $(element).closest('.input-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.input-group').removeClass('has-error');
        },
        errorElement: 'small',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            error.addClass('has-error');
            error.insertAfter(element.parents('.input-group'));
        }
    });

    $('#forgot_password_form').validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        }
    });
});

