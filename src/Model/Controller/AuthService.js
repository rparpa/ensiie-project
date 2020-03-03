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

            try {
                if(await ParticulierRepository.login(obj)) {
                    response = 1;
                }
                else if(await EntrepriseRepository.login(obj)){
                    response = 2;
                }
                else if(await AdministrateurRepository.login(obj)) {
                    response = 3;
                }
                else response = -1;

                codestatus = 200;
            }
            catch(e) {
                if (e == 'Error in the database') {
                    codestatus = 500;
                    response = e;
                }
                else {
                    codestatus = 400;
                    response = e;
                }
            }
            
            res.writeHead(codestatus, {'Content-Type': 'application/json'});
            res.end(JSON.stringify(response));
        })
    }
}