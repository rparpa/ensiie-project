const ClientSession = require('../Factory/ClientSession');
const insert = "INSERT INTO particulier(adressemail, motdepasse, cv, nom, prenom) VALUES($1, $2, $3, $4, $5) RETURNING *";

module.exports = class {
    static create(Particulier) {
        if (!Particulier) {
            throw 'Particulier object is undefined';
        }

        if (!Particulier.nom || !Particulier.prenom || !Particulier.motdepasse || !Particulier.cv || !Particulier.adressemail) {
            throw 'Particulier object is missing information';
        }

        let values = [Particulier.adressemail, Particulier.motdepasse, Particulier.cv, Particulier.nom, Particulier.prenom];
        
        let result;

        ClientSession.getSession().query(insert, values, (err, res) => {
            if(err) {
                throw 'Error in the database'
            }
            else {
                result =  res.rows[0];
            }
        });

        return result;
    }
    
    updateOne({id, nom, prenom, motdepasse,cv,adresseMail}) {
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
        if(!adresseMail){
            throw 'no email specified';
        }
        // this.db
        //   .get('Particuliers')
        //   .find({id})
        //   .assign({ nom, prenom,motdepasse,cv,adresseMail})
        //   .write();
    
        // return { id, nom, prenom,motdepasse,cv,adresseMail };
      }
};