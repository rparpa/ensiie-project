const OffreEntity = require('../../src/Model/Entity/Offre');
module.exports = class  {
    constructor(httpClient) {
        this.httpClient = httpClient;
    }

    getOffres(titre, localisation, typeContrat, salaire, dateParution) {

        var d = new Date();
        if(dateParution==='Tout') {

        }
        else if (dateParution==='< 1 mois') {
            d.setDate(d.getDate() - 30);
        }
        else if (dateParution==='< 2 semaines') {
            d.setDate(d.getDate() - 14);
        }
        else if (dateParution==='< 1 semaine') {
            d.setDate(d.getDate() - 7);
        }
        //alert(d.getDate() + "-" + d.getMonth() + "-" + d.getFullYear())
        //alert(typeof d.getDate())
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