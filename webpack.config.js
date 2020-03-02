const path = require('path');

module.exports = [{
    mode: 'development',
    entry:"./public/Script/index.js",
    
    output: {
        path: path.resolve(__dirname, 'public/dist'),
        filename: "index.js"
    }
},{
    mode: 'development',
    entry:"./public/Script/profil.js",
    
    output: {
        path: path.resolve(__dirname, 'public/dist'),
        filename: "profil.js"
    }
},{
    mode: 'development',
    entry:"./public/Script/offre.js",
    
    output: {
        path: path.resolve(__dirname, 'public/dist'),
        filename: "offre.js"
    }
},{
    mode: 'development',
    entry:"./public/Script/contribution.js",
    
    output: {
        path: path.resolve(__dirname, 'public/dist'),
        filename: "contribution.js"
    }
}];