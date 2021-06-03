const { client } = require('./../db');

module.exports.recipeHandler = (req, res) => {
  if(!req.session.user || !req.session.password)
    res.redirect("/login")
  else {
    var sqlReq = "SELECT * FROM Ingredient;"
    client.query(sqlReq, (err, resp) => {
      var result = err ? err.stack : resp.rows;
      res.render('recipe/recipe_index.html.twig',{login:req.session.user, data:result});
    });
  }
}
