
jQuery(document).ready(function($) {

    $('.onlyUser').hide();
    $('.onlyAdmin').hide();

    $(".inscription_input").change(function(){
        localStorage.setItem($(this)[0].name, $("#"+$(this)[0].name).val())
    });

    $(".inscription_input").each(function(){
        $("#"+$(this)[0].name).val(localStorage.getItem($(this)[0].name));
    });
});