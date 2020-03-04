const User = require('../entity/User')

class UsersController {
  constructor(databaseService) {
    this.service = databaseService
  }

  async getAllUser() {
    const result = await this.service
    .read('User', '*','')
    .then(res => res)    
    if (result.rows.length !== 0) {    
      const users = [];
      for(let u of result.rows){
        console.log(u)
        const user = new User(
          u.username
          , u.password
          , u.email
          , u.vehiculeId
          , u.addressId
          , u.role
          );
          users.push(user);
      }  
      
      return users;
    }
  }
}

module.exports = UsersController