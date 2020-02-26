const EntrepriseRepository = require('./EntrepriseRepository');
const Offre = require('../Entity/Offre')
module.exports = class {
    constructor(db) {
        this.db = db;
    }

    create(Offre) {
        if (!Offre) {
            throw 'Offre object is undefined';
        }

        if (!Offre.id || !Offre.idEntreprise || !Offre.description || !Offre.document || !Offre.typeContrat ||!Offre.adresse || !Offre.latitude || !Offre.longitude ||!Offre.salaire ||!Offre.isValid) {
            throw 'Offre object is missing information';
        }

        this.db
            .get('Offres')
            .push(Offre.toJson())
            .write()
    }
    
    getOne(id){
        return this.db
        .get('Offres')
        .find({id})
        .value();
    }
    
    updateOne({ id, idEntreprise, description,document,typeContrat,adresse,latitude,longitude,salaire,isValid  }) {
        if(!id){
            throw 'no id specified';
        }
        if(!idEntreprise){
            throw 'no Company specified';
        }
        if(!description){
            throw 'no description specified';
        }
        if(!typeContrat){
            throw 'no contract type specified';
        }
        if (!adresse){
            throw 'no address specified';
        }
        if(!latitude){
            throw 'no latitude specified';
        }
        if(!longitude){
            throw 'no longitude specified';
        }
        if(!salaire){
            throw 'no salary specified';
        }
        if(!isValid) {
            throw "isn't valid"
        }
        this.db
          .get('Offres')
          .find({id})
          .assign({ id, idEntreprise, description,document,typeContrat,adresse,latitude,longitude,salaire,isValid})
          .write();
    
        return { id, idEntreprise, description,document,typeContrat,adresse,latitude,longitude,salaire,isValid };
    }

      getAll(){
          return this.db.get('Offres').value();
      }

    //   getAllbyEntreprise(idEntreprise){
    //     let Offres = this.db
    //                         .get('Offres')
    //                         .value();

    //     if (Offres != null) {
    //         let OffresFiltered = [];
    //         let len = Offres.length

    //         for(let i = 0 ; i < len ; ++i) {
    //             if(Offres[i].idOffre == idOffre)  {
    //                 OffresFiltered.push(Offres[i]);
    //             }
    //         }

    //         return OffresFiltered;
    //     }

    //     return Offres;
    // }
    
        // getOffresByRadius(adresse,rayon) {
        //     let Offres = this.db
        //                     .get('Offres')
        //                     .value();

        // if (Offres != null) {
        //     let OffresFiltered = [];
        //     let len = Offres.length

        //     for(let i = 0 ; i < len ; ++i) {
        //         // if(condition très compliquée)  {
        //             OffresFiltered.push(Offres[i]);
        //         }
        //     }

        //     return OffresFiltered;
        

        // return Offres;
        // }
      
};