//Opens the user roles page from the admin panel based on the select input
function openPage(){
    var target = "/users/"+$('#user_list').select2("val").toLowerCase();
    window.location.href = target;
}