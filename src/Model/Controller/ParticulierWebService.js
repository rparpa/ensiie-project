const url = require('url');
const ParticulierRepository = require('../Repository/ParticulierRepository');

const { parse } = require('querystring');

module.exports = class ParticulierWebService {
    static async create(req, res) {
        var body = '';

        req.on('data', chunk => {
            body += chunk.toString();
        });

        req.on('end', async () => {
            let response;
            let codestatus;
            try {
                response = await ParticulierRepository.create(JSON.parse(body));
                codestatus = 201;
            }
            catch(e) {
                if (e == 'Particulier object is missing information') {
                    codestatus = 400;
                    response = 'Particulier object is missing information';
                }
                else if(e == 'Particulier object is undefined') {
                    codestatus = 400;
                    response = 'Particulier object is undefined';
                }
            }
            
            res.writeHead(codestatus, {'Content-Type': 'application/json'});
            res.end(JSON.stringify(response));
        })
    }

    static async getAll(req, res) {
        let response;
        let codestatus;
        try {
            response = await ParticulierRepository.getAll();
            codestatus = 200;
        }
        catch(e) {
            if (e == 'Error in the database') {
                codestatus = 500;
                response = 'Error in the database';
            }
        }
        
        res.writeHead(codestatus, {'Content-Type': 'application/json'});
        res.end(JSON.stringify(response));
    }

    static async updateOne(req, res) {
        var body = '';

        req.on('data', chunk => {
            body += chunk.toString();
        });

        req.on('end', async () => {
            let response;
            let codestatus;
            try {
                response = await ParticulierRepository.updateOne(JSON.parse(body));
                codestatus = 200;
            }
            catch(e) {
                
            }
            
            res.writeHead(codestatus, {'Content-Type': 'application/json'});
            res.end(JSON.stringify(response));
        })
    }

    static async deleteById(req, res, id) {
        let response;
        let codestatus;
        try {
            response = await ParticulierRepository.delete(id);
            codestatus = 200;
        }
        catch(e) {
            if(e == 'No id specified') {
                response = 'No id specified';
                codestatut = 400;
            }
            else if(e == 'Error in the database') {
                response = 'Error in the database';
                codestatut = 500;
            }
        }
        
        res.writeHead(codestatus, {'Content-Type': 'application/json'});
        res.end(JSON.stringify(response));
    }
}