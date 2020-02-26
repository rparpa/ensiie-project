const OffreRepository = require('./OffreRepository');
const Offre = require('../Entity/Offre');


describe("Create tests", () => {
    test('Create a Offre with a correct object', () => {

        let Offre = new Offre();
        Offre.id = "1";
        Offre.idEntreprise = "1";
        Offre.description = "description"
        Offre.document = "Document"
        Offre.typeContrat = "CDD"
        Offre.adresse = "adresse"
        Offre.latitude = "105°";
        Offre.longitude = "105°"
        Offre.salaire = "1000"
        Offre.isValid = "True"

        const dbMock = {
            get : jest.fn().mockReturnThis(),
            push : jest.fn().mockReturnThis(),
            write : jest.fn().mockReturnThis()
        };
        const repository = new OffreRepository(dbMock);
        repository.create(Offre);

        expect(dbMock.get).toHaveBeenCalledWith('Offres');
        expect(dbMock.get.mock.calls.length).toBe(1);
        expect(dbMock.push.mock.calls.length).toBe(1);
        expect(dbMock.write.mock.calls.length).toBe(1);
    });

    test('Throw Offre object undefined exception', () => {

        const repository = new OffreRepository();

        function create() {
            repository.create();
        }
        expect(create).toThrow(new Error('Offre object is undefined'));
    });

    test('Throw Offre object is missing information (id Entreprise  and so on case) exception', () => {
        let Offre = new Offre();
        Offre.id = "1"
        const repository = new OffreRepository();

        function create() {
            repository.create(Offre);
        }
        expect(create).toThrow(new Error('Offre object is missing information'));
    });

    describe ("Update tests", () => {

        test('It should update an existing offer', () => {
            const offre = {
                id: '1',
                idEntreprise: '2',
                descritpion: 'Description',
                document: 'Document',
                typeContrat: 'CDD',
                adresse: 'adresse',
                latitue:'105',
                longitude: '105',
                salaire: '1000',
                isValid: 'True'
              };
    
            const dbMock2 = {
                get : jest.fn().mockReturnThis(),
                find : jest.fn().mockReturnThis(),
                size : jest.fn().mockReturnThis(),
                assign : jest.fn().mockReturnThis(),
                write: jest.fn().mockReturnThis()
            };
    
            const repository = new OffreRepository(dbMock2);
    
            expect(repository.updateOne(offre)).toEqual(offre);
            expect(dbMock2.get).toHaveBeenCalledWith('offre');
            expect(dbMock2.find).toHaveBeenCalledWith({ id: '1' });
            expect(dbMock2.assign).toHaveBeenCalledWith({
                id: '1',
                idEntreprise: '2',
                descritpion: 'Description',
                document: 'Document',
                typeContrat: 'CDD',
                adresse: 'adresse',
                latitue:'105',
                longitude: '105',
                salaire: '1000',
                isValid: 'True'
              });
    
        });
    
        test('should not update an offer with no company',  () => {
            const repository = new OffreRepository();
            function update() {
                repository.updateOne({ id:'1' ,
                descritpion: 'Description',
                document: 'Document',
                typeContrat: 'CDD',
                adresse: 'adresse',
                latitue:'105',
                longitude: '105',
                salaire: '1000',
                isValid: 'True'})
            }
            expect(update).toThrow(new Error('no Company specified'));
          });
        }) ;



        describe('GetAll tests', () => {
            test('GetAll calls', () => {
        
                const dbMock2 = {
                    get : jest.fn().mockReturnThis(),
                    value : jest.fn().mockReturnValue([])
                };
        
                const repository = new OffreRepository(dbMock2);
                const offre = repository.getAll();
        
                expect(offre).toBe(offre);
                expect(dbMock2.get).toHaveBeenCalledWith('Offres');
                expect(dbMock2.get.mock.calls.length).toBe(1);
                expect(dbMock2.value.mock.calls.length).toBe(1);
            });
        });
});