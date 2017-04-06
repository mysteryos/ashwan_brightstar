$(function(){
    //Reset intro
    $('#btn_intro_reset').on('click',function(e){
        e.preventDefault();
        var $this = $(this);

        swal({
            title: 'Reset Intro',
            text: "Once the intro is reset, the page will refresh.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#F44336",
            confirmButtonText: "Yes, reset it!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function(){
            $.ajax({
                type:'DELETE',
                url: $this.attr('href'),
                data: {'path':$this.attr('data-path')},
                success: function(){
                    //Reload page
                    window.location.reload();
                },
                error: function(xhr){
                    $.growl({
                        message: 'Unable to postpone tour, error msg: '+xhr.responseText
                    },{
                        type:'danger',
                        allow_dismiss: true,
                        delay: 5000,
                        placement: {
                            from: 'top',
                            align: 'center'
                        },
                        animate: {
                            enter: 'animated fadeIn',
                            exit: 'animated fadeOut'
                        },
                        offset: {
                            y: 75
                        }
                    });
                }
            });
        });
    });
});