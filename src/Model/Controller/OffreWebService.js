const OffreRepository = require('../Repository/OffreRepository');

module.exports = class OffreWebService {
    static async create(req, res) {
        var body = '';
        req.on('data', chunk => {
            body += chunk.toString();
        });

        req.on('end', async () => {
            let response;
            let codestatus;
            try {
                response = await OffreRepository.create(JSON.parse(body));
                codestatus = 201;
            }
            catch(e) {
                if (e == 'Offre object is missing information') {
                    codestatus = 400;
                    response = 'Offre object is missing information';
                }
                else if(e == 'Offre object is undefined') {
                    codestatus = 400;
                    response = 'Offre object is undefined';
                }
            }
            
            res.writeHead(codestatus, {'Content-Type': 'application/json'});
            res.end(JSON.stringify(response));
        })
    }

    static async getAllByIdentreprise(req, res, identreprise) {
        let response;
        let codestatus;
        try {
            response = await OffreRepository.getAllByIdentreprise(identreprise);
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

    static async getAllByArgs(req, res, titre, adresse, typecontrat, salaire, dateparution) {
        let response;
        let codestatus;
        try {
            response = await OffreRepository.getAllByArgs(titre, adresse, typecontrat, salaire, dateparution);
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

            let obj = JSON.parse(body);
            
            try {
                
                if(!obj.id) {
                    throw 'No id specified'
                }

                if(obj.description) {
                    response = await OffreRepository.updateDescription(obj.id, obj.description);
                }
                else if(obj.document) {
                    response = await OffreRepository.updateDocument(obj.id, obj.document);
                }
                else if(obj.typecontrat) {
                    response = await OffreRepository.updateTypecontrat(obj.id, obj.typecontrat);
                }
                else if(obj.adresse) {
                    response = await OffreRepository.updateAdresse(obj.id, obj.adresse);
                }
                else if(obj.salaire) {
                    response = await OffreRepository.updateSalaire(obj.id, obj.salaire);
                }
                else if(obj.titre) {
                    response = await OffreRepository.updateTitre(obj.id, obj.titre);
                }
                else if(obj.dateparution) {
                    response = await OffreRepository.updateDateparution(obj.id, obj.dateparution);
                }
                else {
                    throw 'Parameter no valid';
                }
                codestatus = 200;
            }
            catch(e) {
                codestatus = 500;
                response =  e;
            }
            
            res.writeHead(codestatus, {'Content-Type': 'application/json'});
            res.end(JSON.stringify(response));
        })
    }

    static async deleteById(req, res, id) {
        let response;
        let codestatus;
        try {
            response = await OffreRepository.deleteById(id);
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