/**
 * Created by kpudaruth on 18/01/2016.
 */

$(function(){

    $('#input_new_user_id').chosen({
        width:'100%'
    });

    var link_user_validator = $('#link_user_form').validate({
        rules: {
            user_id: {
                required: true
            }
        },
        messages: {
            user_id: {
                required: "Please select a user"
            }
        },
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
            error.insertAfter(element.closest('.fg-line'));
        }
    });

    //Form modal
    var $link_user_modal = $('#link_user_modal');

    $link_user_modal.on('show.bs.modal',function(e) {
        link_user_validator.resetForm();
        $('#link_user_form').find('.form-group').removeClass('has-error');
        $('#link_user_form')[0].reset();
    });

    $link_user_modal.on('click','.btn_submit',function(){
        $link_user_modal.find('form').submit();
    });

    //Link user
    $('#btn_link_user').on('click', function(e) {
        e.preventDefault();
        $link_user_modal.modal('show');
    });

    //Unlink user
    $('#btn_unlink_user').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        swal({
            title: 'Are you sure you wish to unlink this lecturer profile?',
            text: "A notification will be sent to concerned parties.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, unlink it!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function(){
            window.location.href = $this.attr('href');
        });
    });

});