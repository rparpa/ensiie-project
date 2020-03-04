const User = require('../entity/User')

class SettingsController {
  constructor(databaseService) {
    this.service = databaseService
  }

  async updateUser(currentUsername, newUsername, newEmail, newPassword) {
    // find user id via unique username
    const result = await this.service.read("User", "*", "username='"+currentUsername+"'")
    .then(res => res)
    console.log(result)
    const userId = result.rows[0].id
    
    // update user in db
    let values = {
      username: newUsername,
      email: newEmail,
      password: newPassword
    };
    await this.service.update("User",values,userId)
  }
}

module.exports = SettingsController