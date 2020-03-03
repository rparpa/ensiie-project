const CandidatRepository = require('./CandidatRepository');
const Candidat = require('../Entity/Candidat');


describe("Create tests", () => {
    test('Throw Candidat object undefined exception', async () => {
        try {
            await CandidatRepository.create();
        }
        catch(e){
            expect(e).toEqual('Candidat object is undefined')
        }
    });

    test('Throw Candidat object is missing information (id Offre case) exception', async () => {
        let Candidature = new Candidat();
        Candidature.idparticulier = "2"

        try {
            await CandidatRepository.create(Candidature);
        }
        catch(e){
            expect(e).toEqual('Candidat object is missing information')
        }        
    });

    test('Throw Candidat object is missing information (idparticulier  case) exception', async () => {
        let Candidature = new Candidat();
        Candidature.idoffre = "1"

        try {
            await CandidatRepository.create(Candidature);
        }
        catch(e){
            expect(e).toEqual('Candidat object is missing information')
        }        
    });
});