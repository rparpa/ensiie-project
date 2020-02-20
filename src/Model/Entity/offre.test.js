const Offre = require('./Offre');
describe('Offre toJson', function () {

    test('Test toJson', () => {
        let offre = new Offre();
        offre.id = "1";
        offre.idEntreprise = "5";
        offre.description = "cool";
        offre.document = "C...";
        offre.typeContrat = "CDI";
        offre.adresse = "ici";
        offre.latitude = "90.090";
        offre.longitude = "90.090";
        offre.salaire = "5 euros";
        offre.isValid = false;

        expect(offre.toJson()).toMatchObject({
            id: "1",
            idEntreprise: "5",
            description: "cool",
            document: "C...",
            typeContrat: "CDI",
            adresse: "ici",
            latitude: "90.090",
            longitude: "90.090",
            salaire: "5 euros",
            isValid: false
        })
    });
});