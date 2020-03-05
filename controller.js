const http = require('http');
const url = require('url');
const ParticulierWebService = require('./src/Model/Controller/ParticulierWebService');
const EntrepriseWebService = require('./src/Model/Controller/EntrepriseWebService');  
const OffreWebService = require('./src/Model/Controller/OffreWebService');  
const CandidatWebService = require('./src/Model/Controller/CandidatWebService');  
const AuthService = require('./src/Model/Controller/AuthService');  
var fs = require('fs');

module.exports = http.createServer((req, res) => {
    const reqUrl = url.parse(req.url, true);
    var pathname = reqUrl.pathname;
    var params = new URL("http://" + req.url).searchParams; 
    
    if(pathname == "/accueil") {
        fs.readFile('./public/index.html',function (err, data){
            res.writeHead(200, {'Content-Type': 'text/html'});
            res.end(data, 'utf-8');
        });
    }
    else if(pathname == "/admin") {
        fs.readFile('./public/admin.html',function (err, data){
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
    else if(pathname == "/offre" && req.method === 'GET') {
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
    else if(pathname == "/admin.js") {
        fs.readFile('./public/Script/admin.js',function (err, data){
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
    else if(pathname == "/dist/admin.js") {
        fs.readFile('./public/dist/admin.js',function (err, data){
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
    else if(pathname == "/dist/offre.js") {
        fs.readFile('./public/dist/offre.js',function (err, data){
            res.writeHead(200, {'Content-Type': 'text/javascript'});
            res.end(data, 'utf-8');
        });
    }
    else if(pathname == "/dist/contribution.js") {
        fs.readFile('./public/dist/contribution.js',function (err, data){
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
    else if(pathname == "/particulier/request") {
        if(req.method == 'POST') {
            ParticulierWebService.create(req, res);
        }
        else if(req.method == 'GET') {
            if(params.has('id')) {
                ParticulierWebService.getById(req, res, params.get('id'));
            }
            else {
                ParticulierWebService.getAll(req, res);
            }
        }
        else if(req.method == 'PUT') {
            ParticulierWebService.updateOne(req, res);
        }
        else if(req.method == 'DELETE') {
            if(params.has('id')) {
                ParticulierWebService.deleteById(req, res, params.get('id'));
            }
        }
    }
    else if(pathname == "/entreprise/request") {
        if(req.method == 'POST') {
            EntrepriseWebService.create(req, res);
        }
        else if(req.method == 'GET') {
            if(params.has('id')) {
                EntrepriseWebService.getById(req, res, params.get('id'));
            }
            else {
                EntrepriseWebService.getAllValidated(req, res);
            }
        }
        else if(req.method == 'PUT') {
            EntrepriseWebService.updateOne(req, res);
        }
        else if(req.method == 'DELETE') {
            if(params.has('id')) {
                EntrepriseWebService.deleteById(req, res, params.get('id'));
            }
        }
    }
    else if(pathname == "/entreprise/request/novalidated") {
        if(req.method == 'GET') {
            EntrepriseWebService.getAllNoValidated(req, res);
        }
    }
    else if(pathname == "/offre/request") {
        if(req.method == 'POST') {
            OffreWebService.create(req, res);
        }
        else if(req.method == 'GET') {
            if(params.has('titre') && params.has('adresse') && params.has('typecontrat') && params.has('salaire') && params.has('dateparution') && params.has('dist')) {
                OffreWebService.getAllByArgs(req, res, params.get('titre'), params.get('adresse'), params.get('typecontrat'), params.get('salaire'), params.get('dateparution'), params.get('dist'));
            }
            if(params.has('identreprise')) {
                OffreWebService.getAllByIdentreprise(req, res, params.get('identreprise'));
            }
        }
        else if(req.method == 'PUT') {
            OffreWebService.updateOne(req, res);
        }
        else if(req.method == 'DELETE') {
            if(params.has('id')) {
                OffreWebService.deleteById(req, res, params.get('id'));
            }
        }
    }
    else if(pathname == "/candidat/request") {
        if(req.method == 'POST') {
            CandidatWebService.create(req, res);
        }
        else if(req.method == 'GET') {
            if(params.has('idoffre')) {
                CandidatWebService.getAllCandidatByOffre(req, res, params.get('idoffre'));
            }
            else if(params.has('idparticulier')) {
                CandidatWebService.getAllOffreByCandidat(req, res, params.get('idparticulier'));
            }
        }
        else if(req.method == 'PUT') {

        }
        else if(req.method == 'DELETE') {

        }
    }
    else if(pathname == "/login/request" && req.method == 'POST') {
        AuthService.login(req, res);
    }
});