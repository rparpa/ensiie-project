function editArticle(){

    let query = window.location.search;
    let urlParams = new URLSearchParams(query);

    let id = urlParams.get('id');
    window.location = '/edition.php?id=' + id;
}

function unlock(id){
    let current = $("#section" + id);
    
    if(current.prop('disabled') == undefined){
        current.prop('disabled', true);
    }

    let isDisabled = current.prop('disabled');
    if(isDisabled){
        current.prop("disabled", false);
        current.find(".content *").prop("disabled", false);
        current.find("button").prop("disabled", false);
        current.find(".edit").prop("disabled", true);
    }
    else{
        current.prop("disabled", true);
        current.find(".content *").prop("disabled", true);
        current.find("button").prop("disabled", true);
        current.find(".edit").prop("disabled", false);

        current.find("textarea").val(current.find("textarea").text());
    }
}

function updateSection(articleId, sectionId){
    let section = $("#section" + sectionId);
    let newSection = {};

    newSection.articleID = articleId;
    newSection.sectionID = sectionId;
    newSection.title = section.find(".sectionTitle").val();
    newSection.content = section.find(".sectionContent").val();

    $.ajax({
        url: 'router.php',
        type: 'POST',
        data: {
            request: "Controller/update_section.php",
            section: newSection
        },
        dataType: 'json'
    })
    .done(function(data){
        window.location.reload();
    });
}

function updateArticle(articleId){
    let article = $("#synopsis" + articleId);
    let newArticle = {};

    newArticle.articleID = articleId;
    newArticle.synopsis = article.val();

    $.ajax({
        url: 'router.php',
        type: 'POST',
        data: {
            request: "Controller/update_article.php",
            article: newArticle
        },
        dataType: 'json'
    })
    .done(function(data){
        window.location.reload();
    });
}

function addSectionInput(articleID){
    let id = $(".newSection").length;
    let newSec = "newSection" + id;
    $("#sections").append(
        "<div id=" + newSec + " class='form-group'>"
    );
    $("#" + newSec).append(
        "<label for=section" + id + "> Nouvelle Section </label>",
        "<input class='form-control w-100' type=text maxlength=128 id='title" + id + "'>",  
        "<textarea class='form-control w-100' id='content" + id + "'></textarea>",
        "<button onclick=addSection(" + articleID +"," + id +") class='btn-success col-2 form-control'> Ajouter la section </button>"
    );
    autosize();
}

function addSection(articleID, secID){
    let newSection = {};
    newSection.articleID = articleID;
    newSection.title = $("#title" + secID).val();
    newSection.content = $("#content" + secID).val();

    $.ajax({
        url: 'router.php',
        type: 'POST',
        data: {
            request: "Controller/add_section.php",
            section: newSection
        },
        dataType: 'json'
    }).done(function(data){
        window.location.reload();
    });   
}

function autosize(){
    $("textarea").each(function () {
        this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
    })
    .on("input", function () {
        this.style.height = "auto";
        this.style.height = (this.scrollHeight) + "px";
    });
}
