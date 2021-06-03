const { client } = require('./../db');

module.exports.ingredientHandler = (req, res) => {
  if(!req.session.user || !req.session.password)
    res.redirect("/login")
  else {
    var userId = req.session.user;
    var sqlReq = "SELECT DISTINCT Ingredient.nom, Ingredient.unite, Stocker.quantite FROM Ingredient, Stocker WHERE Ingredient.id IN (SELECT id_ingredient FROM Stocker WHERE identifiant_utilisateur=$1) AND Stocker.quantite = (SELECT DISTINCT quantite from Stocker where id_ingredient = Ingredient.id);"
    var sqlReqUnites = "SELECT DISTINCT unite FROM Ingredient;"

    var sqlIngParam = [req.session.user];
    client.query(sqlReq, sqlIngParam, (err, resp) => {
      client.query(sqlReqUnites, (erru, respu) => {
        var result = err ? err.stack : resp.rows;
        var resultU = erru ? erru.stack : respu.rows;

        res.render('ingredient/ingredient_index.html.twig', {login:req.session.user, data:result, unites:resultU});
      });
    });
  }
}

module.exports.postIngredientHandler = (req, res) => {
  if(!req.session.user || !req.session.password)
    res.redirect("/login")

  else {
    var ingredient = req.body.name;
    var quantity = req.body.quantity;
    var unite = req.body.unite;

    var sqlReq = "INSERT INTO Stocker(identifiant_utilisateur, id_ingredient, quantite, date_stock) VALUES($1, (SELECT id FROM Ingredient WHERE nom=$2), $3, $4)";
    var values = [req.session.user, ingredient, quantity, Date.now()];

    client.query(sqlReq, values, (err, resp) => {
      const result = err ? err.stack : resp.rows[0];

      res.redirect('/ingredient');
    });
  }
}
