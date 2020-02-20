const Particulier = require('./Particulier');
describe('Particulier toJson', function () {

    test('Test toJson', () => {
        let particulier = new Particulier();
        particulier.id = "1";
        particulier.nom = "toto";
        particulier.adresseMail = "toto@gmail.com";
        particulier.cv = "2 rue ensiie";
        particulier.motDePasse = "coucou";
        particulier.prenom = "ici";

        expect(particulier.toJson()).toMatchObject({
            id: "1",
            nom: "toto",
            adresseMail: "toto@gmail.com",
            cv: "2 rue ensiie",
            motDePasse: "coucou",
            prenom: "ici"
        })
    });
});