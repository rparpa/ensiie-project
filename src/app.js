const express = require('express')
const app = express()
app.use(express.static('static'));
const Twig = require('twig');
var twig = Twig.twig;

const port = 3000
const { Client } = require('pg')
const path = require('path')
const dotenv = require('dotenv');
dotenv.config();

const dbPort = process.env.DB_PORT_EXTERNAL
const dbuser = process.env.DB_USER
const dbPassword = process.env.DB_PASSWORD

const client = new Client({
  user:dbuser,
  password:dbPassword,
  port:dbPort
});
client.connect();

app.get('/', (req, res) => {
  var sqlReq = "SELECT * FROM User;"
  client.query(sqlReq, (err, resp) => {
    const result = err ? err.stack : resp.rows[0];
    res.render("connect.twig", {});
  })
})

app.get('/newaccount', (req, res) => {
    res.render("new_account.twig", {});
})

app.get('/ingredient', (req, res) => {
  var sqlReq = "SELECT * FROM Ingredient;"
  var sqlReqUnites = "SELECT DISTINCT unite FROM Ingredient;"
  client.query(sqlReq, (err, resp) => {
    client.query(sqlReqUnites, (erru, respu) => {
      var result = err ? err.stack : resp.rows;
      var resultU = erru ? erru.stack : respu.rows;

      res.render('ingredient/ingredient_index.html.twig', {data:result, unites:resultU});
    });
  })
})

app.get('/recettes', (req, res) => {
  var sqlReq = "SELECT * FROM Ingredient;"
  client.query(sqlReq, (err, resp) => {
    var result = err ? err.stack : resp.rows;
    res.render('recipe.twig', {data:result});
  })
})

app.listen(port, () => {
  console.log(`App listening at http://localhost:${port}`);
})