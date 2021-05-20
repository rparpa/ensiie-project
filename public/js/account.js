jQuery(document).ready(function ($) {
    init();
});

function change_password() {

    let check_all = true;

    $('.passwd_input').each(function () {
        $(this).css("borderColor", "red");
        if (!$(this).val()) {
            shake($(this))
            check_all = false;
        }
        else {
            $(this).css("borderColor", "grey");
        }
    });

    current = $('#currentPassword')
    new_password = $('#passwordAccount');
    new_verif = $('#passwordAccountVerif');

    if (new_password.val().length < new_password.attr("minlength")) {
        $('#alertPassword_length').show();
        shake(new_password);
        shake(new_verif);
        check_all = false;
    }

    $('#alertPassword_length').hide();

    // Verification nouveau mot de passe

    if (new_password.val() != new_verif.val() || new_password.val() == "") {
        $('#alertPassword').show();
        shake(new_password);
        shake(new_verif);
        check_all = false;
    } else {
        new_password.css("borderColor", "grey");
        new_verif.css("borderColor", "grey");
        $('#alertPassword').hide();
    }

    // verification ancien mot de passe
    console.log("test")
    if (current.val().length >= current.attr("minlength")) {
        $.ajax({
            type: 'POST',
            url: 'router.php',
            data: {
                request: "account.php",
                username: localStorage.getItem('username'),
                password: current.val(),
                to_do: "check_password"
            },
            dataType: 'json',
            success: function (data, status, xml) {
                console.log("test")
                if (data.status != "success") {
                    check_all = false;
                }
            }
        });
    }

    if(check_all){
        $.ajax({
            type: 'POST',
            url: 'router.php',
            data: {
                request: "account.php",
                username: localStorage.getItem('username'),
                password: new_password.val(),
                to_do: "change_password"
            },
            dataType: 'json',
            success: function (data, status, xml) {
                $('#SucessPassword').show();
                setTimeout(function(){
                    $('#SucessPassword').hide();
                }, 15);
            }
        });
    }
};

/* TODO
function check_email(obj) {
    if (!obj.val().match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g)) {
        $('#alertMailUse').hide();
        $('#alertMail').show();
        shake(obj)
        return false;
    } else {
        $('#alertMail').hide();
        let result;
        $.ajax({
            type: 'POST',
            async: false,
            url: 'router.php',
            data: {
                request: "inscription.php",
                email: obj.val(),
                to_do: "check_email"
            },
            dataType: 'json',
            success: function (data, status, xml) {
                if (data.status != "success") {
                    $('#alertMailUse').show();
                    shake(obj);
                    result = false;
                }
                else {
                    $(this).css("borderColor", "grey");
                    $('#alertMailUse').hide();
                    result = true;
                }
            }
        });
        return result;
    }
} */