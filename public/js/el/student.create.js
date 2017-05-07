

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

    $.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z ]+$/i.test(value);
    }, "Letters only please");

    //Validate
    $('#student_create_form').validate({
        rules: {
            first_name: {
                required: true,
                maxlength: 255,
                lettersonly: true
            },
            last_name: {
                required: true,
                maxlength: 255,
                lettersonly: true
            },
            email: {
                email: true,
                maxlength: 254
            },
            mobile_number: {
                digits: true,
                minlength: 4,
                maxlength: 15
            },
        }
    });
});