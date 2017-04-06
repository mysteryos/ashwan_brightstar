/**
 * Created by kpudaruth on 21/10/2015.
 */

/*
 * Validate
 */
$(function () {

    var $input_password = $('#input_password');
    var $password_progressbar = $('#password_progressbar');
    var passwordcheck_timeout;

    function setPasswordStrengthBar()
    {
        document.getElementById('password_strength').removeAttribute('style');
        document.getElementById('password_strength_container').removeAttribute('style');
        if($input_password.val() === "")
        {
            document.getElementById('password_strength').setAttribute('style','display:none;');
            document.getElementById('password_strength_container').setAttribute('style','display:none;');
            $password_progressbar.width('0%');
            return;
        }

        var result = zxcvbn($input_password.val());
        switch(result.score) {
            case 0:
                document.getElementById('password_strength_text').innerHTML = 'Very Weak';
                $password_progressbar.width('20%');
                $password_progressbar.removeClass('progress-bar-danger progress-bar-success progress-bar-info progress-bar-warning').addClass('progress-bar-danger');
                break;
            case 1:
                document.getElementById('password_strength_text').innerHTML = 'Weak';
                $password_progressbar.width('40%');
                $password_progressbar.removeClass('progress-bar-danger progress-bar-success progress-bar-info progress-bar-warning').addClass('progress-bar-warning');
                break;
            case 2:
                document.getElementById('password_strength_text').innerHTML = 'Medium';
                $password_progressbar.width('60%');
                $password_progressbar.removeClass('progress-bar-danger progress-bar-success progress-bar-info progress-bar-warning').addClass('progress-bar-warning');
                break;
            case 3:
                document.getElementById('password_strength_text').innerHTML = 'Ok';
                $password_progressbar.width('80%');
                $password_progressbar.removeClass('progress-bar-danger progress-bar-success progress-bar-info progress-bar-warning').addClass('progress-bar-info');
                break;
            case 4:
                document.getElementById('password_strength_text').innerHTML = 'Strong';
                $password_progressbar.width('100%');
                $password_progressbar.removeClass('progress-bar-danger progress-bar-success progress-bar-info progress-bar-warning').addClass('progress-bar-success');
                break;
        }
    }

    $input_password.on('keyup',function(){
        if(passwordcheck_timeout) {
            clearTimeout(passwordcheck_timeout);
            passwordcheck_timeout = null;
        }

        passwordcheck_timeout = setTimeout(setPasswordStrengthBar, 500);
    });

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

    $.validator.addMethod(
        "strongPassword",
        function(value, element) {
            return zxcvbn(value).score >= 2;
        },
        "Please set a strong password. E.g: add numbers, symbols or uppercase characters"
    );

    $('#register_form').validate({
        rules: {
            email: {
                required: true,
                email: true,
                maxlength: 254
            },
            password: {
                required: true,
                minlength: 7,
                maxlength: 60,
                strongPassword: true
            },
            first_name: {
                required: true,
                maxlength: 255
            },
            last_name: {
                required: true,
                maxlength: 255
            },
            accept_agreement: {
                required: true
            }
        },
        messages: {
            accept_agreement: {
                required: "You must accept the agreement before registering."
            }
        }
    });
});