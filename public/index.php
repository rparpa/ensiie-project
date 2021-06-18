<!doctype html>

<html lang="fr">
<?php include("template/header.html"); ?>
<body>
    <?php include("template/navbar.html"); ?>
    <div id="nav_article" class="sidepanel scrollbar scrollbar-lips">
        <label class="text-white ml-4 onlyUser"> Proposer une catégorie : </label>
        <div class="d-flex onlyUser">
            <input id="newCat" class="w-75 ml-4 onlyUser" type=text>
            <a href="javascript:proposeCat();" style="padding: 0px 0px 0px 3%;"><i class="onlyUser fas fa-paper-plane" ></i></a>
        </div>
        <br>
    </div>
    <div class="search" id="div_search" >
        <div class="mask d-flex align-items-center h-100">
            <div class="container">
                <div class="autocomplete form-outline input-group input-group-lg div_search">
                    <input type="text" class="form-control form-control-lg rounde bg-transparent text-white" id="SearchArticle" name="SearchArticle" maxlength="30" placeholder="Chercher un Article"/>
                    <span class="input-group-text border-0" onclick="loadArticleByTitle()">
                        <i class="fas fa-search fa-lg text-white"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        <script> <?php
        if(isset($_GET['id']))
            echo "load_article(".$_GET['id'].")";
        else
            echo "getAllArticle('full');"; ?>
        </script>
    </div>
<script src="js/search.js"></script>
</body>
</html>
