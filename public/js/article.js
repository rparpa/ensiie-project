function setCategories(){
    loadCategories().forEach(e => {
        $("#cat0").append("<option value=" + e.name + ">" + e.name + "</option>");
        $("#cat1").append("<option value=" + e.name + ">" + e.name + "</option>");
    });
}

function changeButton(){
    $("#btnAddArticle").attr("onclick", "postArticle()");
    $("#btnAddArticle").text("Publier l'article");
    $("#btnAddArticle").addClass("btn-success");
}

function addSection(){
    let id = $(".section").length;
    $("#sections").append(
        "<br><div id=sect" + id +  " class='section card'>"
    );
    $("#sect" + id).append(
        `<div class="card-header text-info"> Section ` + (id + 1) + ` </div>`,
        `<div class="card-body">
            <label for=section`+ id + `> <b> Titre de la section </b> </label>
            <input type="text" maxlength="100" id="section` + id + `" class="form-control" required>
            <br>
            <label for="content`+ id + `"> <b> Contenu de la section </b> </label><br>
            <textarea id="content`+ id + `" class="form-control" rows=7 required></textarea>
        </div>`
    );

}

function articleValid(article){
    let fields = ['title', 'author', 'syno'];
    
    for(let i = 0; i < fields.length; i++){
        if(article[fields[i]] === "") return false;
    }
    for(let i = 0; i < article.sections.length; i++){
        let section = article.sections[i];
        let t_empty = section.title === "";
        let c_empty = section.content === "";

        if(t_empty && c_empty){}
        else if(t_empty || c_empty) return false;
    }
    
    return true;
}

function articleExist(article){
    let rval = true;
    $.ajax({
        url: 'router.php',
        type: 'POST',
        async: false,
        data: {
            request: "Controller/article_exist.php",
            title: article.title
        },
        dataType: 'json',
        success: function(data){
            if(data.status == "success"){ 
                alert("Un article du même nom existe déja");
                rval =  true;
            }
            else{
                rval = false;
            }
        }
    }); 
    return rval;
}

function postArticle(){
    let article = {};

    article.title = $("#title").val();
    article.author = localStorage.getItem("username");
    article.synopsis = $("#syno").val();
    article.cat0 = $("#cat0").val();
    article.cat1 =  $("#cat1").val();
    article.sections = [];

    let size = $(".section").length;
    for(let i = 0; i < size; i++){
        let section = {};
        if($("#section" + i).val() == "" || $("#content" + i).val() == ""){
            if(confirm('Une section est vide. Voulez-vous continuer?')){
                article.sections.push(section);
                continue;
            }
            else{
                return false;
            }
        }        
        section.title = $("#section" + i).val();
        section.content = $("#content" + i).val();
        article.sections.push(section);
    }
    if(articleExist(article)) return false;

    if(!articleValid(article)) {
        alert("DES CHAMPS SONT VIDE");
        return false;
    }
    $.ajax({
        url: 'router.php',
        type: 'POST',
        data: {
            request: "Controller/add_article.php",
            article: article
        },
        dataType: 'json'
    }).done(function(data){
        if(data.status == "success"){ 
            window.location.replace("index.php?id=" + data.articleID);
        }
        else{
            // TODO show error somewhere
            alert("LOADING ERROR");
        }
    });
}