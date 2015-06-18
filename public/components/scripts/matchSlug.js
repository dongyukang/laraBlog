var auto = true; //Automatically create the slug until user edits

$('#input_title').bind('keyup paste', function() {
    if(auto == true) {
        $('#input_slug').val(convertStringToSlug($(this).val()));
    }
});
//Stop automatic behavior if user types in slug
$('#input_slug').bind('keyup paste', function() {
        auto = false;
});

function convertStringToSlug(text)
{
    return text
        .toLowerCase()
        .replace(/ /g,'-') //Change spaces to hyphens
        .replace(/[^\w-]+/g,''); //Only allow letters, numbers, underscore, hyphens
}
