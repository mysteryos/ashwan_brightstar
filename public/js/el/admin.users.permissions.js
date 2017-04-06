$(function(){
    $('#add_permission_form').validate({
        rules: {
            permission_slug: {
                required: true
            }
        },
        highlight: function (element) {
            $(element).closest('.fg-line').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.fg-line').removeClass('has-error');
        },
        errorElement: 'small',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            error.addClass('has-error');
            error.insertAfter(element.parents('.fg-line'));
        }
    });

    $('.command-permission-delete').on('click',function(e){
        var $this = $(this);
        var $permission_slug = $this.parent().find('.delete_permission_slug').val();
        swal({
            title: "Permission '"+$permission_slug+"' Removal.",
            text: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ok",
            closeOnConfirm: false
        }, function(){
            $this.parents('form.delete_permission_form').submit();
        });

        return false;
    });

    $('.command-role-delete').on('click',function(e){
        var $this = $(this);
        var $role_slug = $this.parent().find('.delete_role_slug').val();
        swal({
            title: "Role '"+$role_slug+"' Removal.",
            text: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ok",
            closeOnConfirm: false
        }, function(){
            $this.parents('form.delete_role_form').submit();
        });

        return false;
    });
});