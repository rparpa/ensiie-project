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
        <div id="article_title" class="container"><?php echo $article->getTitle(); ?></div>
        <div id="intro_container" class="container">
            <div id="article_cat">
                <b>Catégories:</b> 
                <script> 
                    let x = getCatText(<?php echo json_encode(array('cat0' => $article->getCat0(), 'cat1' => $article->getCat1())) ?>); 
                    $("#article_cat").append(x);
                </script> 
            </div>
            <div disabled id="section0" class="form-group">
                <h3 id="Synopsis">Synopsis</h3>
                <span class="content">
                    <textarea disabled id="<?php echo "synopsis".$article->getId();?>" class="w-100 form-control" spellcheck="true"> <?php echo str_replace('\n', "\n", $article->getSynopsis()); ?></textarea>
                </span>
                <div class="row buttons">
                    <button onclick=unlock(0) type="button" class="col-1 btn btn-info edit">Editer</button>
                    <button onclick=unlock(0) disabled type="button" class="col-1 btn btn-danger" disabled>Annuler</button>
                    <button onclick=<?php echo "updateArticle(".$article->getId().")"; ?> disabled type="button" class="col-1 btn btn-success" disabled>Valider</button>
                </div>
            </div>
        </div>
        <div id="sections" class="container">
            <?php foreach($article->getSections() as $section){ ?>
                <div disabled id="<?php echo "section".$section->getId(); ?>" class="form-group">
                    <span class="content">
                        <div class="row section_article">
                            <input disabled class="sectionTitle form-control w-100" type="text" value="<?php echo $section->getTitle(); ?>">
                        </div>
                        <div class="row">
                            <textarea disabled class="sectionContent w-100 form-control" spellcheck="true"><?php echo str_replace('\n', "\n", $section->getContent()); ?></textarea>
                        </div>
                    </span>
                    <div class="row buttons">
                        <button onclick=<?php echo "unlock(".$section->getId().")"; ?> type="button" class="col-1 btn btn-info edit">Editer</button>
                        <button onclick=<?php echo "unlock(".$section->getId().")"; ?> disabled type="button" class="col-1 btn btn-danger" disabled>Annuler</button>
                        <button onclick=<?php echo "updateSection(".$article->getId().",".$section->getId().")"; ?> disabled type="button" class="col-1 btn btn-success" disabled>Valider</button>
                    </div>
                </div>
            <?php } ?>
        </div>    
        <div class="container form-group">   
            <button onclick=<?php echo "addSectionInput(".$article->getId().")"; ?> type="button" class="btn btn-info col-12 form-control"> Ajouter une section </button>
        </div>
     </div>
    <script>
        autosize();
    </script>
</body>
</html>