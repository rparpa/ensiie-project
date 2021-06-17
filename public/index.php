<!doctype html>

<html lang="fr">
<?php include("template/header.html"); ?>
<body>
    <?php include("template/navbar.html"); ?>
    <div id="nav_article" class="sidepanel">
        <label class="text-white ml-4 onlyUser"> Proposer une catégorie : </label>
        <div class="d-flex onlyUser">
            <input id="newCat" class="w-75 ml-4 onlyUser" style="padding: 2% 0% 2% 0%;" type=text>
            <a href="javascript:proposeCat();" style="padding: 0px 0px 0px 3%;"><i class="onlyUser fas fa-paper-plane" ></i></a>
        </div>
        <br>
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
