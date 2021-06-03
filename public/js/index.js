jQuery(document).ready(function($) {
    init();

    $("body").click(function (e){
        let nav = $("#navbar");
        if ((e.target.className == 'navbar-toggler-icon' || e.target.className == 'navbar-toggler collapsed') && !nav.is(':visible'))
            nav.show();
        else
            nav.hide();
    })
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
    window.location.replace('index.php');
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
                window.location.replace('index.php');
            }
        }
    });
}

function get_all_article(){
    $.ajax({
        url: 'router.php',
        type: 'POST',
        data: {
            request: "Controller/get_article.php",
            to_do: "get_all",
        },
        dataType: 'json',
        success: function(data){
            if(data.status == "error"){
                console.log(data.msg);
            }
            else{
                load_all_article(data);
            }
        }
    });
}

function load_all_article(data){
    let content = $("#content")

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

        let valide = "";
        if(e.validated)
            valide = `<span><i class="fas fa-check-square"></i></span>`;

        
        let html = `
        <div class="card text-center mx-auto bg-light mb-3" style="width: 1000px; margin-top:50px;">
            <button class="title_index" onclick="get_article(`+ e.id_page + `)">
                <div class="card-header bg-info text-white display_list_article"><h4>` + e.title + valide + `</h4></div>
            </button>
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
        
        content.append(html);
    });
}

function get_article(id){
    $.ajax({
        url: 'router.php',
        type: 'POST',
        data: {
            request: "Controller/get_article.php",
            to_do: "get_article",
            id_article: id,
        },
        dataType: 'json',
        success: function(data){
            if(data.status == "error"){
                console.log(data.msg)
            }
            else{
                load_article(data);
            }
        }
    });
}

function load_article(data) {
    console.log(data);
    
    let content = $("#content");
    content.html(`<p>` +data.page.title + `</p>`);

    //ajouter la partie titre et categories ...

    titre = `
    <div class="page affichePage"><div id="titre"><h1>Hadès</h1>
    <p>Hades est un jeu vidéo roguelike action-RPG développé et publié par Supergiant Games, sorti le 17 septembre 2020 sur Microsoft Windows et Nintendo Switch.</p>
    `
    autre = 
    `
    </div><div class="section">
    <h2>Système de jeu</h2>
    <p>Le joueur incarne Zagreus, le prince des enfers, qui tente de fuir le royaume des morts pour découvrir ses origines et réunifier sa famille. Lors de sa quête, les autres divinités olympiennes lui accordent des cadeaux pour l'aider à combattre toutes les entités des Enfers pensant que Zagreus souhaite les rejoindre.
    
    Le jeu est présenté en 3D isométrique et dispose d'éléments du genre roguelike : Le joueur doit se frayer un chemin dans des salles dont l'ordre d'apparition et les ennemis s'y trouvant sont déterminés procéduralement. Il dispose d'une arme principale, d'une attaque spéciale et il peut lancer un sortilège de tir à distance qu’il peut utiliser pour éliminer ses ennemis. L'arme principale peut être remplacée par d'autres (il y en a 6) avec des "clés chtoniennes". L'attaque spéciale (appelée technique) change en fonction de l'arme. Lorsque le joueur perd l'ensemble de ses points de vie, il "meurt" et retourne face à son père, retirant tous les éléments obtenus lors de cette partie, mais conserve une monnaie d'échange pour déverrouiller des améliorations permanentes ou de nouvelles armes.</p>
    </div>
    <div class="section">
    <h2>Développement</h2>
    <p>Hades sort d'abord en accès anticipé sur la boutique Epic Games le 6 décembre 2018 et sur Steam le 10 décembre 2019.
    
    La version 1.0 sort sur ces deux plateformes ainsi que sur Nintendo Switch le 17 septembre 2020.</p>
    </div>
    <div class="section">
    <h2>Accueil critique</h2>
    <p>Hades reçoit un excellent accueil critique, avec une note moyenne de 93/100 sur l'agrégateur Metacritic.</p>
    </div>
    <p>Ecrit par <i>Zagreus</i></p></div>`

    data.sections.forEach(s => {
        // ajouter les sections
    });

    // ajouter les auteurs


    
    content.html(titre);
}

