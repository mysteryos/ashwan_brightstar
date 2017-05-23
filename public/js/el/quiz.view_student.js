$(function() {
    $.validator.setDefaults({
        highlight: function (element) {
            $(element).closest('.card').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.card').removeClass('has-error');
        },
        errorElement: 'small',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            error.addClass('has-error');
            error.insertAfter(element.parents('.card').find('.card-header'));
        }
    });

    $('#quiz-form').validate({
        submitHandler: function(form) {
            return form.isValid();
        }
    });

    $('#quiz-form').find('input[name$="[answer_id]"]').each(function() {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Please select an answer"
            }
        });
    });
});