const Entreprise = require('./Entreprise');
describe('Entreprise toJson', function () {

    test('Test toJson', () => {
        let entreprise = new Entreprise();
        entreprise.id = "1";
        entreprise.nom = "toto";
        entreprise.adresseMail = "toto@gmail.com";
        entreprise.adresseSiege = "2 rue ensiie";
        entreprise.motDePasse = "coucou";
        entreprise.logo = "ici";
        entreprise.isValid = true;

        expect(entreprise.toJson()).toMatchObject({
            id: "1",
            nom: "toto",
            adresseMail: "toto@gmail.com",
            adresseSiege: "2 rue ensiie",
            motDePasse: "coucou",
            logo: "ici",
            isValid: true
        })
    });
});