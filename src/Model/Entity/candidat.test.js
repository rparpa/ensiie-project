const Candidat = require('./Candidat');
describe('Candidat toJson', function () {

    test('Test toJson', () => {
        let candidat = new Candidat();
        candidat.idOffre = "1";
        candidat.idParticulier = "5";

        expect(candidat.toJson()).toMatchObject({
            idOffre: "1",
            idParticulier: "5"
        })
    });
});