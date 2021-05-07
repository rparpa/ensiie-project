
jQuery(document).ready(function($) {

    $('.onlyUser, .onlyAdmin').hide();

    $("#username").change(function(){
        localStorage.setItem("username", $("#username").val())
    });

    $("#username").val(localStorage.getItem("username"));
});