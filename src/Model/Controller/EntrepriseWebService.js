const url = require('url');
const EntrepriseRepository = require('../Repository/EntrepriseRepository');

module.exports = class EntrepriseWebService {
    static async create(req, res) {
        var body = '';
        req.on('data', chunk => {
            body += chunk.toString();
        });

        req.on('end', async () => {
            let response;
            let codestatus;
            try {
                response = await EntrepriseRepository.create(JSON.parse(body));
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

    static async getAllValidated(req, res) {
        let response;
        let codestatus;
        try {
            response = await EntrepriseRepository.getAllValidated();
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

    static async getAllNoValidated(req, res) {
        let response;
        let codestatus;
        try {
            response = await EntrepriseRepository.getAllNoValidated();
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
            response = await EntrepriseRepository.getById(id);
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
                    response = await EntrepriseRepository.updateNom(obj.id, obj.nom);
                }
                else if(obj.adressemail) {
                    response = await EntrepriseRepository.updateAdressemail(obj.id, obj.adressemail);
                }
                else if(obj.adressesiege) {
                    response = await EntrepriseRepository.updateAdressesiege(obj.id, obj.adressesiege);
                }
                else if(obj.motdepasse) {
                    response = await EntrepriseRepository.updateMotdepasse(obj.id, obj.motdepasse);
                }
                else if(obj.logo) {
                    response = await EntrepriseRepository.updateLogo(obj.id, obj.logo);
                }
                else if(obj.telephone) {
                    response = await EntrepriseRepository.updateTelephone(obj.id, obj.telephone);
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
            response = await EntrepriseRepository.deleteById(id);
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