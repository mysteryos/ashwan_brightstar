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

    $.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z ]+$/i.test(value);
    }, "Letters only please");

    //Validate
    $('#assignment_create_form').validate({
        rules: {
            id: {
                required: true,
                maxlength: 5,
                digitsonly: true
            },
            name: {
                required: true,
                maxlength: 255,
                lettersonly: true
            },
            description: {
                description: true,
                maxlength: 254
            },
            course_id: {
                required: true,
                maxlength: 5,
                digitsonly: true
            },
        }
    });
});

