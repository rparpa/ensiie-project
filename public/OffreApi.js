const OffreApi = require('../src/Model/Entity/Offre');
module.exports = class  {
    constructor(httpClient) {
        this.httpClient = httpClient;
    }

    searchOffres(titre, localisation, typeContrat, salaire, dateParution) {
        return this.httpClient.fetch('/searchOffres', {}).then(rows => {
            return rows.map(row => {
                let Offre = new OffreApi();
                Offre.titre = row.titre;
                Offre.description = row.description;
                Offre.document = row.description;
                Offre.typeContrat = row.typeContrat;
                Offre.adresse = row.adresse;
                Offre.salaire = row.salaire;
                Offre.dateParution = row.dateParution;
                return Offre;
            });
        });
    }

}