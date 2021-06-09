<!doctype html>

<html lang="fr">
<?php include("template/header.html"); ?>
<body>
    <?php include("template/navbar.html"); ?>
    <div id="content"> 
            <script> <?php
            if(isset($_GET['id']))
                echo "get_article(".$_GET['id'].")";
            else
                echo "get_all_article();"; ?>
            </script>
    </div>
</body>
</html>
