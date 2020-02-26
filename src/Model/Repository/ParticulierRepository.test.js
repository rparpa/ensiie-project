const ParticulierRepository = require('./ParticulierRepository');
const Particulier = require('../Entity/Particulier');
describe("Create tests", () => {
    // test('Create a Particulier with a correct object', () => {

    //     let Part = new Particulier();
    //     Part.idOffre = "1";
    //     Part.idParticulier = "1";
    //     Part.date = new Date(2020,2,25);

    //     const dbMock = {
    //         get : jest.fn().mockReturnThis(),
    //         push : jest.fn().mockReturnThis(),
    //         write : jest.fn().mockReturnThis()
    //     };
    //     const repository = new PartRepository(dbMock);
    //     repository.create(Part);

    //     expect(dbMock.get).toHaveBeenCalledWith('Parts');
    //     expect(dbMock.get.mock.calls.length).toBe(1);
    //     expect(dbMock.push.mock.calls.length).toBe(1);
    //     expect(dbMock.write.mock.calls.length).toBe(1);
    // });

    test('Throw Part object undefined exception', () => {

        const repository = new ParticulierRepository();

        function create() {
            repository.create();
        }
        expect(create).toThrow(new Error('Part object is undefined'));
    });

    test('Throw Part object is missing information (id Offre case) exception', () => {
        let Part = new Particulier();
        Part.id = "1"
        Part.adresseMail = "adresse@mail.com"
        const repository = new ParticulierRepository();

        function create() {s
            repository.create(Part);
        }
        expect(create).toThrow(new Error('Part object is missing information'));
    });
});