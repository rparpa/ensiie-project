const OffreApi = require('./OffreApi');
const Offre = require('../../src/Model/Entity/Offre');


describe('OffreApi features', function () {

    test('Test constructor feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                isParticulier : "2",
                id : "123489032"
            }
        ]);

        let offreApi = new OffreApi(httpClientMock);

        expect(offreApi.httpClient).not.toBe(undefined);
        expect(offreApi.httpClient).not.toBe(null);
    });

    test('Test getOffres feature with array size 1', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                id : 12345,
                titre : "Alternance datascience",
                description : "Ca va être ouf tu vas voir",
                document : "none",
                typeContrat : "Alternance",
                adresse : "Quelque part",
                salaire: "12k",
                dateParution : "02-20-2020"
            }
        ]);

        let offreApi = new OffreApi(httpClientMock);
        offreApi.getOffres("Alternance", "", "", "salaire", "02-20-2020").then(resp => {
            expect(resp.id).toBe(12345);
            expect(resp.titre).toBe("Alternance datascience");
            expect(resp.description).toBe("Ca va être ouf tu vas voir");
            expect(resp.document).toBe("none");
            expect(resp.typeContrat).toBe("Alternance");
            expect(resp.adresse).toBe("Quelque part");
            expect(resp.salaire).toBe("12k");
            expect(resp.dateParution).toBe("02-20-2020");
            expect(resp).toBeInstanceOf(Offre);

        });
    });

    test('Test getCompanyOffre feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                id : 23456,
                titre : "President de la république",
                description : "Les voyages toussa toussa",
                document : "yes",
                typeContrat : "CDD",
                adresse : "Paname",
                salaire: "200k",
                dateParution : "20-20-2020"
            }
        ]);

        let offreApi = new OffreApi(httpClientMock);
        offreApi.getCompanyOffre(5).then(resp => {
            expect(resp.id).toBe(23456);
            expect(resp.titre).toBe("President de la république");
            expect(resp.description).toBe("Les voyages toussa toussa");
            expect(resp.document).toBe("yes");
            expect(resp.typeContrat).toBe("CDD");
            expect(resp.adresse).toBe("Paname");
            expect(resp.salaire).toBe("200k");
            expect(resp.dateParution).toBe("20-20-2020");
            expect(resp).toBeInstanceOf(Offre);

        });
    });

    test('Test createOffre feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                isSaved : "yes",
            }
        ]);

        let offreApi = new OffreApi(httpClientMock);
        offreApi.createOffre("idSociete", "titre", "description", "typeContrat", "salaire", "dateParution", "adresse", "document").then(resp => {
            expect(resp.isSaved).toBe("yes");
        });
    });
    
    test('Test modifyOffre feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                isSaved : "yes",
            }
        ]);

        let offreApi = new OffreApi(httpClientMock);
        offreApi.createOffre("idSociete", "titre", "description", "typeContrat", "salaire", "dateParution", "adresse", "document").then(resp => {
            expect(resp.isSaved).toBe("yes");
        });
    });
});

