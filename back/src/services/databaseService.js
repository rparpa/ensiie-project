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

  create(table, valuesObject) {
    this.connectToDatabase();
    return new Promise(resolve => {

      let keysString = '(';
      let valuesString = '(';
      for(const key in valuesObject) {
        keysString += key+", "
        valuesString += '\''+valuesObject[key]+'\', '
      }
      keysString = keysString.substring(0, keysString.length-2)
      keysString += ')'
      valuesString = valuesString.substring(0, valuesString.length-2)
      valuesString += ')'


      this.client
      .query('INSERT INTO "'+table+'"' +keysString+ ' VALUES '+valuesString)
      .then(result => resolve(true))
      .catch(e => resolve(false))
      .then(() => this.client.end())
    })
  }

  read(table, select, where = '') {
    return new Promise(resolve => {
      this.connectToDatabase()
      
      const whereClause = where === '' ? '' : 'WHERE '+where;
      
      this.client
      .query('SELECT '+select+ ' FROM "' +table+ '" ' +whereClause)
      .then(result => resolve(result))
      .catch(e => console.error(e.stack))
      .then(() => this.client.end())
    })
  }

  update() {

  }

  delete() {

  }
}

module.exports = databaseService