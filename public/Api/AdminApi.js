const OffreEntity = require('../../src/Model/Entity/Offre');
const EntrepriseEntity = require('../../src/Model/Entity/Entreprise');

module.exports = class  {
    constructor(httpClient) {
        this.httpClient = httpClient;
    }

    getInscriptionEntrepriseAttente(){
        return this.httpClient.fetch('/getInscriptionEntrepriseAttente', {}).then(rows => {
            return rows.map(row => {
                let Entreprise = new EntrepriseEntity();
                Entreprise.adresseMail = row.adresseMail;
                Entreprise.telephone = row.telephone;
                Entreprise.nom = row.nom;
                Entreprise.motDePasse = row.motDePasse;
                Entreprise.adresseSiege = row.adresseSiege;
                Entreprise.logo = row.logo;
                return Entreprise;
            });
        });
    }

    getOffreEntrepriseAttente(){
        return this.httpClient.fetch('/getOffreEntrepriseAttente', {}).then(rows => {
            return rows.map(row => {
                let Offre = new OffreEntity();
                Offre.id = row.id;
                Offre.titre = row.titre;
                Offre.description = row.description;
                Offre.document = row.document;
                Offre.typeContrat = row.typeContrat;
                Offre.adresse = row.adresse;
                Offre.salaire = row.salaire;
                Offre.dateParution = row.dateParution;
                return Offre;
            });
        });
    }

    validerInscriptionEntreprise(idEntreprise) {

        return this.httpClient.fetch('/validerInscriptionEntreprise', {}).then(rows => {
            return rows.map(row => {
                alert(row.message)
            });
        });
    }

    refuserInscriptionEntreprise(idEntreprise) {

        return this.httpClient.fetch('/refuserInscriptionEntreprise', {}).then(rows => {
            return rows.map(row => {
                alert(row.message)
            });
        });
    }


    supprimerOffreEntreprise(idOffre){
        return this.httpClient.fetch('/supprimerOffreEntreprise', {}).then(rows => {
            return rows.map(row => {
                alert(row.message)
            });
        });
    }
    
}