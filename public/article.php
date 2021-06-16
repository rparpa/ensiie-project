<html lang="fr">
<head>
  <?php require("template/header.html"); ?>
  <script src="/js/article.js"></script>
</head>
<body>
  <?php require("template/navbar.html"); ?>
  <br><br>


  <form action="" id="newarticle" class="mx-auto" method="post" style="width:75%; margin-top:5%">
    <div class="card bg-light" >
      <div class="card-header bg-info text-white text-center">
          <h3>Ecrire un article</h3>
      </div>
      <div id='firstForm' class="card-body">
        <div class="form-group">
          <label for=title>  Titre de l'article </label>
          <input id="title" type="text" maxlength="50" name="title" class="form-control" required>    
        </div>
        <div class="form-group">
          <label for=synopsis>  Synopsis </label><br>
          <textarea id="synopsis" maxlength="500" rows=5 class="form-control" name="synopsis" style="color: black;" required></textarea> 
        </div>
        <div class="form-group">
          <label for=categories>  Catégories </label>
          <div class="row">
            <div class="col-3">
              <select name="categories" class="form-control" id=cat0></select>
            </div>  
            <div class="col-3">
              <select name="categories" class="form-control" id=cat1></select>
            </div>  
          </div>
        </div>
      </div>
    </div>
    <br>
    <div id="sections">
      <div id="sect0" class="section card">
        <div class="card-header text-info"> Section 1 </div>
        <div class="card-body">
          <label for=section0> <b> Titre de la section </b> </label>
          <input type="text" maxlength="100" id="section0" class="form-control" required>
          <br>
          <label for="content0"> <b> Contenu de la section </b> </label><br>
          <textarea id="content0" class="form-control" rows=7 required></textarea>
        </div>
      </div>
    </div>   
    <br>   
    <div class="form-group row">
        <button class="btn btn-primary text-white col" onclick="addSection()" style="padding: 0%; ">Ajouter une section</button>
        <span></span>
        <button class="btn btn-success text-white col" onclick="postArticle()" style="padding: 0%; margin-left:1%">Publier l'article</button>
        <span class="col"></span>
      </div>
  </form>
  <script> setCategories(); </script>
</body>
</html>
