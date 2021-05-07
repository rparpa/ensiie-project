jQuery(document).ready(function($) {

    $('.alertField, .onlyUser, .onlyAdmin').hide();

    $("#username").change(function(){
        localStorage.setItem("username", $("#username").val())
    });

    $("#username").val(localStorage.getItem("username"));

    $("#form_inscription").change(function () {
        before_submit();
        
    });
});

function send_inscription(){
    before_submit();
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

    check_all = check_password($('#password1'), $('#password2'));;
    


    check_all = check_email($('#email_form'));

    if(check_all)
        $.ajax({
            type:'POST',
            url:'inscription.php',
            data:{
                pseudo: $('#pseudo_form').val(), 
                to_check: "pseudo"
            },
            dataType: 'json',
            success: function(data, status, xml){
                if(data.status != "success"){
                    $('#alertUsername').show();
                    shake($('#pseudo_form'));
                    check_all = false;
                }
                else{
                    $(this).css("borderColor","grey");
                    $('#alertUsername').hide();
                }
            }
        });
    return check_all;
};

function check_password(obj1, obj2){
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

function check_email(obj){
    if (obj.val().match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g)){
        $('#alertMail').hide();
        obj.css("borderColor","grey");
        return true;
    }else{
        $('#alertMail').show();
        shake(obj)
        return false;
    }
}

function shake(obj){
    obj.removeClass('shake');
    obj.css("borderColor","red");
    setTimeout(function(){
        obj.addClass('shake');
    });
}