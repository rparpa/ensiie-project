const insert = "INSERT INTO particulier(nom, adressemail, adressesiege, motdepasse, logo, isvalid) VALUES($1, $2, $3, $4, $5, $6) RETURNING *";

module.exports = class {
    static create(Entreprise) {
        if (!Entreprise) {
            throw 'Entreprise object is undefined';
        }

        if (!Entreprise.nom || !Entreprise.motdepasse || !Entreprise.logo || !Entreprise.adressesiege ||!Entreprise.adressemail || !Entreprise.isvalid) {
            throw 'Entreprise object is missing information';
        }
        let result;
        let values = [Entreprise.nom, Entreprise.adressemail, Entreprise.adressesiege, Entreprise.motdepasse, Entreprise.logo, Entreprise.isvalid];

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
    
    // getOne(id){
    //     return this.db
    //     .get('Entreprises')
    //     .find({id})
    //     .value();
    // }
    
    updateOne({ id, nom, motdepasse,logo,adresseMail,adresseSiege,isValid  }) {
        if(!id){
            throw 'no id specified';
        }
        if(!nom){
            throw 'no name specified';
        }
        if(!adresseSiege){
            throw 'no location specified';
        }
        if(!motdepasse){
            throw 'no password specified';
        }
        if (!logo){
            throw 'no logo specified';
        }
        if(!adresseMail){
            throw 'no email specified';
        }
        if(!isValid) {
            throw "isn't valid"
        }
        // this.db
        //   .get('Entreprises')
        //   .find({id})
        //   .assign({ nom, adresseMail,adresseSiege,logo,motDePasse, adresseMail,isValid})
        //   .write();
    
        // return { id, nom, adresseSiege,motdepasse,logo,adresseMail, isValid };
      }

    //   getAll(){
    //       return this.db.get('Entreprises').value();
    //   }
};