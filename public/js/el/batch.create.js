/**
 * Created by user on 25/04/2017.
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
    $('#batch_create_form').validate({
        rules: {

            id: {
                required: true,
                maxlength: 5
            },

            name: {
                required: true,
                maxlength: 255
            },
            start_date: {
                required: true,
            },
            course_id: {
                required: true,
            },
            lecturer_id: {
                required: true
            }
        }}

    );

    $('#inputStartDate').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false,
        disabledDates: [
            moment('2017-01-01'),
            moment('2017-01-02'),
            moment('2017-01-28'),
            moment('2017-02-01'),
            moment('2017-02-09'),
            moment('2017-02-24'),
            moment('2017-03-12'),
            moment('2017-03-29'),
            moment('2017-05-01'),
            moment('2017-06-26'),
            moment('2017-08-26'),
            moment('2017-10-19'),
            moment('2017-11-01'),
            moment('2017-11-02'),
            moment('2017-12-25')
        ]
    });
});







