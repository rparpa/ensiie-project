// Détection du support
if(localStorage.getItem('id') == "1" || localStorage.getItem('id') == "2") {
    document.getElementById("navbarDropdown").style.display = "block";
}
if(localStorage.getItem('id') == "1") {
    document.getElementById("contribution").style.display = "none";
    document.getElementById("MonCV").style.display = "none";
}
else if (localStorage.getItem('id') == "2") {
    document.getElementById("offres").style.display = "none";
    document.getElementById("AdrSiege").style.display = "none";
}

$("input[type=file]").change(function (e){$(this).next('.custom-file-label').text(e.target.files[0].name);})

const appConfig = require('../../app.config');
const ParticulierService = require('../Api/ParticulierApi');
const HttpClient = require('./HttpClient');


const Particulier = require('../../src/Model/Entity/Particulier');

const httpClient = new HttpClient(appConfig.apiUrl);

const particulierService = new ParticulierService(httpClient);

particulierService.getProfil(localStorage.getItem('id')).then(particuliers => {
    particuliers.forEach((particulier) => {
    document.getElementById('telephone').innerHTML = particulier.telephone;
    document.getElementById('email').innerHTML = particulier.adresseMail;
    document.getElementById('mdp').innerHTML = particulier.motDePasse;
    document.getElementById('nomfichier').innerHTML = particulier.cv;
    })
});

//Edit on click
$('#EmailModal').on('show.bs.modal', function (event) {
    
    var modal = $(this)

    document.getElementById('btn-edit-email').onclick = function(){  

        var error = "false"
        
        if(document.getElementById('exampleInputEmail').value === '') {
            alert('Impossible de modifier l email sans nom')
            error = "true"
    
        }
        if (document.getElementById('exampleInputEmail2').value === '') {
            alert('Impossible de modifier l email sans nom')
            error = "true"
        }
        if (document.getElementById('exampleInputEmail2').value != document.getElementById('exampleInputEmail').value) {
            alert('Les deux valeurs saisies sont differentes')
            error = "true"
        }
        if (error === "false") {
            
            particulierService.editProfilEmail(localStorage.getItem('id')).then(particuliers => {
                particuliers.forEach((particulier) => {
                    document.getElementById('telephone').innerHTML = particulier.telephone;
                    document.getElementById('email').innerHTML = particulier.adresseMail;
                    document.getElementById('mdp').innerHTML = particulier.motDePasse;
                    document.getElementById('nomfichier').innerHTML = particulier.cv;
                })
            });
            $('#EmailModal').hide();
            $('.modal-backdrop').hide();
        }

    }
 
})

//Edit on click
$('#MdpModal').on('show.bs.modal', function (event) {
    
    var modal = $(this)

    document.getElementById('btn-edit-mdp').onclick = function(){  

        var error = "false"
        
        if(document.getElementById('exampleInputMdp').value === '') {
            alert('Impossible de modifier le mdp')
            error = "true"
    
        }
        if (document.getElementById('exampleInputMdp2').value === '') {
            alert('Impossible de modifier le mdp')
            error = "true"
        }
        if (document.getElementById('exampleInputMdp2').value != document.getElementById('exampleInputMdp').value) {
            alert('Les deux valeurs saisies sont differentes')
            error = "true"
        }
        if (error === "false") {
            
            particulierService.editProfilMdp(localStorage.getItem('id')).then(particuliers => {
                particuliers.forEach((particulier) => {
                    document.getElementById('telephone').innerHTML = particulier.telephone;
                    document.getElementById('email').innerHTML = particulier.adresseMail;
                    document.getElementById('mdp').innerHTML = particulier.motDePasse;
                    document.getElementById('nomfichier').innerHTML = particulier.cv;
                })
            });
            $('#MdpModal').hide();
            $('.modal-backdrop').hide();
        }

    }
 
})

//Edit on click
$('#TelephoneModal').on('show.bs.modal', function (event) {
    
    var modal = $(this)

    document.getElementById('btn-edit-telephone').onclick = function(){  

        var error = "false"
        
        if(document.getElementById('exampleInputTelephone').value === '') {
            alert('Impossible de modifier le numero de telephone')
            error = "true"
    
        }
        if (document.getElementById('exampleInputTelephone2').value === '') {
            alert('Impossible de modifier le numero de telephone')
            error = "true"
        }

        if (document.getElementById('exampleInputTelephone2').value !== document.getElementById('exampleInputTelephone').value) {
            alert('Les deux valeurs saisies sont differentes')
            error = "true"
        }

        if (error === "false") {
            
            particulierService.editProfilTelephone(localStorage.getItem('id')).then(particuliers => {
                particuliers.forEach((particulier) => {
                    document.getElementById('telephone').innerHTML = particulier.telephone;
                    document.getElementById('email').innerHTML = particulier.adresseMail;
                    document.getElementById('mdp').innerHTML = particulier.motDePasse;
                    document.getElementById('nomfichier').innerHTML = particulier.cv;
                })
            });
            $('#TelephoneModal').hide();
            $('.modal-backdrop').hide();
        }

    }
 
})


document.getElementById('btn-edit-cv').onclick = function(){  

    var error = "false"
    
    if(document.getElementById('nomfichier').value === '') {
        alert('Impossible d upload le fichier')
        error = "true"

    }

    if (error === "false") {
        
        particulierService.editProfilCV(localStorage.getItem('id')).then(particuliers => {
            particuliers.forEach((particulier) => {
                document.getElementById('telephone').innerHTML = particulier.telephone;
                document.getElementById('email').innerHTML = particulier.adresseMail;
                document.getElementById('mdp').innerHTML = particulier.motDePasse;
                document.getElementById('nomfichier').innerHTML = particulier.cv;
            })
        });

    }

}
 
