const http = require('http');
const url = require('url');
var fs = require('fs');

module.exports = http.createServer((req, res) => {

    // var service = require('./service.js');
    const reqUrl = url.parse(req.url, true);
    var pathname = url.parse(req.url).pathname;
    
    if(pathname == "/accueil") {
        fs.readFile('./public/index.html',function (err, data){
            res.writeHead(200, {'Content-Type': 'text/html'});
            res.end(data, 'utf-8');
        });
    }
    else if(pathname == "/profil") {
        fs.readFile('./public/profil.html',function (err, data){
            res.writeHead(200, {'Content-Type': 'text/html'});
            res.end(data, 'utf-8');
        });
    }
    else if(pathname == "/contribution") {
        fs.readFile('./public/contribution.html',function (err, data){
            res.writeHead(200, {'Content-Type': 'text/html'});
            res.end(data, 'utf-8');
        });
    }
    else if(pathname == "/offre") {
        fs.readFile('./public/offre.html',function (err, data){
            res.writeHead(200, {'Content-Type': 'text/html'});
            res.end(data, 'utf-8');
        });
    }
    else if(pathname == "/test") {
        fs.readFile('./public/test.html',function (err, data){
            res.writeHead(200, {'Content-Type': 'text/html'});
            res.end(data, 'utf-8');
        });
    }
    else if(pathname == "/index.js") {
        fs.readFile('./public/Script/index.js',function (err, data){
            res.writeHead(200, {'Content-Type': 'text/javascript'});
            res.end(data, 'utf-8');
        });
    }
    else if(pathname == "/contribution.js") {
        fs.readFile('./public/Script/contribution.js',function (err, data){
            res.writeHead(200, {'Content-Type': 'text/javascript'});
            res.end(data, 'utf-8');
        });
    }
    else if(pathname == "/offre.js") {
        fs.readFile('./public/Script/offre.js',function (err, data){
            res.writeHead(200, {'Content-Type': 'text/javascript'});
            res.end(data, 'utf-8');
        });
    }
    else if(pathname == "/profil.js") {
        fs.readFile('./public/Script/profil.js',function (err, data){
            res.writeHead(200, {'Content-Type': 'text/javascript'});
            res.end(data, 'utf-8');
        });
    }
    else if(pathname == "/dist/bundle.js") {
        fs.readFile('./public/dist/bundle.js',function (err, data){
            res.writeHead(200, {'Content-Type': 'text/javascript'});
            res.end(data, 'utf-8');
        });
    }
    else if(pathname == "/dist/index.js") {
        fs.readFile('./public/dist/index.js',function (err, data){
            res.writeHead(200, {'Content-Type': 'text/javascript'});
            res.end(data, 'utf-8');
        });
    }
    else if(pathname == "/dist/profil.js") {
        fs.readFile('./public/dist/profil.js',function (err, data){
            res.writeHead(200, {'Content-Type': 'text/javascript'});
            res.end(data, 'utf-8');
        });
    }
    else if (pathname == "/style.css") {
        fs.readFile('./public/style.css',function (err, data){
            res.writeHead(200, {'Content-Type': 'text/css'});
            res.end(data, 'utf-8');
        });
    }

    // GET Endpoint
    // if (reqUrl.pathname == '/sample' && req.method === 'GET') {
    //     console.log('Request Type:' +
    //         req.method + ' Endpoint: ' +
    //         reqUrl.pathname);

    //     // service.sampleRequest(req, res);
    // } 
});