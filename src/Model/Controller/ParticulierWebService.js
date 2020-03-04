const url = require('url');
const ParticulierRepository = require('../Repository/ParticulierRepository');

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
                if (e == 'Error in the database' || e == 'Error in transaction') {
                    codestatus = 500;
                }
                else codestatus = 400;
    
                response = e;
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
            if (e == 'Error in the database' || e == 'Error in transaction') {
                codestatus = 500;
            }
            else codestatus = 400;

            response = e;
        }
        
        res.writeHead(codestatus, {'Content-Type': 'application/json'});
        res.end(JSON.stringify(response));
    }

    static async getById(req, res, id) {
        let response;
        let codestatus;
        try {
            response = await ParticulierRepository.getById(id);
            codestatus = 200;
        }
        catch(e) {
            if (e == 'Error in the database' || e == 'Error in transaction') {
                codestatus = 500;
            }
            else codestatus = 400;

            response = e;
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

            let obj = JSON.parse(body);
            try {

                if(!obj.id) {
                    throw 'No id specified'
                }

                if(obj.nom) {
                    response = await ParticulierRepository.updateNom(obj.id, obj.nom);
                }
                else if(obj.prenom) {
                    response = await ParticulierRepository.updatePrenom(obj.id, obj.prenom);
                }
                else if(obj.adressemail) {
                    response = await ParticulierRepository.updateAdressemail(obj.id, obj.adressemail);
                }
                else if(obj.cv) {
                    response = await ParticulierRepository.updateCv(obj.id, obj.cv);
                }
                else if(obj.motdepasse) {
                    response = await ParticulierRepository.updateMotdepasse(obj.id, obj.motdepasse);
                }
                else if(obj.telephone) {
                    response = await ParticulierRepository.updateTelephone(obj.id, obj.telephone);
                }
                else {
                    throw 'Parameter no valid';
                }

                codestatus = 200;
            }
            catch(e) {
                if (e == 'Error in the database' || e == 'Error in transaction') {
                    codestatus = 500;
                }
                else codestatus = 400;
    
                response = e;
            }
            
            res.writeHead(codestatus, {'Content-Type': 'application/json'});
            res.end(JSON.stringify(response));
        })
    }

    static async deleteById(req, res, id) {
        let response;
        let codestatus;
        try {
            response = await ParticulierRepository.deleteById(id);
            codestatus = 200;
        }
        catch(e) {
            if (e == 'Error in the database' || e == 'Error in transaction') {
                codestatus = 500;
            }
            else codestatus = 400;

            response = e;
        }
        
        res.writeHead(codestatus, {'Content-Type': 'application/json'});
        res.end(JSON.stringify(response));
    }
}