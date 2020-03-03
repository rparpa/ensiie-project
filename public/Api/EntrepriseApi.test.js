const EntrepriseApi = require('./EntrepriseApi');
const Entreprise = require('../../src/Model/Entity/Entreprise');

describe('EntrepriseApi features', function () {

    test('Test constructor feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                nom: "PSA",
                adresseMail: "coco.simon@psa.com",
                adresseSiege: "chez coco",
                motDePasse: "cocopassword",
                logo: "psa-logo.png",
                telephone: "numero coco"
            }
        ]);

        let entrepriseApi = new EntrepriseApi(httpClientMock);

        expect(entrepriseApi.httpClient).not.toBe(undefined);
        expect(entrepriseApi.httpClient).not.toBe(null);
    });

    test('Test getProfil feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                nom: "PSA",
                adresseMail: "coco.simon@psa.com",
                adresseSiege: "chez coco",
                motDePasse: "cocopassword",
                logo: "psa-logo.png",
                telephone: "numero coco"
            }
        ]);

        let entrepriseApi = new EntrepriseApi(httpClientMock);
        entrepriseApi.getProfil(5).then(resp => {
            expect(resp.nom).toBe("PSA");
            expect(resp.adresseMail).toBe("coco.simon@psa.com");
            expect(resp.adresseSiege).toBe("chez coco");
            expect(resp.motDePasse).toBe("cocopassword");
            expect(resp.telephone).toBe("numero coco");
            expect(resp.logo).toBe("psa-logo.png");
            expect(resp).toBeInstanceOf(Entreprise);
        });
    });

    test('Test editProfilNomSiege feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                nom: "PSA2",
                adresseMail: "coco.simon@psa.com",
                adresseSiege: "chez coco",
                motDePasse: "cocopassword",
                logo: "psa-logo.png",
                telephone: "numero coco"
            }
        ]);

        let entrepriseApi = new EntrepriseApi(httpClientMock);
        entrepriseApi.editProfilNomSiege(5,"PSA2").then(resp => {
            expect(resp.nom).toBe("PSA2");
            expect(resp.adresseMail).toBe("coco.simon@psa.com");
            expect(resp.adresseSiege).toBe("chez coco");
            expect(resp.motDePasse).toBe("cocopassword");
            expect(resp.telephone).toBe("numero coco");
            expect(resp.logo).toBe("psa-logo.png");
            expect(resp).toBeInstanceOf(Entreprise);
        });
    });

    test('Test editProfilEmail feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                nom: "PSA",
                adresseMail: "coco.simon2@psa.com",
                adresseSiege: "chez coco",
                motDePasse: "cocopassword",
                logo: "psa-logo.png",
                telephone: "numero coco"
            }
        ]);

        let entrepriseApi = new EntrepriseApi(httpClientMock);
        entrepriseApi.editProfilEmail(5,"coco.simon2@gmail.com").then(resp => {
            expect(resp.nom).toBe("PSA");
            expect(resp.adresseMail).toBe("coco.simon2@psa.com");
            expect(resp.adresseSiege).toBe("chez coco");
            expect(resp.motDePasse).toBe("cocopassword");
            expect(resp.telephone).toBe("numero coco");
            expect(resp.logo).toBe("psa-logo.png");
            expect(resp).toBeInstanceOf(Entreprise);
        });
    });

    test('Test editProfilAdresseSiege feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                nom: "PSA",
                adresseMail: "coco.simon@psa.com",
                adresseSiege: "blabla",
                motDePasse: "cocopassword",
                logo: "psa-logo.png",
                telephone: "numero coco"
            }
        ]);

        let entrepriseApi = new EntrepriseApi(httpClientMock);
        entrepriseApi.editProfilAdresseSiege(5,"blabla").then(resp => {
            expect(resp.nom).toBe("PSA");
            expect(resp.adresseMail).toBe("coco.simon@psa.com");
            expect(resp.adresseSiege).toBe("blabla");
            expect(resp.motDePasse).toBe("cocopassword");
            expect(resp.telephone).toBe("numero coco");
            expect(resp.logo).toBe("psa-logo.png");
            expect(resp).toBeInstanceOf(Entreprise);
        });
    });

    test('Test editProfilTelephone feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                nom: "PSA",
                adresseMail: "coco.simon@psa.com",
                adresseSiege: "chez coco",
                motDePasse: "cocopassword",
                logo: "psa-logo.png",
                telephone: "son numero2"
            }
        ]);

        let entrepriseApi = new EntrepriseApi(httpClientMock);
        entrepriseApi.editProfilTelephone(5,"son numero2").then(resp => {
            expect(resp.nom).toBe("PSA");
            expect(resp.adresseMail).toBe("coco.simon@psa.com");
            expect(resp.adresseSiege).toBe("chez coco");
            expect(resp.motDePasse).toBe("cocopassword");
            expect(resp.telephone).toBe("son numero2");
            expect(resp.logo).toBe("psa-logo.png");
            expect(resp).toBeInstanceOf(Entreprise);
        });
    });

    test('Test editProfilMdp feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                nom: "PSA",
                adresseMail: "coco.simon@psa.com",
                adresseSiege: "chez coco",
                motDePasse: "cocopassword2",
                logo: "psa-logo.png",
                telephone: "numero coco"
            }
        ]);

        let entrepriseApi = new EntrepriseApi(httpClientMock);
        entrepriseApi.editProfilMdp(5,"cocopassword2").then(resp => {
            expect(resp.nom).toBe("PSA");
            expect(resp.adresseMail).toBe("coco.simon@psa.com");
            expect(resp.adresseSiege).toBe("chez coco");
            expect(resp.motDePasse).toBe("cocopassword2");
            expect(resp.telephone).toBe("numero coco");
            expect(resp.logo).toBe("psa-logo.png");
            expect(resp).toBeInstanceOf(Entreprise);
        });
    });

    test('Test editProfilLogo feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                nom: "PSA",
                adresseMail: "coco.simon@psa.com",
                adresseSiege: "chez coco",
                motDePasse: "cocopassword",
                logo: "psa-logo2.png",
                telephone: "numero coco"
            }
        ]);

        let entrepriseApi = new EntrepriseApi(httpClientMock);
        entrepriseApi.editProfilLogo(5,"psa-logo2.png").then(resp => {
            expect(resp.nom).toBe("PSA");
            expect(resp.adresseMail).toBe("coco.simon@psa.com");
            expect(resp.adresseSiege).toBe("chez coco");
            expect(resp.motDePasse).toBe("cocopassword2");
            expect(resp.telephone).toBe("numero coco");
            expect(resp.logo).toBe("psa-logo2.png");
            expect(resp).toBeInstanceOf(Entreprise);
        });
    });
});

