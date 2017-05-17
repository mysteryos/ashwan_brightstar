$(function(){
    //Delete Main
    $('.delete_form').on('submit', function(e){
        return confirm("Are you sure you wish to delete this resource?");
    })
});
