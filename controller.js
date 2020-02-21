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