class databaseServiceMock {
  constructor() {}

  create(table, valuesObject) {
    return true
  }

  read(table, select, where = '') {
    return new Promise(resolve => {
      if (table === 'User' && where === 'username=\'johnDoe\' AND password=\'9834876dcfb05cb167a5c24953eba58c4ac89b1adf57f28f2f9d09af107ee8f0\'') 
        return resolve({
          Result: {
            rows: [ 
              {
              username: "johnDoe",
              password: "9834876dcfb05cb167a5c24953eba58c4ac89b1adf57f28f2f9d09af107ee8f0",
              email: "johndoe@email.com",
              vehiculeId: 2,
              addressId: 15 
              }
            ]
          }
        })
      else
        return resolve({Result: {rows: []}})
    })
  }

  update() {

  }

  delete() {

  }
}

module.exports = databaseServiceMock