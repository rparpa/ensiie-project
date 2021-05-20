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


function verify_user(){
    let name = $("#username").val();
    let pwd =  $("#password").val();

    $.ajax({
        url: 'router.php',
        type: 'POST',
        data: {
            url: "src/Controller/verify_user.php",
            username: name,
            pwd: pwd
        },
        dataType: 'json',
        success: function(data){
            if(data.success == 1){
                localStorage.setItem('username', name);
                $("#affiche_name").html(name);
                $(".onlyUser").show();
                $(".notUser").hide();            
            }
        }
    });
}