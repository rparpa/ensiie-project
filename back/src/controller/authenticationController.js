const DatabaseService = require('../services/databaseService')

class AuthenticationController {
    constructor() {
        this.service = new DatabaseService()
    }

    getUserFromCredentials(username, encryptedPassword) {
        this.service.read('User', '*', 'username=\''+username+'\' AND password=\''+encryptedPassword+'\'')
    }
}

module.exports = AuthenticationController