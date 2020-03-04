const appConfig = require('../../app.config');
const OffreService = require('../Api/OffreApi');
const UserService = require('../Api/UserApi');
const PostulerService = require('../Api/PostulerApi');
const HttpClient = require('./HttpClient');


const Offre = require('../../src/Model/Entity/Offre');

const httpClient = new HttpClient(appConfig.apiUrl);

const offreService = new OffreService(httpClient);
const userService = new UserService(httpClient);
const postulerService = new PostulerService(httpClient);

document.getElementById('btnChercher').onclick = function() {

    offreService.getOffres(
        document.getElementById('exampleInputJobs').value,
        document.getElementById('exampleInputLocation').value,
        document.getElementById('inputContrat').value,
        document.getElementById('inputSalaire').value,
        document.getElementById('inputDate').value,
        document.getElementById('inputDistance').value
    ).then(offres => {
        let html =''
        offres.forEach((offre) => {
            html += OffreHtml(offre.id,offre.titre,offre.description,offre.document,offre.typeContrat,offre.adresse, offre.salaire,offre.dateParution);
        });
            
        document.getElementById('lesOffres').innerHTML = html;
    });
}

document.getElementById('btnConfirmerConnexion').onclick = async function() {

    var error = "false"

    if (document.getElementById('InputEmail1').value === ''){
        alert("Vous devez renseigner une adresse mail")
        error = "true"
    }
    if (document.getElementById('InputPassword1').value === '')
    {
        alert("Vous devez renseigner un mot de passe")
        error = "true"
    }

    if(error==="false") {
        
        userService.logIn(
            document.getElementById('InputEmail1').value,
            document.getElementById('InputPassword1').value,
        ).then( offres => {
            offres.forEach((offre) => {
            });
        });
        await sleep(100);
        location.reload(); 

    }
}


document.getElementById('btnConfirmerInscription').onclick = async function() {

    var error = "false"

    if (document.getElementById('inputNom').value === ''){
        alert("Vous devez renseigner un nom")
        error = "true"
    }
    if (document.getElementById('inputEmail4').value === '')
    {
        alert("Vous devez renseigner une adresse mail")
        error = "true"
    }
    if (document.getElementById('inputPassword4').value === '')
    {
        alert("Vous devez renseigner un mot de passe")
        error = "true"
    }

    if (document.getElementById('inlineRadioParticulier').checked && document.getElementById('inputPrenom').value === '') {
        alert("Vous devez renseigner un prenom")
        error = "true"
    }

    //alert(error)

    if(error==="false") {

        if(document.getElementById('inlineRadioParticulier').checked) {

            userService.signUp(
                document.getElementById('inputNom').value,
                document.getElementById('inputPrenom').value,
                document.getElementById('inputEmail4').value,
                document.getElementById('inputPassword4').value
            ).then( offres => {
                offres.forEach((offre) => {
                });
            });
            await sleep(100);
            location.reload(); 
        }
        else {
            userService.signUp(
                document.getElementById('inputNom').value,
                document.getElementById('inputPrenom').value,
                "",
                document.getElementById('inputPassword4').value
            ).then( offres => {
                offres.forEach((offre) => {
                });
            });
            await sleep(100);
            location.reload(); 

        }

    }
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}  

$('#postulerModal').on('show.bs.modal', function (event) {
    

    var idOffre = $(event.relatedTarget).attr('data-idOffre')
    var idPersonne = localStorage.getItem('idPersonne');

    document.getElementById('btnPostuler').onclick = async function() {

        if(idPersonne === undefined || idPersonne === "0") {
            alert("Vous devez vous connecter pour pouvoir postuler")
            //Il faut aussi vérifier qu'il a bien renseigné son CV
        }
        else {
            postulerService.postuler(idPersonne,idOffre).then( x => {
                x.forEach((y) => {
                    if(y==="yes"){
                        alert("Votre candidature a bien été déposée")
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
    '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#postulerModal" data-idOffre='+ id + '> Postuler </button>' +
    '</div>' +
    '</div> <br>'

    return html
};
