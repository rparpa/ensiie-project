const appConfig = require('../../app.config');
const OffreService = require('../Api/OffreApi');
const HttpClient = require('./HttpClient');

const httpClient = new HttpClient(appConfig.apiUrl);

const offreService = new OffreService(httpClient);

// Détection du support
if(localStorage.getItem('id') == "1" || localStorage.getItem('id') == "2") {
    document.getElementById("navbarDropdown").style.display = "block";
}
if(localStorage.getItem('id') == "1") {
    document.getElementById("contribution").style.display = "none";
}
else if (localStorage.getItem('id') == "2") {
    document.getElementById("offres").style.display = "none";
    document.getElementById("AdrSiege").style.display = "none";
}

window.onload = function() {
    
    offreService.getCompanyOffre(localStorage.getItem('idPersonne')).then(offres => {
        let html =''
        offres.forEach((offre) => {
            html += OffreHtml(offre.id,offre.titre,offre.description,offre.document,offre.typeContrat,offre.adresse, offre.salaire,offre.dateParution);
        });

        document.getElementById('mesOffres').innerHTML = '<h3 class="modal-title">Mes offres</h3><br>'
            
        document.getElementById('mesOffres').innerHTML += html;
    });
};

document.getElementById('btnCreer').onclick = async function() {

    var error = "false"
    var titre = document.getElementById('inputTitre').value
    var description = document.getElementById('inputDescription').value
    var typeContrat = document.getElementById('inputContrat').value
    var salaire = document.getElementById('inputSalaire').value
    var dateParution = document.getElementById('inputDateParution').value
    var adresse = document.getElementById('inputAdresseSiege').value
    var doc = document.getElementById('exampleFormControlFile1').files[0]

    //alert(doc)

    if (titre==='' || description==='' || typeContrat==='' || salaire==='' || dateParution==='' || adresse===''){
        alert('Veuillez remplir tous les champs')
    }
    else {

        //On met la date en millisecondes
        var date = new Date($('#inputDateParution').val());
        day = date.getDate();
        month = date.getMonth();
        year = date.getFullYear();

        offreService.createOffre(localStorage.getItem('idPersonne'),titre,description,typeContrat,salaire,date.getTime(),adresse,doc).then( x => {
            x.forEach((y) => {
                if(y==="yes"){
                    alert("Votre offre a bien été prise en compte, elle sera traité sous peu")
                }
                else {
                    ("Something went wrong")
                }
            });
    
        });
        
        document.getElementById("formNewOffre").reset();
        await sleep(1000);
        location.reload(); 
    }
}

$('#supprimerOffre').on('show.bs.modal', async function (event) {

    var idOffre = $(event.relatedTarget).attr('data-idOffre')

    document.getElementById('btnSupprimer').onclick = async function() {
        offreService.removeOffre(idOffre).then( x => {
            x.forEach((y) => {
                if(y==="yes"){
                    alert("Votre offre a bien été modifiée")
                }
                else {
                    ("Something went wrong")
                }
            });
    
        });
        
        await sleep(1000);
        location.reload(); 
    }
})

$('#consulterCandidature').on('show.bs.modal',async function (event) {

    var idOffre = $(event.relatedTarget).attr('data-idOffre');

    let html = ''

    offreService.getCandidats(idOffre).then( candidats => {
        
        candidats.forEach((candidat) => {
            html += CandidatHtml(candidat.nom, candidat.prenom, candidat.adresseMail, candidat.telephone);
        });

    });

    await sleep(1000);

    document.getElementById('Candidats').innerHTML += html;

})

$('#modifierModal').on('show.bs.modal', function (event) {
    

    var idOffre = $(event.relatedTarget).attr('data-idOffre')
    var idTitre = $(event.relatedTarget).attr('data-idTitre')
    var idDescription = $(event.relatedTarget).attr('data-idDescription')
    var idTypeContrat = $(event.relatedTarget).attr('data-idTypeContrat')
    var idSalaire = $(event.relatedTarget).attr('data-idSalaire')
    //var idDateParution = $(event.relatedTarget).attr('data-idDateParution')
    var idAdresse = $(event.relatedTarget).attr('data-idAdresse')

    document.getElementById('inputTitreM').value = idTitre
    document.getElementById('inputDescriptionM').value = idDescription
    document.getElementById('inputContratM').value = idTypeContrat
    document.getElementById('inputSalaireM').value = idSalaire
    //manque la date de parution
    document.getElementById('inputAdresseSiegeM').value = idAdresse
    //manque le document

    //On sélectionne le type de contrat déjà renseigné
    var selectElement = document.getElementById('inputContratM');
    var selectOptions = selectElement.options;
    
    for (var opt, j = 0; opt = selectOptions[j]; j++){
        if (opt.value == idTypeContrat) {
            selectElement.selectedIndex = j;
            break;
        }
    }

    document.getElementById('btnModifier').onclick = async function() {
        
        var titre = document.getElementById('inputTitreM').value
        var description = document.getElementById('inputDescriptionM').value
        var typeContrat = document.getElementById('inputContratM').value
        var salaire = document.getElementById('inputSalaireM').value
        var dateParution = document.getElementById('inputDateParutionM').value
        var adresse = document.getElementById('inputAdresseSiegeM').value
        var doc = document.getElementById('exampleFormControlFile1M').files[0]

        if (titre==='' || description==='' || typeContrat==='' || salaire==='' || dateParution==='' || adresse===''){
            alert('Veuillez remplir tous les champs')
        }
        else {
            //On met la date en millisecondes
            var date = new Date($('#inputDateParutionM').val());
            day = date.getDate();
            month = date.getMonth();
            year = date.getFullYear();
            offreService.modifyOffre(idOffre,titre,description,typeContrat,salaire,date.getTime(),adresse,doc).then( x => {
                x.forEach((y) => {
                    if(y==="yes"){
                        alert("Votre offre a bien été modifiée")
                    }
                    else {
                        ("Something went wrong")
                    }
                });
        
            });
            
            await sleep(1000);
            location.reload(); 
        }
    }


 
})

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
} 

OffreHtml = function(id,titre, description, document, typeContrat, adresse, salaire, dateParution) {
    let html =  '<div class="border border-primary rounded">' +
    '<div class="m-3">' +
    '<h3 class="modal-title">' + titre + '</h3>' +
    '<div class="badge badge-primary text-wrap" style="width: 6rem;">' + typeContrat + '</div>' +
    '<div class="m-3 badge badge-primary text-wrap" style="width: 6rem;">' + salaire + '</div>' +
    '<div class="badge badge-primary text-wrap" style="width: 6rem;">' + dateParution + '</div> <br> ' +
    '<p class="text-sm-left">' + description + '</p>' +
    '<p class="font-weight-light text-sm-left"> Adresse : ' + adresse + '</p>' +
    '<p class="font-weight-light text-sm-left"> Document : ' + document + '</p>' +
    '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modifierModal" data-idOffre='+ id + ' data-idTitre="'+ titre + '" data-idDescription="'+ description + '" data-idTypeContrat="'+ typeContrat + '" data-idSalaire='+ salaire + ' data-idDateParution="'+ dateParution + '" data-idAdresse="'+ adresse + '"> Modifier </button>' +
    '<button type="button" class="m-3 btn btn-primary" data-toggle="modal" data-target="#supprimerOffre" data-idOffre='+ id + '> Supprimer </button>' +
    '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#consulterCandidature" data-idOffre='+ id + '> Consulter les candidatures </button>' +
    '</div>' +
    '</div> <br>'

    return html
};

CandidatHtml = function(nom, prenom, mail, telephone) {
    let html =  '<div class="border border-primary rounded">' +
    '<div class="m-3">' +
    '<h2 class="modal-title">' + nom + " " + prenom + '</h2>' +
    '<div class="badge badge-primary text-wrap">' + mail + '</div>' +
    '<div class="m-3 badge badge-primary text-wrap">' + telephone + '</div>' +
    '</div>' +
    '</div> <br>'

    return html
};