const OffreRepository = require('./OffreRepository');
const Offre = require('../Entity/Offre');


describe("Create tests", () => {
    // test('Create a Offre with a correct object', () => {

    //     let offre = new Offre();
    //     offre.id = "1";
    //     offre.idEntreprise = "1";
    //     offre.description = "description"
    //     offre.document = "Document"
    //     offre.typeContrat = "CDD"
    //     offre.adresse = "adresse"
    //     offre.latitude = "105°";
    //     offre.longitude = "105°"
    //     offre.salaire = "1000"
    //     offre.isValid = "True"

    //     const dbMock = {
    //         get : jest.fn().mockReturnThis(),
    //         push : jest.fn().mockReturnThis(),
    //         write : jest.fn().mockReturnThis()
    //     };
    //     const repository = new OffreRepository(dbMock);
    //     repository.create(offre);

    //     expect(dbMock.get).toHaveBeenCalledWith('Offres');
    //     expect(dbMock.get.mock.calls.length).toBe(1);
    //     expect(dbMock.push.mock.calls.length).toBe(1);
    //     expect(dbMock.write.mock.calls.length).toBe(1);
    // });

    test('Throw Offre object undefined exception', () => {

        const repository = new OffreRepository();

        function create() {
            repository.create();
        }
        expect(create).toThrow(new Error('Offre object is undefined'));
    });

    test('Throw Offre object is missing information (id Entreprise  and so on case) exception', () => {
        let offre = new Offre();
        offre.id = "1"
        const repository = new OffreRepository();

        function create() {
            repository.create(offre);
        }
        expect(create).toThrow(new Error('Offre object is missing information'));
    });

    describe ("Update tests", () => {

        // test('It should update an existing offer', () => {
        //     const offre = {
        //         id: '1',
        //         idEntreprise: '2',
        //         description: 'description',
        //         document: 'Document',
        //         typeContrat: 'CDD',
        //         adresse: 'adresse',
        //         latitue:'105',
        //         longitude: '105',
        //         salaire: '1000',
        //         isValid: 'True'
        //       };
    
        //     const dbMock2 = {
        //         get : jest.fn().mockReturnThis(),
        //         find : jest.fn().mockReturnThis(),
        //         size : jest.fn().mockReturnThis(),
        //         assign : jest.fn().mockReturnThis(),
        //         write: jest.fn().mockReturnThis()
        //     };
    
        //     const repository = new OffreRepository(dbMock2);
    
        //     expect(repository.updateOne(offre)).toEqual(offre);
        //     expect(dbMock2.get).toHaveBeenCalledWith('offre');
        //     expect(dbMock2.find).toHaveBeenCalledWith({ id: '1' });
        //     expect(dbMock2.assign).toHaveBeenCalledWith({
        //         id: '1',
        //         idEntreprise: '2',
        //         description: 'description',
        //         document: 'Document',
        //         typeContrat: 'CDD',
        //         adresse: 'adresse',
        //         latitue:'105',
        //         longitude: '105',
        //         salaire: '1000',
        //         isValid: 'True'
        //       });
    
        // });
    
        test('should not update an offer with no company',  () => {
            const repository = new OffreRepository();
            function update() {
                repository.updateOne({ id:'1' ,
                // idEntreprise: '1',
                description: 'description',
                document: 'Document',
                typeContrat: 'CDD',
                adresse: 'adresse',
                latitude:'105',
                longitude: '105',
                salaire: '1000',
                isValid: 'True'})
            }
            expect(update).toThrow(new Error('no company specified'));
          });
          test('should not update an offer with no description',  () => {
            const repository = new OffreRepository();
            function update() {
                repository.updateOne({ id:'1' ,
                idEntreprise: '1',
                // description: 'Description',
                document: 'Document',
                typeContrat: 'CDD',
                adresse: 'adresse',
                latitue:'105',
                longitude: '105',
                salaire: '1000',
                isValid: 'True'})
            }
            expect(update).toThrow(new Error('no description specified'));
          });
          test('should not update an offer with no document',  () => {
            const repository = new OffreRepository();
            function update() {
                repository.updateOne({ 
                // id:'1' ,
                idEntreprise: '1',
                description: 'Description',
                // document: 'Document',
                typeContrat: 'CDD',
                adresse: 'adresse',
                latitude:'105',
                longitude: '105',
                salaire: '1000',
                isValid: 'True'})
            }
            expect(update).toThrow(new Error('no id specified'));
          });

          test('should not update an offer with no document',  () => {
            const repository = new OffreRepository();
            function update() {
                repository.updateOne({ id:'1' ,
                idEntreprise: '1',
                description: 'Description',
                // document: 'Document',
                typeContrat: 'CDD',
                adresse: 'adresse',
                latitude:'105',
                longitude: '105',
                salaire: '1000',
                isValid: 'True'})
            }
            expect(update).toThrow(new Error('no document specified'));
          });
          test('should not update an offer with no contract type',  () => {
            const repository = new OffreRepository();
            function update() {
                repository.updateOne({ id:'1' ,
                idEntreprise: '1',
                description: 'description',
                document: 'Document',
                // typeContrat: 'CDD',
                adresse: 'adresse',
                latitude:'105',
                longitude: '105',
                salaire: '1000',
                isValid: 'True'})
            }
            expect(update).toThrow(new Error('no contract type specified'));
          });
          test('should not update an offer with no address',  () => {
            const repository = new OffreRepository();
            function update() {
                repository.updateOne({ id:'1' ,
                idEntreprise: '1',
                description: 'description',
                document: 'Document',
                typeContrat: 'CDD',
                // adresse: 'adresse',
                latitude:'105',
                longitude: '105',
                salaire: '1000',
                isValid: 'True'})
            }
            expect(update).toThrow(new Error('no address specified'));
          });
          test('should not update an offer with no latitude',  () => {
            const repository = new OffreRepository();
            function update() {
                repository.updateOne({ id:'1' ,
                idEntreprise: '1',
                description: 'description',
                document: 'Document',
                typeContrat: 'CDD',
                adresse: 'adresse',
                // latitue:'105',
                longitude: '105',
                salaire: '1000',
                isValid: 'True'})
            }
            expect(update).toThrow(new Error('no latitude specified'));
          });
          test('should not update an offer with no longitude',  () => {
            const repository = new OffreRepository();
            function update() {
                repository.updateOne({ id:'1' ,
                idEntreprise: '1',
                description: 'description',
                document: 'Document',
                typeContrat: 'CDD',
                adresse: 'adresse',
                latitude:'105',
                // longitude: '105',
                salaire: '1000',
                isValid: 'True'})
            }
            expect(update).toThrow(new Error('no longitude specified'));
          });
          test('should not update an offer with no salary',  () => {
            const repository = new OffreRepository();
            function update() {
                repository.updateOne({ id:'1' ,
                idEntreprise: '1',
                description: 'description',
                document: 'Document',
                typeContrat: 'CDD',
                adresse: 'adresse',
                latitude:'105',
                longitude: '105',
                // salaire: '1000',
                isValid: 'True'})
            }
            expect(update).toThrow(new Error('no salary specified'));
          });
          test('should not update an offer which is not valid',  () => {
            const repository = new OffreRepository();
            function update() {
                repository.updateOne({ id:'1' ,
                idEntreprise: '1',
                description: 'description',
                document: 'Document',
                typeContrat: 'CDD',
                adresse: 'adresse',
                latitude:'105',
                longitude: '105',
                salaire: '1000'
                // isValid: 'True'
            })
            }
            expect(update).toThrow(new Error("isn't valid"));
          });
        }) ;



        // describe('GetAll tests', () => {
        //     test('GetAll calls', () => {
        
        //         const dbMock2 = {
        //             get : jest.fn().mockReturnThis(),
        //             value : jest.fn().mockReturnValue([])
        //         };
        
        //         const repository = new OffreRepository(dbMock2);
        //         const offre = repository.getAll();
        
        //         expect(offre).toBe(offre);
        //         expect(dbMock2.get).toHaveBeenCalledWith('Offres');
        //         expect(dbMock2.get.mock.calls.length).toBe(1);
        //         expect(dbMock2.value.mock.calls.length).toBe(1);
        //     });
        // });
});