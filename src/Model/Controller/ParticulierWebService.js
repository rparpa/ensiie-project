const url = require('url');
const ParticulierRepository = require('../Repository/ParticulierRepository');

const { parse } = require('querystring');

module.exports = class ParticulierWebService {
    static create(req, res) {
        var body = '';

        req.on('data', chunk => {
            body += chunk.toString();
        });

        req.on('end', () => {
            let response = ParticulierRepository.create(JSON.parse(body));

            res.writeHead(201, {'Content-Type': 'application/json'});
            res.end(JSON.stringify(response));
        })
    }
}