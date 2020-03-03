const ParticulierApi = require('./ParticulierApi');
const Particulier = require('../../src/Model/Entity/Particulier');

describe('ParticulierApi features', function () {

    test('Test constructor feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                prenom: "Corentin",
                adresseMail: "coco.simon@gmail.com",
                adresseDomicile: "massy somewhere",
                motDePasse: "son password",
                telephone: "son numero",
                cv: "CV.pdf",
                nom: "Simon"
            }
        ]);

        let particulierApi = new ParticulierApi(httpClientMock);

        expect(particulierApi.httpClient).not.toBe(undefined);
        expect(particulierApi.httpClient).not.toBe(null);
    });

    test('Test getProfil feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                prenom: "Corentin",
                adresseMail: "coco.simon@gmail.com",
                adresseDomicile: "massy somewhere",
                motDePasse: "son password",
                telephone: "son numero",
                cv: "CV.pdf",
                nom: "Simon"
            }
        ]);

        let particulierApi = new ParticulierApi(httpClientMock);
        particulierApi.getProfil(5).then(resp => {
            expect(resp.prenom).toBe("Corentin");
            expect(resp.nom).toBe("Simon");
            expect(resp.adresseMail).toBe("coco.simon@gmail.com");
            expect(resp.adresseDomicile).toBe("massy somewhere");
            expect(resp.motDePasse).toBe("son password");
            expect(resp.telephone).toBe("son numero");
            expect(resp.cv).toBe("CV.pdf");
            expect(resp).toBeInstanceOf(Particulier);
        });
    });

    test('Test editProfilNom feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                prenom: "Corentin",
                adresseMail: "coco.simon@gmail.com",
                adresseDomicile: "massy somewhere",
                motDePasse: "son password",
                telephone: "son numero",
                cv: "CV.pdf",
                nom: "Simone"
            }
        ]);

        let particulierApi = new ParticulierApi(httpClientMock);
        particulierApi.editProfilNom(5,"Simone").then(resp => {
            expect(resp.prenom).toBe("Corentin");
            expect(resp.nom).toBe("Simone");
            expect(resp.adresseMail).toBe("coco.simon@gmail.com");
            expect(resp.adresseDomicile).toBe("massy somewhere");
            expect(resp.motDePasse).toBe("son password");
            expect(resp.telephone).toBe("son numero");
            expect(resp.cv).toBe("CV.pdf");
            expect(resp).toBeInstanceOf(Particulier);
        });
    });

    test('Test editProfilPrenom feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                prenom: "Corentine",
                adresseMail: "coco.simon@gmail.com",
                adresseDomicile: "massy somewhere",
                motDePasse: "son password",
                telephone: "son numero",
                cv: "CV.pdf",
                nom: "Simon"
            }
        ]);

        let particulierApi = new ParticulierApi(httpClientMock);
        particulierApi.editProfilPrenom(5,"Corentine").then(resp => {
            expect(resp.prenom).toBe("Corentin");
            expect(resp.nom).toBe("Simon");
            expect(resp.adresseMail).toBe("coco.simon@gmail.com");
            expect(resp.adresseDomicile).toBe("massy somewhere");
            expect(resp.motDePasse).toBe("son password");
            expect(resp.telephone).toBe("son numero");
            expect(resp.cv).toBe("CV.pdf");
            expect(resp).toBeInstanceOf(Particulier);
        });
    });

    test('Test editProfilEmail feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                prenom: "Corentin",
                adresseMail: "coco.simon2@gmail.com",
                adresseDomicile: "massy somewhere",
                motDePasse: "son password",
                telephone: "son numero",
                cv: "CV.pdf",
                nom: "Simone"
            }
        ]);

        let particulierApi = new ParticulierApi(httpClientMock);
        particulierApi.editProfilEmail(5,"coco.simon2@gmail.com").then(resp => {
            expect(resp.prenom).toBe("Corentin");
            expect(resp.nom).toBe("Simone");
            expect(resp.adresseMail).toBe("coco.simon2@gmail.com");
            expect(resp.adresseDomicile).toBe("massy somewhere");
            expect(resp.motDePasse).toBe("son password");
            expect(resp.telephone).toBe("son numero");
            expect(resp.cv).toBe("CV.pdf");
            expect(resp).toBeInstanceOf(Particulier);
        });
    });

    test('Test editProfilAdresseDomi feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                prenom: "Corentin",
                adresseMail: "coco.simon@gmail.com",
                adresseDomicile: "blabla",
                motDePasse: "son password",
                telephone: "son numero",
                cv: "CV.pdf",
                nom: "Simone"
            }
        ]);

        let particulierApi = new ParticulierApi(httpClientMock);
        particulierApi.editProfilAdresseDomi(5,"blabla").then(resp => {
            expect(resp.prenom).toBe("Corentin");
            expect(resp.nom).toBe("Simone");
            expect(resp.adresseMail).toBe("coco.simon@gmail.com");
            expect(resp.adresseDomicile).toBe("blabla");
            expect(resp.motDePasse).toBe("son password");
            expect(resp.telephone).toBe("son numero");
            expect(resp.cv).toBe("CV.pdf");
            expect(resp).toBeInstanceOf(Particulier);
        });
    });

    test('Test editProfilTelephone feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                prenom: "Corentin",
                adresseMail: "coco.simon@gmail.com",
                adresseDomicile: "massy somewhere",
                motDePasse: "son password",
                telephone: "son numero2",
                cv: "CV.pdf",
                nom: "Simone"
            }
        ]);

        let particulierApi = new ParticulierApi(httpClientMock);
        particulierApi.editProfilTelephone(5,"son numero2").then(resp => {
            expect(resp.prenom).toBe("Corentin");
            expect(resp.nom).toBe("Simone");
            expect(resp.adresseMail).toBe("coco.simon@gmail.com");
            expect(resp.adresseDomicile).toBe("massy somewhere");
            expect(resp.motDePasse).toBe("son password");
            expect(resp.telephone).toBe("son numero2");
            expect(resp.cv).toBe("CV.pdf");
            expect(resp).toBeInstanceOf(Particulier);
        });
    });

    test('Test editProfilMdp feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                prenom: "Corentin",
                adresseMail: "coco.simon@gmail.com",
                adresseDomicile: "massy somewhere",
                motDePasse: "son password2",
                telephone: "son numero",
                cv: "CV.pdf",
                nom: "Simone"
            }
        ]);

        let particulierApi = new ParticulierApi(httpClientMock);
        particulierApi.editProfilMdp(5,"son password2").then(resp => {
            expect(resp.prenom).toBe("Corentin");
            expect(resp.nom).toBe("Simone");
            expect(resp.adresseMail).toBe("coco.simon@gmail.com");
            expect(resp.adresseDomicile).toBe("massy somewhere");
            expect(resp.motDePasse).toBe("son password2");
            expect(resp.telephone).toBe("son numero");
            expect(resp.cv).toBe("CV.pdf");
            expect(resp).toBeInstanceOf(Particulier);
        });
    });

    test('Test editProfilCV feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                prenom: "Corentin",
                adresseMail: "coco.simon@gmail.com",
                adresseDomicile: "massy somewhere",
                motDePasse: "son password",
                telephone: "son numero",
                cv: "CV2.pdf",
                nom: "Simone"
            }
        ]);

        let particulierApi = new ParticulierApi(httpClientMock);
        particulierApi.editProfilNom(5,"CV2.pdf").then(resp => {
            expect(resp.prenom).toBe("Corentin");
            expect(resp.nom).toBe("Simone");
            expect(resp.adresseMail).toBe("coco.simon@gmail.com");
            expect(resp.adresseDomicile).toBe("massy somewhere");
            expect(resp.motDePasse).toBe("son password");
            expect(resp.telephone).toBe("son numero");
            expect(resp.cv).toBe("CV2.pdf");
            expect(resp).toBeInstanceOf(Particulier);
        });
    });
});

