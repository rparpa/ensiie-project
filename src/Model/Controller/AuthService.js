const ParticulierRepository = require('../Repository/ParticulierRepository');
const EntrepriseRepository = require('../Repository/EntrepriseRepository');
const AdministrateurRepository = require('../Repository/AdministrateurRepository');

module.exports = class AuthService {
    static async login(req, res) {
        var body = '';

        req.on('data', chunk => {
            body += chunk.toString();
        });

        req.on('end', async () => {
            let response;
            let codestatus;
            let obj = JSON.parse(body);

            let result;
            try {
                result = await ParticulierRepository.login(obj);
                if(result.length > 0) {
                    response = {id: result[0].id, type: 1};
                }
                else {
                    result = await EntrepriseRepository.login(obj)
                    if(result.length > 0){
                        response = {id: result[0].id, type: 2};
                    }
                    else {
                        result = await AdministrateurRepository.login(obj);
                        if(result.length > 0) {
                            response = {id: result[0].id, type: 3};
                        }
                        else response = {type:-1};
                    }
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
}