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
            name: {
                required: true,
                maxlength: 255
            },
            description: {
                required: true,
                maxlength: 255
            },
            duration_months: {
                required: true,
                maxlength: 12

            },
        },
        messages: {
            gender_id: {
                required: "Please select a gender"
            },
            'job[category_id]': {
                required: "Please select an employee category"
            },
            'job[department_id]': {
                required: "Please select the employee's department"
            },
            'job[title]': {
                required: "Please enter the employee's title"
            },
            'job[start_date]': {
                required: "Please enter the employee's job start date"
            },
            'job[end_date]': {
                greaterThan: "End date must be greater or equal to start date"
            }
        }
    });
});


