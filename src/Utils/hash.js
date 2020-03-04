var Crypto = require('crypto-js')

module.exports = class {
    constructor() {
    }
    static getHash(input){
        return Crypto.SHA256(input).toString();
        
    }
}