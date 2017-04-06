$(function(){
    //override jquery validate plugin defaults
    $.validator.setDefaults({
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

    //Validate Form
    $('#user_basic_info_form').validate({
        rules: {
            email: {
                required: true,
                email: true,
                maxlength: 254
            },
            password: {
                minlength: 5,
                maxlength: 60
            },
            first_name: {
                required: true,
                maxlength: 255
            },
            last_name: {
                required: true,
                maxlength: 255
            },
            password_confirm: {
                equalTo : "#input_password"
            }
        }
    });

    $('#link-employee-profile-form').validate({
        rules: {
            employee_id: {
                required: true
            }
        }
    });

    $('#select_employee_id').chosen({
        width:'100%'
    });

    $('#btn-link-employee').on('click',function(){
        $(this).hide();
        $('#link-employee-form').slideDown();
        return false;
    });

    $('#link-employee-cancel').on('click',function(){
        $('#link-employee-form').slideUp(400,function(){
            $('#btn-link-employee').show();
        });
        return true;
    });

    $('#btn_detach_employee_profile').on('click',function(e){
        e.preventDefault();
        var $this = $(this);
        swal({
            title: 'Detach Employee Profile',
            text: "Responsible parties will be notified of this action.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#F44336",
            confirmButtonText: "Yes, detach it!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function(){
            window.location = $this.attr('href');
        });
    });
});
