$(function() {
    $('.btn-delete-batch').on('click',function() {
        return confirm('Do you wish to delete this batch ID: '+$(this).attr('data-id')+'?');
    });
})