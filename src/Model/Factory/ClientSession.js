module.exports = class ClientSession {
    static session = null;
    
    static getSession() {
        if(ClientSession.session == null) {
            var {Client} = require('pg');
            ClientSession.session = new Client("postgres://ensiie:ensiie@postgres:5432/ensiie");
            ClientSession.session.connect(err => {
                if (err) {
                    ClientSession.session = null;
                    throw 'Could not connect to postgres database ' + err;
                }
              }
            );
        }

        return ClientSession.session;
    }
}

// var conString = "postgres://ensiie:ensiie@postgres:5432/ensiie";

// var client = new pg.Client(conString);
// client.connect(function(err) {
//   if(err) {
//     return console.error('could not connect to postgres', err);
//   }
//   client.query('SELECT * from offre', function(err, result) {
//     if(err) {
//       return console.error('error running query', err);
//     }
//     console.log(result.rows);
//     console.log("ça marche")
//     client.end();
//   });
// });

// ClientSession.getSession().query('SELECT * from offre', function(err, result) {
//     if(err) {
//       return console.error('error running query', err);
//     }
//     console.log(result.rows);
//     console.log("ça marche")
//   });
