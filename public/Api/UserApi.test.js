const UserApi = require('./UserApi');

describe('UserApi features', function () {

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

        let userApi = new UserApi(httpClientMock);

        expect(userApi.httpClient).not.toBe(undefined);
        expect(userApi.httpClient).not.toBe(null);
    });

    test('Test SignUp feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                isParticulier : "2",
                id : "123489032"
            }
        ]);

        let userApi = new UserApi(httpClientMock);
        userApi.signUp('emeric.bui@gmail.com','password').then(resp => {
            expect(resp.idParticulier).toBe("2");
            expect(resp.id).toBe("123489032");
        });
    });

    test('Test LogIn feature', () => {

        let httpClientMock = {
            fetch: jest.fn()
        };

        httpClientMock.fetch.mockResolvedValue([
            {
                isParticulier : "2",
                id : "123489032"
            }
        ]);

        let userApi = new UserApi(httpClientMock);
        userApi.signUp('emeric.bui@gmail.com','password').then(resp => {
            expect(resp.idParticulier).toBe("2");
            expect(resp.id).toBe("123489032");
        });
    });
});

