const CandidatRepository = require('../Repository/CandidatRepository');

module.exports = class CandidatWebService {
    static async create(req, res) {
        var body = '';
        req.on('data', chunk => {
            body += chunk.toString();
        });

        req.on('end', async () => {
            let response;
            let codestatus;
            try {
                response = await CandidatRepository.create(JSON.parse(body));
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

    static async getAllCandidatByOffre(req, res, idoffre) {
        let response;
        let codestatus;
        try {
            response = await CandidatRepository.getAllCandidatByOffre(idoffre);
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

    static async getAllOffreByCandidat(req, res, idparticulier) {
        let response;
        let codestatus;
        try {
            response = await CandidatRepository.getAllOffreByCandidat(idparticulier);
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