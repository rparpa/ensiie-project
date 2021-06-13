<html lang="fr">
<head>
    <?php 
    require("template/header.html");     
    require_once '../src/Bootstrap.php';
    use Model\Article;
    use Db\Connection;
    ?>
    <script src="/js/edit_article.js"></script>
</head>
<body>
    <?php 
    require("template/navbar.html"); 
    $pdo = Connection::get();
    $article = Article::getArticleObject($pdo, $_GET['id']);
    ?>
    <div id="article_content" style="margin: 5%;">
        <div id="article_title" class="col-12"><?php echo $article->getTitle(); ?></div>
        <div id="intro_container" class="container">
            <div class="row">
                <div id="article_cat" class="col-10">
                    <b>Catégories:</b> 
                    <span class="black_link">
                        <?php echo $article->getCat0(); echo " "; echo $article->getCat1();?>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h1 id="Synopsis">Synopsis</h1>
                    <textarea class="w-100 form-control"> <?php echo $article->getSynopsis(); ?> </textarea>
                </div>
            </div>
            <div class="row">
                <div id="synopsis_content" class="col-12"></div>
            </div>
        </div>
        <div class="container">
            <?php foreach($article->getSections() as $section){ 
                file_put_contents('php://stderr', print_r($section->getTitle()."\n", TRUE));
                
                ?>
                <div disabled id="<?php echo "section".$section->getId(); ?>" class="form-group">
                    <span class="content">
                        <div class="row section_article">
                            <input disabled class="sectionTitle form-control w-100" type="text" value="<?php echo $section->getTitle(); ?>">
                        </div>
                        <div class="row">
                            <textarea disabled class="sectionContent w-100 form-control"><?php echo $section->getContent(); ?> </textarea>
                        </div>
                    </span>
                    <div class="row buttons">
                        <button onclick=<?php echo "unlock(".$section->getId().")"; ?> type="button" class="col-2 btn btn-info edit">Editer</button>
                        <button onclick=<?php echo "unlock(".$section->getId().")"; ?> disabled type="button" class="col-2 btn btn-danger" disabled>Annuler</button>
                        <button onclick=<?php echo "updateSection(".$article->getId().",".$section->getId().")"; ?> disabled type="button" class="col-2 btn btn-success" disabled>Valider</button>
                    </div>
                </div>
            <?php } ?>
        </div>    
    </div>
    <script>
        $("textarea").each(function () {
            this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
        })
        .on("input", function () {
            this.style.height = "auto";
            this.style.height = (this.scrollHeight) + "px";
        });
    </script>
</body>
</html>