var Crypto = require('crypto-js')

module.export = class {
    constructor() {
    }
    getHash(input){
        return Crypto.SHA256(input).toString();
        
    }
}