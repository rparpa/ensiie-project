<html lang="fr">
<head>
  <?php require("header.html"); ?>
  <script src="/js/article.js"></script>
</head>
<body>
    <?php require("navbar.html"); ?>
    <br><br>

    <div style="margin: 5%;">
      <h1> Ecrire un article </h1>

      <form action="" id="newarticle" method="post">
        <div id='firstForm'>
          <label for=title> Titre </label>
          <input id="title" type="text" maxlength="50" name="title" required>    
          <br>

          <label for=author> Auteur </label>
          <input id="author" type="text" maxlength="20" name="author" required>   
          <br>

          <label for=synopsis> Synopsis </label>
          <textarea id="synopsis" maxlength="256" row="3" name="synopsis" required></textarea> 
          <br>

          <label for=categories> Catégories </label>
          <select name="categories" id=cat0></select>
          <select name="categories" id=cat1></select>
        </div>
        <br>
        <div id="sections">
          <div id="sect0" class="section">
            <label for=section0> Section  </label> <br>
            <input type="text" maxlength="128" id="section0" required>    
            <br>
            <label for="content0"> Contenu </label><br>
            <textarea id="content0" rows="10" required></textarea>  
          </div>
        </div>
      </form>
      <button onclick="addSection()"> Ajouter une section </button>
      <button onclick="postArticle()"> Publier l'article </button>

    </div>
    <script>
      loadCategories();
    </script>
</body>
</html>
