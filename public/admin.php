<!doctype html>
<html lang="fr">
<script>
if (!(localStorage.getItem('isadmin') == 'true'))
    window.location.replace('index.php');
</script>
<script src="/js/admin.js"></script>
<?php include("template/header.html"); ?>
<body>
    <?php include("template/navbar.html"); ?>
    <div id="nav_admin" class="sidepanel"></div>
    <div id="content_admin">
    <script> <?php
        if(isset($_GET['id']))
            echo "loadAdminArticle(".$_GET['id'].")";
        else
            if(isset($_GET['va']))
                echo "loadArticleToValidate();"; 
            else if(isset($_GET['ca']))
                echo "loadCategoriesToValidate();"; 
            else
                echo "loadDemandeModo();"; 
        ?>
        </script>
    </div>
</body>
</html>
