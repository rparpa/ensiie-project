const OffreEntity = require('../../src/Model/Entity/Offre');
module.exports = class  {
    constructor(httpClient) {
        this.httpClient = httpClient;
    }

    afficherContributions(idPersonne) {

        return this.httpClient.fetch('/afficherContributions', {}).then(rows => {
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