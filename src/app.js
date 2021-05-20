const express = require('express')
const app = express()
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

  const sqlReq = "SELECT * FROM User;"
  client.query(sqlReq, (err, resp) => {
    var result = err ? err.stack : resp.rows[0];

    res.sendFile(path.join(__dirname + "/View", '/connect.html'));
    client.end();

  })

})

app.listen(port, () => {
  console.log(`App listening at http://localhost:${port}`);
})
