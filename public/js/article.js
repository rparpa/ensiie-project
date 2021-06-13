
function setCategories(categories){
    for(let i = 0; i < 2; i++){
        for(let id = 0; id < categories.length; id++){
            let name = categories[id].name;
            $("#cat" + i).append("<option value=" + name + ">" + name + "</option>");
        }
    }
}

function loadCategories(){
    $.ajax({
        url: 'router.php',
        type: 'GET',
        data: {
            request: "Controller/get_categories.php"
        },
        async: false,
        dataType: 'json',
        success: function(data){
            if(data.status == "success"){
                setCategories(data.categories);  
            }
            else{
                // TODO show error somewhere
                alert("LOADING ERROR");
            }
        }
    });  
}

function addSection(){
    let id = $(".section").length;
    $("#sections").append(
        "<div id=sect" + id +  " class='section'>"
    );
    $("#sect" + id).append(
        "<label for=section" + id + " class='text-info'> <b> Section "+ (id+1) +" </b> </label>",
        "</br>",
        "<input type=text maxlength=128 id=section required> ",
        "<br>",
        "<br>",
        "<label for=content" + id + "> Contenu </label><br>",
        "<textarea id=content" + id + " class='w-100' rows='10' ></textarea>",
    );

}

function article_valid(article){
    let fields = ['title', 'author', 'synopsis'];
    
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
    article.synopsis = $("#synopsis").val();
    article.cat0 = $("#cat0").val();
    article.cat1 =  $("#cat1").val();
    article.sections = [];

    let size = $(".section").length;
    for(let i = 0; i < size; i++){
        let section = {};
        section.title = $("#section" + i).val();
        section.content = $("#content" + i).val();
        article.sections.push(section);
    }
    if(articleExist(article)) return;

    if(!article_valid(article)) {
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
        async: true,
        dataType: 'json',
        success: function(data){
            if(data.status == "success"){ 
                console.log(data);
                // window.location.replace("index.html");
            }
            else{
                // TODO show error somewhere
                alert("LOADING ERROR");
            }
        }
    }); 

}