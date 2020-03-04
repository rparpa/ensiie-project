// Debut vue chat

function insertChat(who, text, time, ifAuthor, idMessage, idUser, pseudo, avatar) {
    var t = time.split(/[- :]/);
    var date = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));

	var control = `<div class="row" id="` + idMessage + `"> \
        <div class="col-10"> \
            <div class="message d-inline-flex"> \
                <div> \
                    <a class="nav-link" href="index.php?module=module_profile&u=` + pseudo + `"><img src="` + avatar + `" class="rounded-circle avatar"></a> \
                </div> \
                <div class="border rounded bg-white message-content" id="messageContent"> \
                    <small class="font-weight-bold">` + who + `</small> \
                    <div>`
                        + text +
                    `</div> \ 
                </div> \
            </div> \
        </div> \
        <div class="col-2 d-flex align-items-center"> \
            <div class="message-addon text-center container-fluid"> \
            <small>` + date.getHours() + `:` + date.getMinutes() + `</small>`;

    if (ifAuthor) {
        control += '<button data-toggle="modal" data-target="#modal-messagedelete" onclick="trashOrFlagClick(this.parentElement.parentElement.parentElement.id)" class="btn btn-link no-padding"><img src="include/templates/icons/trash-2.svg"/></button>'
    } else {
        control += '<button data-toggle="modal" data-target="#modal-messageflag" onclick="trashOrFlagClick(this.parentElement.parentElement.parentElement.id)" class="btn btn-link no-padding"><img src="include/templates/icons/flag.svg"/></button>'
    }
    
    control += '</div>'
        + '</div>'
    + '</div>';

	$(".chat").append(control);
    var div = $(".chat");
    div.scrollTop(div.prop('scrollHeight'));
}

function alertChat(text) {
    var control = '<div class="message d-inline-flex">' +
            '<div class="border border-danger rounded bg-white text-danger message-content">'
                + text
            + '</div>'
        + '</div>';

    $(".chat").append(control);
    var div = $(".chat");
    div.scrollTop(div.prop('scrollHeight'));
}

// Fin vue chat
//
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
//
// Debut envoyer messages

function sendMessage() {
    if (document.getElementById("messageInput").value.trim() != "") {
        var url_string = window.location.href;
        var url = new URL(url_string);
        var key = url.searchParams.get("key");

        var msg = document.getElementById("messageInput").value;

        var toSend = {"module" : "chat", "action" : "send", "key" : key, "message" : msg};

        $.ajax({
            type: "POST",
            url: "handler.php",
            data: {"data" : JSON.stringify(toSend)},
            error: function(data) {
                alertChat("Something happened please reload the page");
            }
        });

        $("textarea").val("");
    }
}

$("textarea").keydown(function(e){
    if (e.keyCode == 13 && !e.shiftKey) {
        e.preventDefault();
        
        sendMessage();
    }
});

$('#messageButton').click(function(event) {
    sendMessage();
});

// Fin envoyer messages
//
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
//
// Debut recevoir messages

var idMessage = 1;

function loadMessages() {
    var url_string = window.location.href;
    var url = new URL(url_string);
    var key = url.searchParams.get("key");

    var toSend = {"module" : "chat", "action" : "load", "key" : key, "id" : idMessage};
    
    $.ajax({
        type: "POST",
        url: "handler.php",
        dataType : "JSON",
        data: {"data" : JSON.stringify(toSend)},
        success: function(data) {

            $.each(data, function(key, val) {
                insertChat(val.pseudo, val.contenu, val.dateEmis, val.siAuteur, val.idMessage, val.idUser, val.pseudo, val.avatar);
                idMessage = val.idMessage;
            });
        },
        error: function(data) {
            // alertChat(data.status);
        }
    });
}

$(document).ready(function(){
    setInterval(loadMessages, 500);
});

// Fin recevoir messages
//
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
//
// Debut signaler et supprimer

function trashOrFlagClick(id) {
    var toSend = {"module" : "cookie", "name" : "messageId", "value" : id};

    $.ajax({
        type: "POST",
        url: "handler.php",
        data: {"data" : JSON.stringify(toSend)},
        error: function(data) {
            alertChat(data);
        }
    });
};

$('#messageDelete').click(function(event) {
    var toSend = {"module" : "chat", "action" : "delete"};

    $.ajax({
        type: "POST",
        url: "handler.php",
        data: {"data" : JSON.stringify(toSend)},
        success: function(data) {
            var id = "#" + data.replace(/\s/g, '');
            $(id).remove();
            idMessage = $("#chat").last().attr("id");
        }
    });
});

$('#messageFlag').click(function(event) {
    var toSend = {"module" : "chat", "action" : "flag"};

    $.ajax({
        type: "POST",
        url: "handler.php",
        data: {"data" : JSON.stringify(toSend)},
        success: function(data) {
            alertChat(data);
        }
    });
});

// Fin signaler et supprimer
//
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
//
// Debut suppr conv

function delConv() {
    var url_string = window.location.href;
    var url = new URL(url_string);
    var key = url.searchParams.get("key");
    var toSend = {"module" : "cookie", "name" : "key", "value" : key};

    $.ajax({
        type: "POST",
        url: "handler.php",
        data: {"data" : JSON.stringify(toSend)},
        error: function(data) {
            alertChat(data);
        }
    });
};

$('#delConv').click(function(event) {
    var toSend = {"module" : "chat", "action" : "remove"};

    $.ajax({
        type: "POST",
        url: "handler.php",
        data: {"data" : JSON.stringify(toSend)},
        success: function(data) {
            window.location.href = "index.php?module=module_conversations";
        }
    });
});

// Fin suppr conv
//
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
//
// Debut depot de fichier

$("input").on("change", function (e) {

    //
    // /!\ ATTENTION: On n'avons malheureusement pas eu le temps de changer le nom des fichiers lors de l'upload, mais nous savons que cela peut causer de gros problemes
    //
    var file = $(this)[0].files[0];
    console.log(file);

    var formData = new FormData();
    formData.append("file", file, file.name);

    $.ajax({
        type: "POST",
        url: "handler.php",
        data : formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        success : function(data) {
            if (data.replace(/\s/g, '') != "ok") {
                alertChat(data);
            }
        }
    });
});

// Fin depot de fichier
