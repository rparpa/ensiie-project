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

function verifyser() {
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
                $("#div_alert").css('background-color', '#f8f9fb');
            }, 5000);
        }
    })
}

function getAllArticle() {
    $.ajax({
        url: 'router.php',
        type: 'POST',
        data: {
            request: "Controller/get_article.php",
            to_do: "getAll",
        },
        dataType: 'json'
    }).done(function (data) {
        if (data.status == "error") {
            console.log(data.msg);
        }
        else {
            loadAllArticle(data);
            setIndexCategories();
        }
    })
}

function loadCategories(){
    let dataC = "";
    $.ajax({
        url: 'router.php',
        type: 'POST',
        async: false,
        data: {
            request: "Controller/get_categories.php",
            to_do: "getAll"
        },
        dataType: 'json'
    }).done(function(data){
        if(data.status == "success"){
            dataC = data.categories;
        }
        else{
            // TODO show error somewhere
            alert("LOADING ERROR");
        }
    });
    return dataC;
}

function setIndexCategories(){
    $("#nav_article").empty();
    $("#nav_article").append(`<span class="categories">Catégories</span>`);
    $("#nav_article").append(`<a onclick="getAllArticle();"><i class="fas fa-eraser"></i>Nettoyer filtre</a>`);
    loadCategories().forEach(e => {
        $("#nav_article").append(`<a onclick="loadArticleByCategories('` + e.name + `')"><i class='fas fa-circle'></i>` + e.name + `</a>`);
    });
}

function loadArticleByCategories(cat){
    $.ajax({
        url: 'router.php',
        type: 'POST',
        async: false,
        data: {
            request: "Controller/get_categories.php",
            to_do: "get_by_cat",
            cat: cat
        },
        dataType: 'json'
    }).done(function(data){
        if(data.status == "success"){
            
            loadAllArticle(data.articles);
        }
        else{
            alert("LOADING ERROR");
        }
    });
}

function getCatText(page){
    let cat = "";
    
    if ((page.cat0 == '' || page.cat0 == 'Aucune') && (page.cat1 == '' || page.cat1 == 'Aucune'))
            cat = `<a class='black_link' onclick="loadArticleByCategories('` + page.cat0 + `')"> Aucune </a>`;
        else {
            if (page.cat0 != '' && page.cat0 != 'Aucune')
                cat = `<a class='black_link' onclick="loadArticleByCategories('` + page.cat0 + `')">` + page.cat0 + `</a>`;
            if (page.cat1 != '' && page.cat1 != 'Aucune')
                if(cat != "")
                    cat += ` et <a class='black_link' onclick="loadArticleByCategories('` + page.cat1 + `')">` + page.cat1 + `</a>`;
                else
                    cat += `<a class='black_link' onclick="loadArticleByCategories('` + page.cat1 + `')">` + page.cat1 + `</a>`;
        }
    return cat;
}

function loadAllArticle(data) {
    $("#content").empty();
    window.history.pushState('', 'Load article', "/index.php");
    loadSearch();
    data.forEach(e => {
        let valide = "";
        if (e.validated)
            valide = `<span><i class="fas fa-star star_index"></i></span>`;

        fetch('template/list_article.html')
            .then(response => response.text())
            .then(function(data){
                data = data.replaceAll("%%ID_PAGE%%", e.id_page);
                data = data.replaceAll("%%TITLE%%", e.title);
                data = data.replaceAll("%%VALIDATE%%", valide);
                data = data.replaceAll("%%SYNOPSIS%%", e.synopsis);
                data = data.replaceAll("%%CATEGORIE%%", getCatText(e));
                data = data.replaceAll("%%CREATION_DATE%%", e.creation_date);
                data = data.replaceAll("%%MODIF_DATE%%", e.modification_date);
                $("#content").append(data);
            });
    });
}

function getArticle(id) {
    let e;
    $.ajax({
        url: 'router.php',
        type: 'POST',
        async: false,
        data: {
            request: "Controller/get_article.php",
            to_do: "getArticle",
            id_article: id,
        },
        dataType: 'json'
    }).done(function (data) {
        if (data.status == "error") {
            console.log(data.msg)
        }
        else {
            e =  data;
        }
    });
    return e;
}

function loadArticleContent(sections) {
    
    $("#nav_article").empty();
    $("#nav_article").append(`<span class="sommaire">Sommaire</span>`);
    $("#nav_article").append(`<a href="#Synopsis"><i class="fas fa-circle"></i>Synopsis</a>`);

    sections.forEach(s => {
        // Ajout dans le mini menu
        $("#nav_article").append(`<a href="#` + s.title + `"><i class="fas fa-circle"></i>` + s.title + `</a>`);
        // ajoute la sections a la page
        $("#section_container").append(`<div class="row section_article"><div class="col-12"><h1 id="` + s.title + `" class="section_title">` + s.title + `</h1></div></div><div class="row"><div class="col-12 section_content">` + s.content + `</div></div>`);
    });
}

function loadArticleIntro(page) {
    $("#article_title").html(page.title);
    if(page.validated)
        $("#article_title").append(`<span><i class="fas fa-star star_article"></i></span>`);

    
    $("#article_cat").append(getCatText(page));

    $("#article_date_crea").append(`<span class="black_text">` + page.creation_date + `</span>`)
    $("#article_date_modif").append(`<span class="black_text">` + page.modification_date + `</span>`)

    $("#synopsis_content").html(page.synopsis);

    init();
}

function load_article(id) {
    data = getArticle(id);
    window.history.pushState('', 'Load article', "?id="+id);
    $("#content").load('template/article.html', function () {
        loadArticleContent(data.sections);
        loadArticleIntro(data.page);
    });

}

function editArticle(){

    let query = window.location.search;
    let urlParams = new URLSearchParams(query);

    let id = urlParams.get('id');
    window.location = '/edition.php?id=' + id;
}