const { Client } = require('pg');

class databaseService {
  constructor() {
    this.client = new Client({
      user: "ensiie",
      host: "postgres",
      database: "ensiie",
      password: "ensiie",
      port: 5432
    });
    
    this.connectToDatabase = () => {
      this.client.connect(err => {
        if (err) {
          console.error('Connection error', err.stack)
        } else {
          console.log('Connected to database')
        }
      })
    }
  }

  create() {

  }

  read(table, select, where = '') {
    this.connectToDatabase()

    const whereClause = where === '' ? '' : 'WHERE '+where;

    this.client.query('SELECT '+select+ ' FROM "' +table+ '" ' +whereClause, (err, res) => { 
      if (err) throw err
      console.log(res)
      this.client.end()
      return res;
    })
  }

  update() {

  }

  delete() {

  }
}

module.exports = databaseService