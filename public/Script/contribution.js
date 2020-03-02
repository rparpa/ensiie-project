// Détection du support
if(localStorage.getItem('id') == "1" || localStorage.getItem('id') == "2") {
    document.getElementById("navbarDropdown").style.display = "block";
}
if(localStorage.getItem('id') == "1") {
    document.getElementById("contribution").style.display = "none";
}
else if (localStorage.getItem('id') == "2") {
    document.getElementById("offres").style.display = "none";
}

const appConfig = require('../../app.config');
const ContributionService = require('../Api/ContributionApi');
const HttpClient = require('./HttpClient');

const httpClient = new HttpClient(appConfig.apiUrl);

const Offre = require('../../src/Model/Entity/Offre');

const contributionService = new ContributionService(httpClient);

contributionService.afficherContributions(localStorage.getItem('idPersonne').value).then(offres => {
    let html =''
    offres.forEach((offre) => {
        
        html += OffreHtml(offre.id,offre.titre,offre.description,offre.document,offre.typeContrat,offre.adresse, offre.salaire,offre.dateParution);
    });
 
    document.getElementById('lesContributions').innerHTML = html;
});

OffreHtml = function(id,titre, description, document, typeContrat, adresse, salaire, dateParution) {
    let html =  '<div class="border border-primary rounded">' +
    '<div class="m-3 pb-3">' +
    '<h3 class="modal-title">' + titre + '</h3>' +
    '<div class="badge badge-primary text-wrap" style="width: 6rem;">' + typeContrat + '</div>' +
    '<div class="m-3 badge badge-primary text-wrap" style="width: 6rem;">' + salaire + '</div>' +
    '<div class="badge badge-primary text-wrap" style="width: 6rem;">' + dateParution + '</div> <br> ' +
    '<p class="text-sm-left">' + description + '</p>' +
    '<p class="font-weight-light text-sm-left"> Adresse : ' + adresse + '</p>' +
    '<p class="font-weight-light text-sm-left"> Document : ' + document + '</p>' +
    '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#postulerModal" data-idJetpack='+ id + '> Postuler </button>' +
    '</div>' +
    '</div> <br>'

    return html
};