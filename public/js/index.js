jQuery(document).ready(function ($) {
    init();

    // Permet d'avoir un affichage au bon niveau lors des href sur les ID de la page
    window.addEventListener("hashchange", function () {
        window.scrollTo(window.scrollX, window.scrollY - 100);
    });

    $("body").click(function (e) {
        let nav = $("#navbar");
        if ((e.target.className == 'navbar-toggler-icon' || e.target.className == 'navbar-toggler collapsed') && !nav.is(':visible'))
            nav.show();
        else
            nav.hide();
    })
});

function init() {
    $('.alertField').hide();
    if (localStorage.getItem('connected') == 'true') {
        connectedDisplay();
        return;
    }
    $('.onlyUser, .onlyAdmin').hide();

    $("#username").change(function () {
        localStorage.setItem("username", $("#username").val())
    });
    $("#username").val(localStorage.getItem("username"));
}

function connectedDisplay() {
    $("#affiche_name").html("Bonjour " + localStorage.getItem("username") + " !");
    $(".onlyUser").show();

    $(".notUser").hide();

    if (localStorage.getItem('isadmin') == 'true') $(".onlyAdmin").show();
    else $(".onlyAdmin").hide();
}

function deconnection() {
    localStorage.setItem('username', '');
    localStorage.setItem('connected', null);
    localStorage.setItem('isadmin', null);
    window.location.replace('index.php');
}

function shake(obj) {
    obj.removeClass('shake');
    obj.css("borderColor", "red");
    setTimeout(function () {
        obj.addClass('shake');
    });
}

function verify_user() {
    let name = $("#username").val();

    $.ajax({
        url: 'router.php',
        type: 'POST',
        data: {
            request: "Controller/verify_user.php",
            username: name,
            pwd: $("#password").val()
        },
        dataType: 'json'
    }).done(function (data) {
        if (data.status == "success") {
            localStorage.setItem('username', name);
            localStorage.setItem('connected', true);
            if (data.isadmin) {
                localStorage.setItem('isadmin', true);
            }
            connectedDisplay();
            window.location.replace('index.php');
        }
        else{
            $("#connection_failed").show();
            $("#div_alert").css('background-color', 'rgba(255,0,0,0.5)');
            setTimeout(function () {
                $('#connection_failed').fadeOut();
                $("#div_alert").css('background-color', '#ffffff');
            }, 5000);
        }
    })
}

function get_all_article() {
    $.ajax({
        url: 'router.php',
        type: 'POST',
        data: {
            request: "Controller/get_article.php",
            to_do: "get_all",
        },
        dataType: 'json'
    }).done(function (data) {
        if (data.status == "error") {
            console.log(data.msg);
        }
        else {
            load_all_article(data);
        }
    })
}
function get_cat_text(page){
    let cat = "";
    
    if ((page.cat0 == '' || page.cat0 == 'Aucune') && (page.cat1 == '' || page.cat1 == 'Aucune'))
            cat = `<a class='black_link'> Aucune </a>`;
        else {
            if (page.cat0 != '' && page.cat0 != 'Aucune')
                cat = `<a class='black_link'>` + page.cat0 + `</a>`;
            if (page.cat1 != '' && page.cat1 != 'Aucune')
                if(cat != "")
                    cat += ` et <a class='black_link'>` + page.cat1 + `</a>`;
                else
                    cat += `<a class='black_link'>` + page.cat1 + `</a>`;
        }
    return cat;
}

function load_all_article(data) {
    data.forEach(e => {
        let valide = "";
        if (e.validated)
            valide = `<span><i class="fas fa-star star_index"></i></span>`;

        fetch('template/list_article.html')
            .then(response => response.text())
            .then(function(data){
                data = data.replace("%%ID_PAGE%%", e.id_page);
                data = data.replace("%%TITLE%%", e.title);
                data = data.replace("%%VALIDATE%%", valide);
                data = data.replace("%%SYNOPSIS%%", e.synopsis);
                data = data.replace("%%CATEGORIE%%", get_cat_text(e));
                data = data.replace("%%CREATION_DATE%%", e.creation_date);
                data = data.replace("%%MODIF_DATE%%", e.modification_date);
                $("#content").append(data);
            });
    });
}

function get_article(id) {
    $.ajax({
        url: 'router.php',
        type: 'POST',
        data: {
            request: "Controller/get_article.php",
            to_do: "get_article",
            id_article: id,
        },
        dataType: 'json'
    }).done(function (data) {
        if (data.status == "error") {
            console.log(data.msg)
        }
        else {
            load_article(data);
            window.history.pushState('', 'Load article', "?id="+id);
        }
    });
}

function load_article_content(sections) {
    
    sections.forEach(s => {
        // Ajout dans le mini menu
        $("#nav_article").append(`<a href="#` + s.title + `">` + s.title + `</a>`);
        // ajoute la sections a la page
        $("#section_container").append(`<div class="row section_article"><div class="col-12"><h1 id="` + s.title + `" class="section_title">` + s.title + `</h1></div></div><div class="row"><div class="col-12 section_content">` + s.content + `</div></div>`);
    });
}

function load_article_intro(page) {
    $("#article_title").html(page.title);
    if(page.validated)
    $("#article_title").append(`<span><i class="fas fa-star star_article"></i></span>`);

    
    $("#article_cat").append(get_cat_text(page));

    $("#article_date_crea").append(`<span class="black_text">` + page.creation_date + `</span>`)
    $("#article_date_modif").append(`<span class="black_text">` + page.modification_date + `</span>`)

    $("#synopsis_content").html(page.synopsis);
}

function load_article(data) {
    $("#content").load('template/article.html', function () {
        load_article_content(data.sections);
        load_article_intro(data.page);
    });
    // TODO GARDER LE DERNIER ARTICLE VISITÉ EN MEMOIR PR PAS RETOURNER A INDEX QUAND ON RELOAD
}

