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

document.getElementById('btnCreer').onclick = async function() {

    var error = "false"
    var titre = document.getElementById('inputTitre').value
    var description = document.getElementById('inputDescription').value
    var typeContrat = document.getElementById('inputContrat').value
    var salaire = document.getElementById('inputSalaire').value
    var dateParution = document.getElementById('inputDateParution').value
    var adresse = document.getElementById('inputAdresseSiege').value
    var doc = document.getElementById('exampleFormControlFile1').files[1]

    //alert (titre + description + typeContrat + salaire + dateParution + adresse)

    if (titre==='' || description==='' || typeContrat==='' || salaire==='' || dateParution==='' || adresse===''){
        alert('Veuillez remplir tous les champs')
    }
    else {
        offreService.createOffre(titre,description,typeContrat,salaire,dateParution,adresse,doc).then( x => {
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

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
} 