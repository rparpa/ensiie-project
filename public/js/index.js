
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


function check_connection(){
    let name = $("#username").val();
    let pwd =  $("#password").val();

    alert(name + " " + pwd);
    $.ajax({
        url: '../src/Controller/verify_user.php',
        type: 'POST',
        data: {
            username: name,
            pwd: pwd
        },
        dataType: 'json',
        success: function(data){
            console.log('Connnected');
            alert('success');
        }
    })
    alert('FAIL');

    alert('r');

}