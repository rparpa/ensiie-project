const dotenv = require('dotenv');
dotenv.config();
const { Client } = require('pg');

module.exports.client = new Client({
  user:process.env.DB_USER,
  password:process.env.DB_PASSWORD,
  port:process.env.DB_PORT_EXTERNAL
});
