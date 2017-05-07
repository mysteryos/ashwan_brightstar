$(function() {
    $('.btn-delete-student').on('click',function() {
        return confirm('Do you wish to delete this student ID: '+$(this).attr('data-id')+'?');
    });
})