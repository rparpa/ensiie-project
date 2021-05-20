jQuery(document).ready(function ($) {
    init();
});

function change_password() {
    var check_all = true;

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

    current = $('#currentPassword');
    new_password = $('#passwordAccount');
    new_verif = $('#passwordAccountVerif');
    console.log(current.val() + " :: " + new_password.val() + " :: " + new_verif.val())

    if (new_password.val().length < new_password.attr("minlength")) {
        $('#alertPassword_length').show();
        shake(new_password);
        shake(new_verif);
        check_all = false;
    } else {
        $('#alertPassword_length').hide();
        new_password.css("borderColor", "grey");
        new_verif.css("borderColor", "grey");
    }

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

    if (new_password.val() == current.val()) {
        $('#alertSamePassword').show();
        shake(current);
        shake(new_password);
        shake(new_verif);
        check_all = false;
    } else {
        current.css("borderColor", "grey");
        new_password.css("borderColor", "grey");
        new_verif.css("borderColor", "grey");
        $('#alertSamePassword').hide();
    }

    if (current.val().length >= current.attr("minlength")) {
        $.ajax({
            type: 'POST',
            url: 'router.php',
            async: true,
            data: {
                request: "account.php",
                username: localStorage.getItem('username'),
                password: current.val(),
                to_do: "check_password"
            },
            dataType: 'json',
            success: function (data, status, xml) {
                if (data.status == "success") {
                    $('#alertCurrentPassword').hide();
                    current.css("borderColor", "grey");
                } else {
                    $('#alertCurrentPassword').show();
                    shake(current);
                    check_all = false;
                }
            }
        });
    }
    else {
        $('#alertCurrentPassword').show();
        shake(current);
        check_all = false;
    }

    if (check_all)
        send_new_password();
};

function send_new_password() {
    $.ajax({
        type: 'POST',
        url: 'router.php',
        data: {
            request: "account.php",
            username: localStorage.getItem('username'),
            new_password: new_password.val(),
            to_do: "change_password"
        },
        dataType: 'json',
        success: function (data, status, xml) {
            $('#sucessPassword').show();
            setTimeout(function () {
                $('#sucessPassword').hide();
            }, 10000);
        }
    });
}

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