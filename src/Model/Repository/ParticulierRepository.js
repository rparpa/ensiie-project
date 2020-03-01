const ClientSession = require('../Factory/ClientSession');
const insert = "INSERT INTO particulier(adressemail, motdepasse, cv, nom, prenom) VALUES($1, $2, $3, $4, $5) RETURNING adressemail, cv, nom, prenom";
const selectAll = "SELECT * from particulier";
const updateOne = "UPDATE particulier SET adressemail = $1, motdepasse = $2, cv = $3, nom = $4, prenom = $5 WHERE id = $6 RETURNING adressemail, motdepasse, cv, nom, prenom";

module.exports = class {
    static async create(Particulier) {
        if (!Particulier) {
            throw 'Particulier object is undefined';
        }

        if (!Particulier.nom || !Particulier.prenom || !Particulier.motdepasse || !Particulier.cv || !Particulier.adressemail) {
            throw 'Particulier object is missing information';
        }

        let values = [Particulier.adressemail, Particulier.motdepasse, Particulier.cv, Particulier.nom, Particulier.prenom];
        
        var result = await ClientSession.getSession().query(insert, values)
                      .catch(e => {throw 'Error in the database'});

        return result.rows[0];
    }

    static async getAll() {

        var result = await ClientSession.getSession().query(selectAll)
        .catch(e => {throw  'Error in the database'});

        return result.rows;
    }
    
    static async updateOne({id, nom, prenom, motdepasse,cv,adressemail}) {
        if(!id){
            throw 'no id specified';
        }
        if(!nom){
            throw 'no name specified';
        }
        if(!prenom){
            throw 'no firstname specified';
        }
        if(!motdepasse){
            throw 'no password specified';
        }
        if (!cv){
            throw 'no cv specified';
        }
        if(!adressemail){
            throw 'no email specified';
        }

        var values = [adressemail, motdepasse, cv, nom, prenom, id];
        
        var result = await ClientSession.getSession().query(updateOne, values)
        .catch(e => {throw 'Error in the database'});

        return result.rows[0];
    }
};