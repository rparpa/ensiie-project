
const fs = require('fs');

module.export = class {
    constructor() {
    }
    writeToFile(path,file){
        fs.writeFile(path,file , function(err) {
            if(err) {
                return -1;
            }
        }); 
        
        // Or
        fs.writeFileSync('/tmp/test-sync');
        
        
    }
}