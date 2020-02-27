const appConfig = require('./app.config');
const OffreService = require('./public/OffreApi');
const HttpClient = require('./public/HttpClient');


const Offre = require('./src/Model/Entity/Offre');

const httpClient = new HttpClient(appConfig.apiUrl);

const offreService = new OffreService(httpClient);

offreService.searchOffres(
    document.getElementById('exampleInputJobs').value,
    document.getElementById('exampleInputLocation').value,
    document.getElementById('inputContrat').value,
    document.getElementById('inputSalaire').value,
    document.getElementById('inputDate').value,
).then(offres => {

    let html =''
    offres.forEach((offre) => {
        html += OffreHtml(offre.titre,offre.description,offre.document,offre.typeContrat,offre.salaire,offre.dateParution);
        
    });
        
    document.getElementById('lesOffres').innerHTML = html;
});

OffreHtml = function(titre, description, document, typeContrat, adresse, salaire, dateParution) {
    let html =  titre + ' ' + description + "\n";
    return html
};