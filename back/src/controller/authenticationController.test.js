const User = require('../entity/User');
const AuthenticationController = require('./authenticationController')
const DatabaseServiceMock = require('../../tests/mock/databaseServiceMock')

describe('AuthenticationController', function () {

  test('getUserFromCredentials_whenUserExists', () => {
    const controller = new AuthenticationController(new DatabaseServiceMock());

    (async () => {
      const user = await controller
      .getUserFromCredentials("johnDoe","9834876dcfb05cb167a5c24953eba58c4ac89b1adf57f28f2f9d09af107ee8f0");

      expect(user.toJson()).toMatchObject({
        username: "johnDoe",
        encryptedPassword: "9834876dcfb05cb167a5c24953eba58c4ac89b1adf57f28f2f9d09af107ee8f0",
        email: "johndoe@email.com",
        vehiculeId: 2,
        addressId: 15
      })
    })()
  });

  test('getUserFromCredentials_whenUserNotExists', () => {
    const controller = new AuthenticationController(new DatabaseServiceMock());

    (async () => {
      const user = await controller
      .getUserFromCredentials("notValid","9834876dcfb05cb167a5c24953eba58c4ac89b1adf57f28f2f9d09af107ee8f0");

      expect(user === undefined)
    })()
  });

  test('createUser_whenSuccess', () => {
    const controller = new AuthenticationController(new DatabaseServiceMock());

    (async () => {
      const user = await controller
      .createUser("johnDoe", "johndoe@email.com", "9834876dcfb05cb167a5c24953eba58c4ac89b1adf57f28f2f9d09af107ee8f0");

      expect(user.toJson()).toMatchObject({
        username: "johnDoe",
        encryptedPassword: "9834876dcfb05cb167a5c24953eba58c4ac89b1adf57f28f2f9d09af107ee8f0",
        email: "johndoe@email.com",
        vehiculeId: undefined,
        addressId: undefined
      })
    })()
  });

})