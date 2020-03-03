const appConfig = require('../../app.config');
const AdminService = require('../Api/AdminApi');
const HttpClient = require('./HttpClient');

const httpClient = new HttpClient(appConfig.apiUrl);

//const Offre = require('../../src/Model/Entity/Offre');

const adminService = new AdminService(httpClient);

adminService.getInscriptionEntrepriseAttente().then(entreprises => {
    let html =''
    entreprises.forEach((entreprise) => {
        
        html += EntrepriseHtml(entreprise.id,entreprise.nom, entreprise.adresseMail, entreprise.telephone, entreprise.adresseSiege, entreprise.logo);
    });
 
    document.getElementById('inscription-entreprise').innerHTML = html;
});

adminService.getOffreEntrepriseAttente().then(offres => {
    let html =''
    offres.forEach((offre) => {
        
        html += OffreHtml(offre.id,offre.titre,offre.description,offre.document,offre.typeContrat,offre.adresse, offre.salaire,offre.dateParution);
    });
 
    document.getElementById('offre-entreprise').innerHTML = html;
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
    '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#validerModal" data-idOffre='+ id + '> Valider </button>' +
    '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#refuserModal" data-idOffre='+ id + '> Refuser </button>' +
    '</div>' +
    '</div> <br>'

    return html
};

EntrepriseHtml = function(id,nom, adresseMail, telephone, adresseSiege, logo) {
    let html =  '<div class="border border-primary rounded">' +
    '<div class="m-3 pb-3">' +
    '<h3 class="modal-title">' + nom + '</h3>' +
    '<p class="font-weight-light text-sm-left"> Email : ' + adresseMail + '</p>' +
    '<p class="font-weight-light text-sm-left"> Telephone : ' + telephone + '</p>' +
    '<p class="font-weight-light text-sm-left"> Adresse du siege : ' + adresseSiege + '</p>' +
    '<p class="font-weight-light text-sm-left"> Logo (.png) : ' + logo + '</p>' +
    '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#validerEModal" data-idEntreprise='+ id + '> Valider </button>' +
    '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#refuserEModal" data-idEntreprise='+ id + '> Refuser </button>' +
    '</div>' +
    '</div> <br>'

    return html
};


$('#validerModal').on('show.bs.modal', function (event) {
    

    var idOffre = $(event.relatedTarget).attr('data-idOffre')

    document.getElementById('btnValider').onclick = async function() {


        adminService.validerOffreEntreprise(idOffre).then( x => {
            x.forEach((y) => {
                if(y==="ok"){
                    alert("Offre valide")
                }
            });
    
        });

        await sleep(1000);
        location.reload(); 
    }
 
})

$('#validerEModal').on('show.bs.modal', function (event) {
    

    var idEntreprise = $(event.relatedTarget).attr('data-idEntreprise')

    document.getElementById('btnEntrepriseValider').onclick = async function() {


        adminService.validerOffreEntreprise(idEntreprise).then( x => {
            x.forEach((y) => {
                if(y==="ok"){
                    alert("Entreprise valide")
                }
            });
    
        });

        await sleep(1000);
        location.reload(); 
    }
 
})

$('#refuserModal').on('show.bs.modal', function (event) {
    

    var idOffre = $(event.relatedTarget).attr('data-idOffre')

    document.getElementById('btnRefuser').onclick = async function() {


        adminService.refuserOffreEntreprise(idOffre).then( x => {
            x.forEach((y) => {
                if(y==="ok"){
                    alert("Offre refuse")
                }
            });
    
        });

        await sleep(1000);
        location.reload(); 
    }
 
})

$('#refuserEModal').on('show.bs.modal', function (event) {
    

    var idEntreprise = $(event.relatedTarget).attr('data-idEntreprise')

    document.getElementById('btnEntrepriseRefuser').onclick = async function() {


        adminService.validerOffreEntreprise(idEntreprise).then( x => {
            x.forEach((y) => {
                if(y==="ok"){
                    alert("Entreprise refuse")
                }
            });
    
        });

        await sleep(1000);
        location.reload(); 
    }
 
})