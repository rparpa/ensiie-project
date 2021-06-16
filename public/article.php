<html lang="fr">
<head>
  <?php require("template/header.html"); ?>
  <script src="/js/article.js"></script>
</head>
<body>
    <?php require("template/navbar.html"); ?>
    <br><br>

    <div class="card mx-auto bg-light" style="width: 900px; margin-top:50px ">
    <div class="card-header bg-info text-white text-center">
        <h3>Ecrire un article</h3>
    </div>
    <div class="card-body " ></div>
    <h3 class="sucessField alertField SuccessInscription" id="SuccessInscription">Bravo, votre inscription a bien été prise en compte !</h3>
    <h6 class="sucessField alertField SuccessInscription">(redirection dans 5s...)</h6>

    <br>
      <form action="" id="newarticle" method="post">
        <div id='firstForm'>
          <label for=title>  Titre </label>
          <input id="title" type="text" maxlength="50" name="title" required>    
          <br>

          <label for=author>  Auteur </label>
          <input id="author" type="text" maxlength="20" name="author" required>   
          <br>
          <br>

          <label for=synopsis>  Synopsis </label><br>
          <textarea id="synopsis" maxlength="128" class="w-50" name="synopsis" required></textarea> 
          <br>
          <br>

          <label for=categories>  Catégories </label>
          <select name="categories" id=cat0></select>
          <select name="categories" id=cat1></select>
        </div>
        <br>
        <div id="sections">
          <div id="sect0" class="section">
            <label for=section0 class="text-info"> <b> Section 1</b>  </label> <br>
            <input type="text" maxlength="128" id="section0" required>
            <br>
            <br>
            <label for="content0"> Contenu </label><br>
            <textarea id="content0" class="w-100" rows="10" required></textarea>
            <br> 
            <br> 
          </div>
        </div>
        <br>
        <div class="form-group">
           <button class="btn btn-info text-white" onclick="addSection()">Ajouter une section</button>
        </div>
        <div class="form-group">
            <button class="btn btn-info text-white" onclick="postArticle()">Publier l'article</button>
        </div>
      </form>

    </div>
    <script>
        setCategories();
    </script>
  </div>
</body>
</html>
