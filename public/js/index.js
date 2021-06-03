jQuery(document).ready(function($) {
    init();
    get_all_article();
});

function init(){
    $('.alertField').hide();
    if(localStorage.getItem('connected') == 'true'){
        connectedDisplay();
        return;
    }
    $('.onlyUser, .onlyAdmin').hide();

    $("#username").change(function(){
        localStorage.setItem("username", $("#username").val())
    });
    $("#username").val(localStorage.getItem("username"));
}

function connectedDisplay(){
    $("#affiche_name").html("Bonjour " + localStorage.getItem("username") + " !");
    $(".onlyUser").show();

    $(".notUser").hide();

    if(localStorage.getItem('isadmin') == 'true')   $(".onlyAdmin").show();
    else $(".onlyAdmin").hide();
}

function deconnection(){
    localStorage.setItem('username', '');
    localStorage.setItem('connected', null);
    localStorage.setItem('isadmin', null);
    window.location.replace('index.html');
}

function shake(obj){
    obj.removeClass('shake');
    obj.css("borderColor","red");
    setTimeout(function(){
        obj.addClass('shake');
    });
}

function verify_user(){
    let name = $("#username").val();

    $.ajax({
        url: 'router.php',
        type: 'POST',
        data: {
            request: "Controller/verify_user.php",
            username: name,
            pwd: $("#password").val()
        },
        dataType: 'json',
        success: function(data){
            if(data.status == "success"){
                localStorage.setItem('username', name);
                localStorage.setItem('connected', true);
                if(data.isadmin){
                    localStorage.setItem('isadmin', true);
                }
                connectedDisplay();
                window.location.replace('index.html');
            }
        }
    });
}

function get_all_article(){
    $.ajax({
        url: 'router.php',
        type: 'POST',
        data: {
            request: "Controller/article.php",
        },
        dataType: 'json',
        success: function(data){
            if(data.status == "error"){
                console.log(data.msg)
            }
            else{
                console.log(data);
            }
        }
    });
}



