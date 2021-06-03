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
                load_all_article(data);
                console.log(data);
            }
        }
    });
}


function load_all_article(data){
    console.log("display");
    var body = $("body")

    data.forEach(e => {
        let cat = "";
        if ((e.cat0 == '' || e.cat0 == 'Aucune') && (e.cat1 == '' || e.cat1 == 'Aucune'))
            cat = `<a class='black_text'> Aucune </a>`;
        else {
            if (e.cat0 != '' && e.cat0 != 'Aucune')
                cat = `<a class='black_text'>` + e.cat0 + `</a>`;
            if (e.cat1 != '' && e.cat1 != 'Aucune' && cat != "")
                cat += ` et <a class='black_text'>` + e.cat1 + `</a>`;
            else
                cat += `<a class='black_text'>` + e.cat1 + `</a>`;
        }
        
        let html = `
        <div class="card text-center mx-auto bg-light mb-3" style="width: 1000px; margin-top:50px;">
            <a href="index.html">
                <div class="card-header bg-info text-white display_list_article"><h4><span class="glyphicon glyphicon-star"></span>` + e.title + `</h4></div>
            </a>
            <br>
            <div class="row">
                <div id="synopsis" class="col-12 display_list_article"><p class="black_text">` + e.synopsis + `</p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-5 display_list_article"><h5 class="black_text">Categories: ` + cat + `</h5></div>       
                <div class="col-3 display_list_article"><h6>Création: <span class="blue_text">` + e.creation_date + `</span></h6></div>
                <div class="col-4 display_list_article"><h6>Dernière modification: <span class="blue_text">` + e.modification_date + `</span></h6></div>
            </div>
        </div>`
        
        body.append(html);
    });
}


