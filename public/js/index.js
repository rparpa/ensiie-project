jQuery(document).ready(function($) {
    init();
});

function init(){
    $('.onlyUser, .onlyAdmin, .alertField').hide();

    $("#username").change(function(){
        localStorage.setItem("username", $("#username").val())
    });

    $("#username").val(localStorage.getItem("username"));
}