module.exports = class {
    constructor(db) {
        this.db = db;
    }

    create(Particulier) {
        if (!Particulier) {
            throw 'Particulier object is undefined';
        }

        if (!Particulier.id || !Particulier.nom || !Particulier.prenom || !Particulier.motdepasse || !Particulier.cv || !Particulier.adresseMail) {
            throw 'Particulier object is missing information';
        }
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