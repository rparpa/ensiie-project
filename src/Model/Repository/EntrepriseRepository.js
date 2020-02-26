const OffreRepository = require('./OffreRepository');

module.exports = class {
    constructor(db) {
        this.db = db;
    }

    create(Entreprise) {
        if (!Entreprise) {
            throw 'Entreprise object is undefined';
        }

        if (!Entreprise.id || !Entreprise.nom || !Entreprise.motdepasse || !Entreprise.logo || !Entreprise.adresseSiege ||!Entreprise.adresseMail || !Entreprise.isValid) {
            throw 'Entreprise object is missing information';
        }

        this.db
            .get('Entreprises')
            .push(Entreprise.toJson())
            .write()
    }
    
    getOne(id){
        return this.db
        .get('Entreprises')
        .find({id})
        .value();
    }
    
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
            throw 'no cv specified';
        }
        if(!adresseMail){
            throw 'no email specified';
        }
        if(!isValid) {
            throw "isn't valid"
        }
        this.db
          .get('Entreprises')
          .find({id})
          .assign({ nom, adresseMail,adresseSiege,logo,motDePasse, adresseMail,isValid})
          .write();
    
        return { id, nom, adresseSiege,motdepasse,logo,adresseMail, isValid };
      }

      getAll(){
          return this.db.get('Entreprises').value();
      }
};