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

    test('Throw Particulier object undefined exception', () => {

        const repository = new ParticulierRepository();

        function create() {
            repository.create();
        }
        expect(create).toThrow(new Error('Particulier object is undefined'));
    });

    test('Throw Particulier object is missing information (id Offre case) exception', () => {
        let Part = new Particulier();
        Part.id = "1"
        Part.adresseMail = "adresse@mail.com"
        const repository = new ParticulierRepository();

        function create() {
            repository.create(Part);
        }
        expect(create).toThrow(new Error('Particulier object is missing information'));
    });

    describe ("Update tests", () => {

        test('should not update a particulier with no id',  () => {
            const repository = new ParticulierRepository();
            function update() {
                repository.updateOne({ 
                // id:'1' ,
                nom: 'nom',
                prenom: 'prenom',
                motDePasse: 'mdp',
                cv: 'cv',
                adresseMail:'adresse'
            })
            }
            expect(update).toThrow(new Error('no id specified'));
          });
          test('should not update a particulier with no mail',  () => {
            const repository = new ParticulierRepository();
            function update() {
                repository.updateOne({ 
                    id:'1' ,
                    nom: 'nom',
                    prenom: 'prenom',
                    motDePasse: 'mdp',
                    cv: 'cv'
                    // adresseMail:'adresse'
                })
            }
            expect(update).toThrow(new Error('no email specified'));
          });
          test('should not update a particulier with no password',  () => {
            const repository = new ParticulierRepository();
            function update() {
                repository.updateOne({ 
                    id:'1' ,
                    nom: 'nom',
                    prenom: 'prenom',
                    // motDePasse: 'mdp',
                    cv: 'cv',
                    adresseMail: 'adresse'
                })
            }
            expect(update).toThrow(new Error('no password specified'));
          });
          test('should not update a particulier with no cv',  () => {
            const repository = new ParticulierRepository();
            function update() {
                repository.updateOne({ 
                    id:'1' ,
                    nom: 'nom',
                    prenom: 'prenom',
                    motDePasse: 'mdp',
                    // cv: 'cv',
                    adresseMail: 'adresse'
                })
            }
            expect(update).toThrow(new Error('no cv specified'));
          });
          test('should not update a particulier with no name',  () => {
            const repository = new ParticulierRepository();
            function update() {
                repository.updateOne({ 
                    id:'1' ,
                    // nom: 'nom',
                    prenom: 'prenom',
                    motDePasse: 'mdp',
                    cv: 'cv',
                    adresseMail:'adresse'
                })
            }
            expect(update).toThrow(new Error('no name specified'));
          });
          test('should not update a particulier with no firstname',  () => {
            const repository = new ParticulierRepository();
            function update() {
                repository.updateOne({ 
                    id:'1' ,
                    nom: 'nom',
                    // prenom: 'prenom',
                    motDePasse: 'mdp',
                    cv: 'cv',
                    adresseMail:'adresse'
                })
            }
            expect(update).toThrow(new Error('no firstname specified'));
          });
});
});