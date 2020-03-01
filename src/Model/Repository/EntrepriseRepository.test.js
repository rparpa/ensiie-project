const EntrepriseRepository = require('./EntrepriseRepository');
const Entreprise = require('../Entity/Entreprise');


describe("Create tests", () => {

    test('Throw Entreprise object undefined exception', () => {

        expect(() => EntrepriseRepository.create()).toThrow(new Error('Entreprise object is undefined'));
    });

    test('Throw Entreprise object is missing information (id Entreprise  and so on case) exception', () => {
        let entreprise = new Entreprise();
        entreprise.id = "1"
       
        expect(() => EntrepriseRepository.create(entreprise)).toThrow(new Error('Entreprise object is missing information'));
    });

    describe ("Update tests", () => {

   
        test('should not update an entreprise with no id',  () => {
            const repository = new EntrepriseRepository();
            function update() {
                repository.updateOne({
                //  id:'1' ,
                nom: 'description',
                adresseMail: 'Document',
                adresseSiege: 'CDD',
                motdepasse: 'adresse',
                logo:'105',
                isValid: 'True',
                })
            }
            expect(update).toThrow(new Error('no id specified'));
          });
          test('should not update an Entreprise with no name',  () => {
            const repository = new EntrepriseRepository();
            function update() {
                repository.updateOne({
                     id:'1' ,
                    // nom: 'description',
                    adresseMail: 'Document',
                    adresseSiege: 'CDD',
                    motdepasse: 'adresse',
                    logo:'105',
                    isValid: 'True',
                    })
            }
            expect(update).toThrow(new Error('no name specified'));
          });
          test('should not update an Entreprise with no email',  () => {
            const repository = new EntrepriseRepository();
            function update() {
                repository.updateOne({
                    id:'1' ,
                    nom: 'description',
                    // adresseMail: 'Document',
                    adresseSiege: 'CDD',
                    motdepasse: 'adresse',
                    logo:'105',
                    isValid: 'True',
                    })
            }
            expect(update).toThrow(new Error('no email specified'));
          });

          test('should not update an Entreprise with no location',  () => {
            const repository = new EntrepriseRepository();
            function update() {
                repository.updateOne({
                     id:'1' ,
                    nom: 'description',
                    adresseMail: 'Document',
                    // adresseSiege: 'CDD',
                    motdepasse: 'adresse',
                    logo:'105',
                    isValid: 'True',
                    })
            }
            expect(update).toThrow(new Error('no location specified'));
          });
          test('should not update an Entreprise with no password',  () => {
            const repository = new EntrepriseRepository();
            function update() {
                repository.updateOne({
                     id:'1' ,
                    nom: 'description',
                    adresseMail: 'Document',
                    adresseSiege: 'CDD',
                    // motdepasse: 'adresse',
                    logo:'105',
                    isValid: 'True',
                    })
            }
            expect(update).toThrow(new Error('no password specified'));
          });
          test('should not update an Entreprise with no address',  () => {
            const repository = new EntrepriseRepository();
            function update() {
                repository.updateOne({
                     id:'1' ,
                    nom: 'description',
                    adresseMail: 'Document',
                    adresseSiege: 'CDD',
                    motdepasse: 'adresse',
                    // logo:'105',
                    isValid: 'True',
                    })
            }
            expect(update).toThrow(new Error('no logo specified'));
          });
          test("should not update an entreprise which isn't valid",  () => {
            const repository = new EntrepriseRepository();
            function update() {
                repository.updateOne({
                     id:'1' ,
                    nom: 'description',
                    adresseMail: 'Document',
                    adresseSiege: 'CDD',
                    motdepasse: 'adresse',
                    logo:'105',
                    // isValid: 'True',
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
        
        //         const repository = new EntrepriseRepository(dbMock2);
        //         const Entreprise = repository.getAll();
        
        //         expect(Entreprise).toBe(Entreprise);
        //         expect(dbMock2.get).toHaveBeenCalledWith('Entreprises');
        //         expect(dbMock2.get.mock.calls.length).toBe(1);
        //         expect(dbMock2.value.mock.calls.length).toBe(1);
        //     });
        // });
});