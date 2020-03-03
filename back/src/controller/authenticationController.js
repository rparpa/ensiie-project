const DatabaseService = require('../services/databaseService')
const User = require('../entity/User')

class AuthenticationController {
  constructor() {
    this.service = new DatabaseService()
  }

  async getUserFromCredentials(username, encryptedPassword) {
    const result = await this.service
    .read('User', '*', 'username=\''+username+'\' AND password=\''+encryptedPassword+'\'')
    .then(res => res)
    if (result.rows.length !== 0) {
      const user = new User(
        result.rows[0].username
        , result.rows[0].password
        , result.rows[0].email
        , result.rows[0].vehiculeId
        , result.rows[0].addressId
        )
      return user;
    }
  }

  async createUser(username, email, encryptedPassword) {
    let values = {
      username: username,
      email: email,
      password: encryptedPassword
    };
    const result = await this.service
    .create("User", values)
    .then(success => success)

    if (result) {
      const user = new User(
        username,
        encryptedPassword,
        email
      )
      return user
    }
  }
}

module.exports = AuthenticationController