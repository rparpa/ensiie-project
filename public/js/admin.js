function loadArticleToValidate(){
    $("#content_admin").empty();
    loadMenuAdmin();
    window.history.pushState('', 'Load article', "/admin.php?va=1");
    getArticleToValidate().forEach(e => {
        fetch('template/admin_list_article.html')
            .then(response => response.text())
            .then(function(data){
                data = data.replaceAll("%%ID_PAGE%%", e.id_page);
                data = data.replaceAll("%%TITLE%%", e.title);
                data = data.replaceAll("%%SYNOPSIS%%", e.synopsis);
                data = data.replaceAll("%%CATEGORIE%%", getCatText(e));
                data = data.replaceAll("%%CREATION_DATE%%", e.creation_date);
                data = data.replaceAll("%%MODIF_DATE%%", e.modification_date);
                $("#content_admin").append(data);
            });
    })
}

function loadAdminArticle(id) {
    data = getArticle(id);
    window.history.pushState('', 'Load article', "?id="+id);
    $("#content_admin").load('template/admin_article.html', function () {
        loadMenuAdmin();
        loadAdminArticleContent(data.sections);
        loadArticleIntro(data.page);
    });
}

function loadMenuAdmin(){
    $("#nav_admin").empty();
    $("#nav_admin").append(`<span class="sommaire">Admin</span>`);
    $("#nav_admin").append(`<a onclick="loadArticleToValidate();"><i class='fas fa-circle'></i>Articles à valider</a>`);
    $("#nav_admin").append(`<a onclick="loadDemandeModo();"><i class='fas fa-circle'></i></i>Moderateurs</a><br><br>`);

}

function loadAdminArticleContent(sections) {

    $("#nav_admin").append(`<span class="sommaire">Sommaire</span>`);
    $("#nav_admin").append(`<a href="#Synopsis"><i class="fas fa-circle"></i>Synopsis</a>`);

    sections.forEach(s => {
        // Ajout dans le mini menu
        $("#nav_admin").append(`<a href="#` + s.title + `"><i class="fas fa-circle"></i>` + s.title + `</a>`);
        // ajoute la sections a la page
        $("#section_container").append(`<div class="row section_article"><div class="col-12"><h1 id="` + s.title + `" class="section_title">` + s.title + `</h1></div></div><div class="row"><div class="col-12 section_content">` + s.content + `</div></div>`);
    });
}

function getArticleToValidate(){
    let dataA;
    $.ajax({
        type: 'POST',
        url: 'router.php',
        async: false,
        data: {
            request: "Controller/admin.php",
            to_do: "getArticleToValidate"
        },
        dataType: 'json',
    }).done(function(data){
        dataA = data.articles;
    });
    return dataA;
}

function loadDemandeModo(){
    $("#content_admin").empty();
    loadMenuAdmin();
    window.history.pushState('', 'Load article', "?mo=1");
    getDemandeModo().forEach(e => {
        fetch('template/demande_modo.html')
            .then(response => response.text())
            .then(function(data){
                data = data.replaceAll("%%USERNAME%%", e.username);
                data = data.replaceAll("%%MSG%%", e.msg);
                $("#content_admin").append(data);
            });
    })
}

function getDemandeModo(){
    let dataM
    $.ajax({
        type: 'POST',
        url: 'router.php',
        async: false,
        data: {
            request: "Controller/admin.php",
            to_do: "getDemandeModo"
        },
        dataType: 'json',
    }).done(function(data){
        dataM = data.demande;
    });
    return dataM;
}

function validateModo(user){
    $.ajax({
        type: 'POST',
        url: 'router.php',
        async: false,
        data: {
            request: "Controller/admin.php",
            username: user,
            to_do: "validateModo"
        },
        dataType: 'json',
    }).done(loadDemandeModo())
}

function validateArticle(id){
    $.ajax({
        type: 'POST',
        url: 'router.php',
        async: false,
        data: {
            request: "Controller/admin.php",
            id_article: id,
            to_do: "validateArticle"
        },
        dataType: 'json',
    }).done(loadArticleToValidate())
}

function removeArticle(id){
    $.ajax({
        type: 'POST',
        url: 'router.php',
        async: false,
        data: {
            request: "Controller/admin.php",
            id_article: id,
            to_do: "removeArticle"
        },
        dataType: 'json',
    }).done(loadArticleToValidate())
}

function removeModo(id){
    $.ajax({
        type: 'POST',
        url: 'router.php',
        async: false,
        data: {
            request: "Controller/admin.php",
            username: id,
            to_do: "removeDemandeModo"
        },
        dataType: 'json',
    }).done(loadDemandeModo())
}