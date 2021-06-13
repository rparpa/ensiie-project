jQuery(document).ready(function($) {

    $(".inscription_input").change(function(){
        localStorage.setItem($(this).attr('name'), $(this).val())
    });

    $(".inscription_input").each(function() {
        $(this).val(localStorage.getItem($(this).attr('name')));
    });

    $("#form_inscription").change(function () {
        before_submit();
    });
});

function send_inscription(){
    if(before_submit())
        $.ajax({
            type:'POST',
            url:'router.php',
            data:{
                request: "Controller/inscription.php",
                username: $('#username_form').val(),
                password: $('#password1').val(),
                email: $('#email_form').val(),
                to_do: "inscription"
            },
            dataType: 'json'
        }).done(function(data, status, xml){
            if(data.status == "success"){
                localStorage.setItem('username', $('#username_form').val());
                $(".SuccessInscription").show();
                send_mail($('#username_form').val(), $('#email_form').val());
                setTimeout(function(){
                    window.location.replace("index.php");
                }, 5000);
                window.location.replace("#SuccessInscription");
            }
        });
};

function send_mail(username, mail){
    $.ajax({
        type:'POST',
        url:'mail.php',
        data:{
            username: username,
            email: mail,
        },
        dataType: 'json'
    });
}

function before_submit() {

    let check_all = true;
    $('.inscription_input').each(function() {
        $(this).css("borderColor","red");
        if(!$(this).val()){
            shake($(this))
            check_all = false;
        }
        else{
            $(this).css("borderColor","grey");
        }
    });

    if(!check_password($('#password1'), $('#password2')))
        check_all = false;
    if(!check_email($('#email_form')))
        check_all = false;
    if(!check_username($('#username_form')))
        check_all = false;
    return check_all;
};

function check_password(obj1, obj2){

    if(obj1.val().length < obj1.attr("minlength")){
        $('#alertPassword_length').show();
        shake(obj1);
        shake(obj2);
        return false;
    }
    else{
        $('#alertPassword_length').hide();
        if (obj1.val() != obj2.val() || obj1.val() == ""){
            $('#alertPassword').show();
            shake(obj1);
            shake(obj2);
            return false;
        }else{
            obj1.css("borderColor","grey");
            obj2.css("borderColor","grey");
            $('#alertPassword').hide();
            return true;
        }
    }
}

function check_email(obj){
    if (!obj.val().match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g)){
        $('#alertMailUse').hide();
        $('#alertMail').show();
        shake(obj)
        return false;
    }else{
        $('#alertMail').hide();
        let result;
        $.ajax({
            type:'POST',
            async: false,
            url:'router.php',
            data:{
                request: "Controller/inscription.php",
                email: obj.val(),
                to_do: "check_email"
            },
            dataType: 'json',
            success: function(data, status, xml){
                if(data.status != "success"){
                    $('#alertMailUse').show();
                    shake(obj);
                    result = false;
                }
                else{
                    $(this).css("borderColor","grey");
                    $('#alertMailUse').hide();
                    result = true;
                }
            }
        });
        return result;
    }
}

function check_username(obj){
    if (obj.val().length < obj.attr("minlength")){
        $('#alertUsername_length').show();
        $('#alertUsername').hide();
        shake(obj);
        return false;
    }
    else{
        $('#alertUsername_length').hide();
        let result;
        $.ajax({
            type:'POST',
            async : false,
            url:'router.php',
            data:{
                request: "Controller/inscription.php",
                username: obj.val(),
                to_do: "check_username"
            },
            dataType: 'json',
            success: function(data, status, xml){
                if(data.status != "success"){
                    $('#alertUsername').show();
                    shake(obj);
                    result = false;
                }
                else{
                    $(this).css("borderColor","grey");
                    $('#alertUsername').hide();
                    result = true
                }
            }
        });
        return result;
    }
}

function shake(obj){
    obj.removeClass('shake');
    obj.css("borderColor","red");
    setTimeout(function(){
        obj.addClass('shake');
    });
}
