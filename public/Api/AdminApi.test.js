const AdminApi = require('./AdminApi');
const Offre = require('../../src/Model/Entity/Offre');
const Entreprise = require('../../src/Model/Entity/Entreprise');

describe('AdminApi features', function () {

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

        let adminApi = new AdminApi(httpClientMock);

        expect(adminApi.httpClient).not.toBe(undefined);
        expect(adminApi.httpClient).not.toBe(null);
    });

    test('Test getInscriptionEntrepriseAttente feature with array size 1', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                id: 50,
                nom: "PSA",
                adresseMail: "rh@psa.com",
                adresseSiege: "chez psa",
                logo: "psa-logo.png",
                telephone: "numero psa"
            }
        ]);

        let adminApi = new AdminApi(httpClientMock);
        adminApi.getInscriptionEntrepriseAttente().then(resp => {
            expect(resp.id).toBe(50);
            expect(resp.nom).toBe("PSA");
            expect(resp.adresseMail).toBe("rh@psa.com");
            expect(resp.adresseSiege).toBe("chez psa");
            expect(resp.logo).toBe("psa-logo.png");
            expect(resp.telephone).toBe("numero psa");
            expect(resp).toBeInstanceOf(Entreprise);

        });
    });

    test('Test getOffreEntrepriseAttente feature', () => {

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

        let adminApi = new AdminApi(httpClientMock);
        adminApi.getOffreEntrepriseAttente().then(resp => {
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

    test('Test validerInscriptionEntreprise feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                message : "ok",
            }
        ]);

        let adminApi = new AdminApi(httpClientMock);
        adminApi.validerInscriptionEntreprise(5).then(resp => {
            expect(resp.message).toBe("ok");
        });
    });
    
    test('Test refuserInscriptionEntreprise feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                message : "ok",
            }
        ]);

        let adminApi = new AdminApi(httpClientMock);
        adminApi.refuserInscriptionEntreprise(5).then(resp => {
            expect(resp.message).toBe("ok");
        });
    });

    test('Test supprimerOffreEntreprise feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                message : "ok",
            }
        ]);

        let adminApi = new AdminApi(httpClientMock);
        adminApi.supprimerOffreEntreprise(5).then(resp => {
            expect(resp.message).toBe("ok");
        });
    });
});

