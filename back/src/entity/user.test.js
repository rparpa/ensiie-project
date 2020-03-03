const User = require('./User');

describe('User toJson', function () {

    test('Test toJson', () => {
        let user = new User(
            'johnDoe'
            , '9834876dcfb05cb167a5c24953eba58c4ac89b1adf57f28f2f9d09af107ee8f0'
            , 'johndoe@email.com'
            , 2
            , 15)

        expect(user.toJson()).toMatchObject({
            username: "johnDoe",
            encryptedPassword: "9834876dcfb05cb167a5c24953eba58c4ac89b1adf57f28f2f9d09af107ee8f0",
            email: "johndoe@email.com",
            vehiculeId: 2,
            addressId: 15
        })
    });

});