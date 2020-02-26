const CandidatRepository = require('./CandidatRepository');
const Candidat = require('../Entity/Candidat');


describe("Create tests", () => {
    // test('Create a Candidature with a correct object', () => {

    //     let Candidature = new Candidat();
    //     Candidature.idOffre = "1";
    //     Candidature.idParticulier = "1";
    //     Candidature.date = new Date(2020,2,25);

    //     const dbMock = {
    //         get : jest.fn().mockReturnThis(),
    //         push : jest.fn().mockReturnThis(),
    //         write : jest.fn().mockReturnThis()
    //     };
    //     const repository = new CandidatRepository(dbMock);
    //     repository.create(Candidature);

    //     expect(dbMock.get).toHaveBeenCalledWith('Candidats');
    //     expect(dbMock.get.mock.calls.length).toBe(1);
    //     expect(dbMock.push.mock.calls.length).toBe(1);
    //     expect(dbMock.write.mock.calls.length).toBe(1);
    // });

    test('Throw Candidat object undefined exception', () => {

        const repository = new CandidatRepository();

        function create() {
            repository.create();
        }
        expect(create).toThrow(new Error('Candidat object is undefined'));
    });

    test('Throw Candidat object is missing information (id Offre case) exception', () => {
        let Candidature = new Candidat();
        Candidature.date = new Date(2020, 2, 25);
        Candidature.idParticulier = "2"
        const repository = new CandidatRepository();

        function create() {
            repository.create(Candidature);
        }
        expect(create).toThrow(new Error('Candidat object is missing information'));
    });
});