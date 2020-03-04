const ContributionApi = require('./ContributionApi');
const Offre = require('../../src/Model/Entity/Offre');


describe('ContributionApi features', function () {

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

        let contributionApi = new ContributionApi(httpClientMock);

        expect(contributionApi.httpClient).not.toBe(undefined);
        expect(contributionApi.httpClient).not.toBe(null);
    });

    test('Test afficherContributions feature with array size 2', () => {

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
            },
            {
                id : 67889,
                titre : "Ingenieur datascience",
                description : "Ca va être nul tu vas voir",
                document : "none",
                typeContrat : "CDI",
                adresse : "Quelque part",
                salaire: "50k",
                dateParution : "20-20-2020"
            }
        ]);

        let contributionApi = new ContributionApi(httpClientMock);
        contributionApi.afficherContributions(5).then(resp => {
            expect(resp[O].id).toBe(12345);
            expect(resp[O].titre).toBe("Alternance datascience");
            expect(resp[O].description).toBe("Ca va être ouf tu vas voir");
            expect(resp[O].document).toBe("none");
            expect(resp[O].typeContrat).toBe("Alternance");
            expect(resp[O].adresse).toBe("Quelque part");
            expect(resp[O].salaire).toBe("12k");
            expect(resp[O].dateParution).toBe("02-20-2020");
            expect(resp[O]).toBeInstanceOf(Offre);

            expect(resp[1].id).toBe(67889);
            expect(resp[1].titre).toBe("Ingenieur datascience");
            expect(resp[1].description).toBe("Ca va être ouf tu vas voir");
            expect(resp[1].document).toBe("none");
            expect(resp[1].typeContrat).toBe("CDI");
            expect(resp[1].adresse).toBe("Quelque part");
            expect(resp[1].salaire).toBe("50k");
            expect(resp[1].dateParution).toBe("20-20-2020");
            expect(resp[1]).toBeInstanceOf(Offre);
        });
    });

    test('Test afficherContributions feature with array size 1', () => {

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

        let contributionApi = new ContributionApi(httpClientMock);
        contributionApi.afficherContributions(5).then(resp => {
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
});

