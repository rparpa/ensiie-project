const EntrepriseRepository = require('./EntrepriseRepository');
const Entreprise = require('../Entity/Entreprise');


describe("Create tests", () => {
  test('Throw Entreprise object undefined exception', async () => {
    try {
      await EntrepriseRepository.create();
    }
    catch(e) {
      expect(e).toEqual('Entreprise object is undefined');
    }
  });

  test('Throw Entreprise object is missing information (id Entreprise  and so on case) exception', async () => {
      let entreprise = new Entreprise();
      entreprise.id = "1";

      try {
        await EntrepriseRepository.create(entreprise);
      }
      catch(e) {
        expect(e).toEqual('Entreprise object is missing information');
      }      
  });
});