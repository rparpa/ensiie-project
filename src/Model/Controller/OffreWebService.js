const url = require('url');

module.exports = class OffreWebService {
    static create(req, res) {
        let response = {test:"test"};



        res.writeHead(201, {'Content-Type': 'application/json'});
        res.end(JSON.stringify(response));
    }
}