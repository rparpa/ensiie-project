const express = require('express')
const app = express()
const port = 3000
const bodyParser = require('body-parser')

// IMPORT DB CONNECTION
const connection = require('./config/database');


// SET VIEW ENGINE
app.set('view engine','html');
app.engine('html', express);
app.set('views','views');

// USE BODY-PARSER MIDDLEWARE
app.use(bodyParser.urlencoded({extended:false}));

app.listen(port, () => {
  console.log(`Example app listening at http://localhost:${port}`)
})

app.get('/', (req, res) => {
  // FETCH ALL THE POSTS FROM DATABASE
  //connection.query('SELECT * FROM posts', (err, results) => {
    //if (err) throw err;
    // RENDERING INDEX.HTML FILE WITH ALL POSTS
    res.render('vue/index',{
      //posts:results
    });
  //});

});

