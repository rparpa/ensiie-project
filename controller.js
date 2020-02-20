const http = require('http');
const url = require('url');
var fs = require('fs');

module.exports = http.createServer((req, res) => {

    // var service = require('./service.js');
    const reqUrl = url.parse(req.url, true);
    var pathname = url.parse(req.url).pathname;
    
    if(pathname == "/accueil") {
        res.writeHead(200, {"Content-Type": "text/html"});
        fs.readFile('./public/index.html',function (err, data){
            res.writeHead(200, {'Content-Type': 'text/html','Content-Length':data.length});
            res.write(data);
            res.end();
        });
    }
    else {
        res.writeHead(200, {"Content-Type": "application/json"});
        res.end(JSON.stringify(req.method));
    }

    // GET Endpoint
    // if (reqUrl.pathname == '/sample' && req.method === 'GET') {
    //     console.log('Request Type:' +
    //         req.method + ' Endpoint: ' +
    //         reqUrl.pathname);

    //     // service.sampleRequest(req, res);
    // } 
});