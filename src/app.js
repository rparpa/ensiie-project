const express = require('express');
const session = require('express-session');
const app = express();
const Twig = require('twig');
const { Client } = require('pg');
const path = require('path');
const dotenv = require('dotenv');
const passwordHash = require('password-hash');

const port = 3000;
var twig = Twig.twig;

dotenv.config();

const dbPort = process.env.DB_PORT_EXTERNAL;
const dbuser = process.env.DB_USER;
const dbPassword = process.env.DB_PASSWORD;

const client = new Client({
  user:dbuser,
  password:dbPassword,
  port:dbPort
});
client.connect();

app.use(express.static('static'));
app.use(express.urlencoded({ extended: true }));
app.use(session({
  secret: 'sessioninit',
  resave: false,
  saveUninitialized: true,
}));

app.get('/', (req, res) => {
  if(!req.session.user || !req.session.password)
    res.redirect("/login")
  else {
    res.render("home/home_index.html.twig", {});
  }
});

app.get('/login', (req, res) => {
  var sqlReq = "SELECT * FROM User;"
  client.query(sqlReq, (err, resp) => {
    const result = err ? err.stack : resp.rows[0];
    res.render("connection/connection_login.html.twig", {});
  });
});

app.post('/login', (req, res) => {
  let errorMsg = "";
  let id = req.body.id;
  let password = req.body.password;

  if(id !== "" && password !== "") {
    let sqlReq = "SELECT * FROM Utilisateur WHERE identifiant=$1;";
    let values = [id];

    client.query(sqlReq, values, (err, resp) => {
      const result = err ? err.stack : resp.rows;

      if(result === undefined || result[0] == undefined || !passwordHash.verify(password, result[0].mdp))
        res.render("connection/connection_login.html.twig", {error:"Identifiant ou mot de passe incorrect"});
      else{
        req.session.user = result[0].identifiant;
        req.session.password = result[0].mdp;
        res.redirect("/");
      }
    });
  } else
    res.render("connection/connection_login.html.twig", {error:"L'identifiant et le mot de passe doivent être définis"});

});

app.get('/register', (req, res) => {
    res.render("connection/connection_register.twig", {});
});

app.post('/register', (req, res) => {
  let errorMsg = "";
  let id = req.body.id;
  let password = req.body.password;

  if(id !== "" && password !== "") {
    let existsSqlReq = "SELECT * FROM Utilisateur WHERE identifiant=$1;";
    let existsValues = [id];

    client.query(existsSqlReq, existsValues, (err, resp) => {
      const existsResult = err ? err.stack : resp.rows[0];

      if(existsResult === undefined) {
        let sqlReq = "INSERT INTO Utilisateur(identifiant, mdp, statut) values($1, $2, $3);";
        let values = [id, passwordHash.generate(password), 0];

        client.query(sqlReq, values, (err, resp) => {
          const result = err ? err.stack : resp.rows[0];

          if(result === undefined)
            res.redirect("/login");
          else
            res.render("connection/connection_register.twig", {error:"Impossible de créer le compte"});
        });
      } else
        res.render("connection/connection_register.twig", {error:"L'utilisateur " + id + " existe déjà"});
    });
  } else
    res.render("connection/connection_register.twig", {error:"L'identifiant et le mot de passe doivent être définis"});
});

app.get('/ingredient', (req, res) => {
  if(!req.session.user || !req.session.password)
    res.redirect("/login")
  else {
    var userId = req.session.user;
    var sqlReq = "SELECT Ingredient.nom, Stocker.quantite FROM Ingredient, Stocker, Utilisateur WHERE Stocker.identifiant_utilisateur = Utilisateur.identifiant;"
    var sqlReqUnites = "SELECT DISTINCT unite FROM Ingredient;"
    client.query(sqlReq, (err, resp) => {
      client.query(sqlReqUnites, (erru, respu) => {
        var result = err ? err.stack : resp.rows;
        var resultU = erru ? erru.stack : respu.rows;

        res.render('ingredient/ingredient_index.html.twig', {data:result, unites:resultU});
      });
    });
  }
});

app.post('/ingredient', (req, res) => {
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
});

app.get('/recettes', (req, res) => {
  if(!req.session.user || !req.session.password)
    res.redirect("/login")
  else {
    var sqlReq = "SELECT * FROM Ingredient;"
    client.query(sqlReq, (err, resp) => {
      var result = err ? err.stack : resp.rows;
      res.render('recipe/recipe_index.html.twig',{data:result});
    });
  }
});

app.get("/logout",(req,res) =>{
  if(!req.session.user || !req.session.password)
    res.redirect("/login")

  req.session.destroy(function(err) {});
  res.redirect("/")

})

// Handle 404 - Keep this as a last route
app.use(function(req, res, next) {
  res.status(404);
  res.render('erreur/erreur_404.html.twig');
});

app.listen(port, () => {
  console.log(`App listening at http://localhost:${port}`);
});