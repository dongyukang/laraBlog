function confirmDelete() {

    //$('#warningBox').removeAttr('hidden');
    $('#warningBox').slideToggle("slow");

}

//Disable submit button to prevent accidental double submits
$('#submitButton').click(function(){
    $('#submitButton').addClass('disabled');
});