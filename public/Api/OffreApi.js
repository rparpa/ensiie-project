const OffreEntity = require('../../src/Model/Entity/Offre');
const ParticulierEntity = require('../../src/Model/Entity/Particulier');
module.exports = class  {
    constructor(httpClient) {
        this.httpClient = httpClient;
    }

    getOffres(titre, localisation, typeContrat, salaire, dateParution) {

        var d = new Date();
        if(dateParution==='Tout') {
            d.setFullYear(d.getFullYear() - 20);
        }
        else if (dateParution==='< 1 mois') {
            d.setMonth(d.getMonth() - 1);
        }
        else if (dateParution==='< 2 semaines') {
            d.setDate(d.getDate() - 14);
        }
        else if (dateParution==='< 1 semaine') {
            d.setDate(d.getDate() - 7);
        }
        //alert(d.getDate() + "-" + d.getMonth() + "-" + d.getFullYear())
        //alert(d.getTime())
        return this.httpClient.fetch('/getOffres', {}).then(rows => {
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

    createOffre(idSociete, titre, description, typeContrat, salaire, dateParution, adresse, document) {
        return this.httpClient.fetch('/createOffre', {}).then(rows => {
            return rows.map(row => {
                return(row.isSaved)
            });
        });
    }
    
    modifyOffre(idOffre, titre, description, typeContrat, salaire, dateParution, adresse, document) {
        return this.httpClient.fetch('/modifyOffre', {}).then(rows => {
            return rows.map(row => {
                return(row.isSaved)
            });
        });
    }

    removeOffre(idOffre) {
        return this.httpClient.fetch('/removeOffre', {}).then(rows => {
            return rows.map(row => {
                return(row.isRemoved)
            });
        });

    }

    getCandidats(idOffre) {
        return this.httpClient.fetch('/getCandidats', {}).then(rows => {
            return rows.map(row => {
                let Particulier = new ParticulierEntity();
                Particulier.id = row.id;
                Particulier.adresseMail = row.adresseMail;
                Particulier.telephone = row.telephone;
                Particulier.nom = row.nom;
                Particulier.prenom = row.prenom;
                return Particulier;
            });
        });
    }

    getCompanyOffre(idSociete) {
        return this.httpClient.fetch('/getCompanyOffres', {}).then(rows => {
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

}