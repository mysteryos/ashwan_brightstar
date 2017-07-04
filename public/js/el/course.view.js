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
    $('#course_basic_info_form').validate({
        rules: {
            id: {
                required: true
            },
            name: {
                required: true,
                maxlength: 255
            },
            duration_months: {
                required: true,
                digits: true,
                max: 12,
                min: 1
            }
        }
    });
});
