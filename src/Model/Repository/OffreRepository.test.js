const OffreRepository = require('./OffreRepository');
const Offre = require('../Entity/Offre');


describe("Create tests", () => {
  test('Throw Offre object undefined exception', async () => {
    try {
      await OffreRepository.create();
    }
    catch(e) {
      expect(e).toEqual('Offre object is undefined');
    }    
  });

  test('Throw Offre object is missing information (id Entreprise  and so on case) exception', async () => {
      let offre = new Offre();
      offre.id = "1"
      try {
        await OffreRepository.create(offre);
      }
      catch(e) {
        expect(e).toEqual('Offre object is missing information');
      }    
  });
});

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
    