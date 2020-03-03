const PostulerApi = require('./PostulerApi');

describe('PostulerApi features', function () {

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

        let postulerApi = new PostulerApi(httpClientMock);

        expect(postulerApi.httpClient).not.toBe(undefined);
        expect(postulerApi.httpClient).not.toBe(null);
    });

    test('Test postuler feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                isValidated : "yes"
            }
        ]);

        let postulerApi = new PostulerApi(httpClientMock);
        postulerApi.postuler(5,4).then(resp => {
            expect(resp.idParticulier).toBe("yes");
        });
    });
});

