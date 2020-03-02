const OffreEntity = require('../src/Model/Entity/Offre');
module.exports = class  {
    constructor(httpClient) {
        this.httpClient = httpClient;
    }

    searchOffres(titre, localisation, typeContrat, salaire, dateParution) {

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

        return this.httpClient.fetch('/searchOffres', {}).then(rows => {
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