const express = require('express')
const app = express()
const twig = require('twig');
const port = 3000
const bodyParser = require('body-parser')
const { Client } = require('pg')
const path = require('path')
const dotenv = require('dotenv');
dotenv.config();

// SET VIEW ENGINE
app.set('view engine','html');
app.engine('html', twig.__express);
app.set('views','views');

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

  const sqlReq = "SELECT * FROM User;"
  client.query(sqlReq, (err, resp) => {
    var result = err ? err.stack : resp.rows[0];

    res.sendFile(path.join(__dirname + "/View", '/connect.html'));
    client.end();

  })

})

// USE BODY-PARSER MIDDLEWARE
app.use(bodyParser.urlencoded({extended:false}));

app.listen(port, () => {
  console.log(`App listening at http://localhost:${port}`);
})

