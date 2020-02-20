const Administrateur = require('./Administrateur');
describe('Administrateur toJson', function () {

    test('Test toJson', () => {
        let administrateur = new Administrateur();
        administrateur.identifiant = "1";
        administrateur.motDePasse = "5";

        expect(administrateur.toJson()).toMatchObject({
            identifiant: "1",
            motDePasse: "5"
        })
    });
});