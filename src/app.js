const express = require('express');
const session = require('express-session');
const app = express();
const Twig = require('twig');
const path = require('path');

const port = 3000;
var twig = Twig.twig;

const { client } = require('./db');
client.connect();

app.use(express.static('static'));
app.use(express.urlencoded({ extended: true }));
app.use(session({
  secret: 'sessioninit',
  resave: false,
  saveUninitialized: true,
}));

const {homeRequestHandler} = require('./routes/home');
app.get('/', homeRequestHandler);

const {loginHandler,postLoginHandler,logoutHandler} = require('./routes/login');
app.get('/login', loginHandler);
app.post('/login', postLoginHandler);
app.get('/logout', logoutHandler);

const {registerHandler,postRegisterHandler} = require('./routes/register');
app.get('/register', registerHandler);
app.post('/register', postRegisterHandler);

const {ingredientHandler,postIngredientHandler} = require('./routes/ingredient');
app.get('/ingredient', ingredientHandler);
app.post('/ingredient', postIngredientHandler);

const {recipeHandler} =  require('./routes/recipe');
app.get('/recettes', recipeHandler);

// Handle 404 - Keep this as a last route
app.use(function(req, res, next) {
  res.status(404);
  res.render('erreur/erreur_404.html.twig');
});

app.listen(port, () => {
  console.log(`App listening at http://localhost:${port}`);
});
