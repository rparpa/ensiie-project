function loadCategoriesToValidate(){
    window.history.pushState('', 'Load article', "/admin.php?ca=1");
    $("#content_admin").empty();
    loadMenuAdmin();
    getCategoriesToValidate();
}
function getCategoriesToValidate(){
    $.ajax({
        type: 'POST',
        url: 'router.php',
        async: false,
        data: {
            request: "Controller/get_proposed_categories.php",
        },
        dataType: 'json',
    }).done(function(data){
        setCategoriesToValidate(data.categories);
    });
}

function setCategoriesToValidate(categories){
    $("#content_admin").append('<div id="article_title" class="col-12" style="margin-bottom: 3%; margin-top:2%;" >Catégorie à valider</div>');
    $("#content_admin").append('<table class="table table-striped w-50 mx-auto"><tbody id="tableBody"></tbody></table>');    
    let nb = 1;
    categories.forEach(cat => {
        $("#tableBody").append(
            `<tr class="row" id="` + nb + `">
                <td class="col">`+ nb + `</td>
                <td class="col">` + cat.name + `</td>
                <td class="col">
                    <div>
                        <button onclick='decisionCat(1, "` + cat.name + `",` + nb + ` )' class="btn btn-success"> <i class="fas fa-check"></i> </button>
                        <button onclick='decisionCat(0, "` + cat.name + `",` + nb + `)' class="btn btn-danger"> <i class="fas fa-ban"></i> </button>
                    </div>
                </td>
            </tr>`
        );

        nb++;
    });
}
function decisionCat(keep, name, id){
    $.ajax({
        type: 'POST',
        url: 'router.php',
        async: false,
        data: {
            request: "Controller/decision_proposed_categories.php",
            keep: keep,
            name: name
        },
        dataType: 'json',
    }).done(function(data){
        $("#" + id).find("button").attr('disabled', true);
        if(keep){ $("#" + id).find("button").removeClass('btn-danger');  }
        else{ $("#" + id).find("button").removeClass('btn-success');}
        $("#" + id).find("button").addClass('btn-secondary');
        
    });
}

function loadArticleToValidate(){
    $("#content_admin").empty();
    $("#content_admin").append('<div id="article_title" class="col-12" style="margin-bottom: 3%; margin-top:2%;" >Articles à valider</div>');
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
        loadAdminArticleContent(data.sections, data.page.id_page);
        loadArticleIntro(data.page);
    });
}

function loadMenuAdmin(){
    $("#nav_admin").empty();
    $("#nav_admin").append(`<span class="sommaire">Admin</span>`);
    $("#nav_admin").append(`<a onclick="loadArticleToValidate();"><i class='fas fa-circle'></i>Articles à valider</a>`);
    $("#nav_admin").append(`<a onclick="loadCategoriesToValidate();"><i class='fas fa-circle'></i>Catégories à valider</a>`);
    $("#nav_admin").append(`<a onclick="loadDemandeModo();"><i class='fas fa-circle'></i></i>Moderateurs</a><br><br>`);

}

function loadAdminArticleContent(sections, articleID) {

    $("#nav_admin").append(`<span class="sommaire">Sommaire</span>`);
    $("#nav_admin").append(`<a href="#Synopsis"><i class="fas fa-circle"></i>Synopsis</a>`);
    console.log(sections);
    sections.forEach(s => {
        // Ajout dans le mini menu
        $("#nav_admin").append(`<a href="#` + s.title + `"><i class="fas fa-circle"></i>` + s.title + `</a>`);
        // ajoute la sections a la page
        $("#section_container").append(`
            <div class="row section_article">
                <div class="col-12">
                    <h1 id="` + s.title + `" class="section_title">` + s.title + `<button style="margin-left:7px;" class="btn btn-sm btn-danger" onclick="removeSection(` + s.id_section+ `,` + articleID + `)"> <i class="fas fa-trash" style="font-size:140%;"></i></button><br></h1>
                </div>
            </div>
            <div class="row"><div class="col-12 section_content">` + s.content + `</div></div><br>`);
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
    $("#content_admin").append('<div id="article_title" class="col-12" style="margin-bottom: 3%; margin-top:2%;">Modérateurs</div>');
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

function removeSection(sectionID, articleID){
    console.log(sectionID + " --- " +  articleID);
    $.ajax({
        type: 'POST',
        url: 'router.php',
        async: false,
        data: {
            request: "Controller/remove_section.php",
            sectionID: sectionID,
            articleID: articleID
        },
        dataType: 'json',
    }).done(function(param) {  
        console.log(param);
        window.location.reload();
    })
}