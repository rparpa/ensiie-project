const Offre = require('./Offre');
describe('Offre toJson', function () {

    test('Test toJson', () => {
        let now = new Date();
        let offre = new Offre();
        offre.id = "1";
        offre.identreprise = "5";
        offre.description = "cool";
        offre.document = "C...";
        offre.typecontrat = "CDI";
        offre.adresse = "ici";
        offre.latitude = "90.090";
        offre.longitude = "90.090";
        offre.salaire = "5 euros";
        offre.titre = "titre";
        offre.dateparution = now;

        expect(offre.toJson()).toMatchObject({
            id: "1",
            identreprise: "5",
            description: "cool",
            document: "C...",
            typecontrat: "CDI",
            adresse: "ici",
            latitude: "90.090",
            longitude: "90.090",
            salaire: "5 euros",
            titre: "titre",
            dateparution: now
        })
    });
});