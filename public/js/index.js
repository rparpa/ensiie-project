
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