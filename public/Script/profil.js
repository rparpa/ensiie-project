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

$("input[type=file]").change(function (e){$(this).next('.custom-file-label').text(e.target.files[0].name);})



if(localStorage.getItem('id') == "2"){
    document.getElementById("list-particulier").style.display = "none";
    document.getElementById("list-entreprise").style.display = "block";
}else if(localStorage.getItem('id') == "1"){
    document.getElementById("list-particulier").style.display = "block";
    document.getElementById("list-entreprise").style.display = "none";
}
  



const appConfig = require('../../app.config');
const ParticulierService = require('../Api/ParticulierApi');
const EntrepriseService = require('../Api/EntrepriseApi');
const HttpClient = require('./HttpClient');


const Particulier = require('../../src/Model/Entity/Particulier');
const Entreprise = require('../../src/Model/Entity/Entreprise');

const httpClient = new HttpClient(appConfig.apiUrl);

const particulierService = new ParticulierService(httpClient);
const entrepriseService = new EntrepriseService(httpClient);


if(localStorage.getItem('id') == "1"){
    particulierService.getProfil(localStorage.getItem('id')).then(particuliers => {
        particuliers.forEach((particulier) => {
            document.getElementById('nom').innerHTML = particulier.nom;
            document.getElementById('prenom').innerHTML = particulier.prenom;
            document.getElementById('adresseDomi').innerHTML = particulier.adresseDomicile;
            document.getElementById('telephone').innerHTML = particulier.telephone;
            document.getElementById('email').innerHTML = particulier.adresseMail;
            document.getElementById('mdp').innerHTML = particulier.motDePasse;
            document.getElementById('nomfichier').innerHTML = particulier.cv;
        })
    });
}
else if(localStorage.getItem('id') == "2"){
    entrepriseService.getProfil(localStorage.getItem('id')).then(entreprises => {
        entreprises.forEach((entreprise) => {
            document.getElementById('telephoneE').innerHTML = entreprise.telephone;
            document.getElementById('emailE').innerHTML = entreprise.adresseMail;
            document.getElementById('mdpE').innerHTML = entreprise.motDePasse;
            document.getElementById('nomfichierLogo').innerHTML = entreprise.logo;
            document.getElementById('nomE').innerHTML = entreprise.nom;
            document.getElementById('adresseE').innerHTML = entreprise.adresseSiege;
        })
    });
}

//Edit on click
$('#NomModal').on('show.bs.modal', function (event) {
    
    var modal = $(this)

    document.getElementById('btn-edit-nom').onclick = function(){  

        var error = "false"
        
        if(document.getElementById('exampleInputNom').value === '') {
            alert('Impossible de modifier le nom')
            error = "true"
    
        }
        if (document.getElementById('exampleInputNom').value === '') {
            alert('Impossible de modifier le nom')
            error = "true"
        }
        if (document.getElementById('exampleInputNom2').value != document.getElementById('exampleInputNom').value) {
            alert('Les deux valeurs saisies sont differentes')
            error = "true"
        }
        if (error === "false") {
            
            particulierService.editProfilEmail(localStorage.getItem('id'),document.getElementById('exampleInputNom').value).then(particuliers => {
                particuliers.forEach((particulier) => {

                    document.getElementById('nom').innerHTML = particulier.nom;
                    document.getElementById('prenom').innerHTML = particulier.prenom;
                    document.getElementById('adresseDomi').innerHTML = particulier.adresseDomicile;
                    document.getElementById('telephone').innerHTML = particulier.telephone;
                    document.getElementById('email').innerHTML = particulier.adresseMail;
                    document.getElementById('mdp').innerHTML = particulier.motDePasse;
                    document.getElementById('nomfichier').innerHTML = particulier.cv;
                })
            });
            $('#NomModal').hide();
            $('.modal-backdrop').hide();
        }

    }
 
})

//Edit on click
$('#PrenomModal').on('show.bs.modal', function (event) {
    
    var modal = $(this)

    document.getElementById('btn-edit-prenom').onclick = function(){  

        var error = "false"
        
        if(document.getElementById('exampleInputPrenom').value === '') {
            alert('Impossible de modifier le prenom')
            error = "true"
    
        }
        if (document.getElementById('exampleInputPrenom2').value === '') {
            alert('Impossible de modifier le prenom')
            error = "true"
        }
        if (document.getElementById('exampleInputPrenom2').value != document.getElementById('exampleInputPrenom').value) {
            alert('Les deux valeurs saisies sont differentes')
            error = "true"
        }
        if (error === "false") {
            
            particulierService.editProfilEmail(localStorage.getItem('id'),document.getElementById('exampleInputPrenom').value).then(particuliers => {
                particuliers.forEach((particulier) => {
                    document.getElementById('nom').innerHTML = particulier.nom;
                    document.getElementById('prenom').innerHTML = particulier.prenom;
                    document.getElementById('adresseDomi').innerHTML = particulier.adresseDomicile;
                    document.getElementById('telephone').innerHTML = particulier.telephone;
                    document.getElementById('email').innerHTML = particulier.adresseMail;
                    document.getElementById('mdp').innerHTML = particulier.motDePasse;
                    document.getElementById('nomfichier').innerHTML = particulier.cv;
                })
            });
            $('#PrenomModal').hide();
            $('.modal-backdrop').hide();
        }

    }
 
})


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
            
            particulierService.editProfilEmail(localStorage.getItem('id'),document.getElementById('exampleInputEmail').value).then(particuliers => {
                particuliers.forEach((particulier) => {
                    document.getElementById('nom').innerHTML = particulier.nom;
                    document.getElementById('prenom').innerHTML = particulier.prenom;
                    document.getElementById('adresseDomi').innerHTML = particulier.adresseDomicile;
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
            
            particulierService.editProfilMdp(localStorage.getItem('id'),document.getElementById('exampleInputMdp').value).then(particuliers => {
                particuliers.forEach((particulier) => {
                    document.getElementById('nom').innerHTML = particulier.nom;
                    document.getElementById('prenom').innerHTML = particulier.prenom;
                    document.getElementById('adresseDomi').innerHTML = particulier.adresseDomicile;
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
            
            particulierService.editProfilTelephone(localStorage.getItem('id'),document.getElementById('exampleInputTelephone').value).then(particuliers => {
                particuliers.forEach((particulier) => {
                    document.getElementById('nom').innerHTML = particulier.nom;
                    document.getElementById('prenom').innerHTML = particulier.prenom;
                    document.getElementById('adresseDomi').innerHTML = particulier.adresseDomicile;
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

//Edit on click
$('#AdresseDomiModal').on('show.bs.modal', function (event) {
    
    var modal = $(this)

    document.getElementById('btn-edit-adresseDomi').onclick = function(){  

        var error = "false"
        
        if(document.getElementById('exampleInputAdresseDomi').value === '') {
            alert('Impossible de modifier l adresse')
            error = "true"
    
        }
        if (document.getElementById('exampleInputAdresseDomi2').value === '') {
            alert('Impossible de modifier l adresse')
            error = "true"
        }

        if (document.getElementById('exampleInputAdresseDomi2').value !== document.getElementById('exampleInputAdresseDomi').value) {
            alert('Les deux valeurs saisies sont differentes')
            error = "true"
        }

        if (error === "false") {
            
            particulierService.editProfilTelephone(localStorage.getItem('id'),document.getElementById('exampleInputAdresseDomi').value).then(particuliers => {
                particuliers.forEach((particulier) => {
                    document.getElementById('nom').innerHTML = particulier.nom;
                    document.getElementById('prenom').innerHTML = particulier.prenom;
                    document.getElementById('adresseDomi').innerHTML = particulier.adresseDomicile;
                    document.getElementById('telephone').innerHTML = particulier.telephone;
                    document.getElementById('email').innerHTML = particulier.adresseMail;
                    document.getElementById('mdp').innerHTML = particulier.motDePasse;
                    document.getElementById('nomfichier').innerHTML = particulier.cv;
                })
            });
            $('#AdresseDomiModal').hide();
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
        
        particulierService.editProfilCV(localStorage.getItem('id'),document.getElementById('nomfichier').value).then(particuliers => {
            particuliers.forEach((particulier) => {
                document.getElementById('nom').innerHTML = particulier.nom;
                    document.getElementById('prenom').innerHTML = particulier.prenom;
                    document.getElementById('adresseDomi').innerHTML = particulier.adresseDomicile;
                    document.getElementById('telephone').innerHTML = particulier.telephone;
                    document.getElementById('email').innerHTML = particulier.adresseMail;
                    document.getElementById('mdp').innerHTML = particulier.motDePasse;
                    document.getElementById('nomfichier').innerHTML = particulier.cv;
            })
        });

    }

}
 
/////////////////////////////////////////////////////////////////////////////////////////////



























/////////////////////////////////////////////////////////////////////////////////////////////

//Edit on click
$('#NomEModal').on('show.bs.modal', function (event) {
    
    var modal = $(this)

    document.getElementById('btn-edit-nomE').onclick = function(){  

        var error = "false"
        
        if(document.getElementById('exampleInputNomE').value === '') {
            alert('Impossible de modifier le nom')
            error = "true"
    
        }
        if (document.getElementById('exampleInputNomE2').value === '') {
            alert('Impossible de modifier le nom')
            error = "true"
        }

        if (document.getElementById('exampleInputNomE2').value !== document.getElementById('exampleInputNomE').value) {
            alert('Les deux valeurs saisies sont differentes')
            error = "true"
        }

        if (error === "false") {
            
            entrepriseService.editProfilNomSiege(localStorage.getItem('id'),document.getElementById('exampleInputNomE').value).then(particuliers => {
                particuliers.forEach((particulier) => {
                    document.getElementById('nomE').innerHTML = particulier.nom;
                    document.getElementById('adresseE').innerHTML = particulier.adresseDomicile;
                    document.getElementById('telephoneE').innerHTML = particulier.telephone;
                    document.getElementById('emailE').innerHTML = particulier.adresseMail;
                    document.getElementById('mdpE').innerHTML = particulier.motDePasse;
                    document.getElementById('nomfichierLogo').innerHTML = particulier.cv;
                })
            });
            $('#NomEModal').hide();
            $('.modal-backdrop').hide();
        }

    }
 
})

//Edit on click
$('#EmailEModal').on('show.bs.modal', function (event) {
    
    var modal = $(this)

    document.getElementById('btn-edit-emailE').onclick = function(){  

        var error = "false"
        
        if(document.getElementById('exampleInputEmailE').value === '') {
            alert('Impossible de modifier l email')
            error = "true"
    
        }
        if (document.getElementById('exampleInputEmailE2').value === '') {
            alert('Impossible de modifier l email')
            error = "true"
        }

        if (document.getElementById('exampleInputEmailE2').value !== document.getElementById('exampleInputEmailE').value) {
            alert('Les deux valeurs saisies sont differentes')
            error = "true"
        }

        if (error === "false") {
            
            entrepriseService.editProfilEmail(localStorage.getItem('id'),document.getElementById('exampleInputEmailE').value).then(particuliers => {
                particuliers.forEach((particulier) => {
                    document.getElementById('nomE').innerHTML = particulier.nom;
                    document.getElementById('adresseE').innerHTML = particulier.adresseDomicile;
                    document.getElementById('telephoneE').innerHTML = particulier.telephone;
                    document.getElementById('emailE').innerHTML = particulier.adresseMail;
                    document.getElementById('mdpE').innerHTML = particulier.motDePasse;
                    document.getElementById('nomfichierLogo').innerHTML = particulier.cv;
                })
            });
            $('#EmailEModal').hide();
            $('.modal-backdrop').hide();
        }

    }
 
})

//Edit on click
$('#MdpEModal').on('show.bs.modal', function (event) {
    
    var modal = $(this)

    document.getElementById('btn-edit-mdpE').onclick = function(){  

        var error = "false"
        
        if(document.getElementById('exampleInputMdpE').value === '') {
            alert('Impossible de modifier le mdp')
            error = "true"
    
        }
        if (document.getElementById('exampleInputMdpE2').value === '') {
            alert('Impossible de modifier le mdp')
            error = "true"
        }

        if (document.getElementById('exampleInputMdpE2').value !== document.getElementById('exampleInputMdpE').value) {
            alert('Les deux valeurs saisies sont differentes')
            error = "true"
        }

        if (error === "false") {
            
            entrepriseService.editProfilMdp(localStorage.getItem('id'),document.getElementById('exampleInputMdpE').value).then(particuliers => {
                particuliers.forEach((particulier) => {
                    document.getElementById('nomE').innerHTML = particulier.nom;
                    document.getElementById('adresseE').innerHTML = particulier.adresseDomicile;
                    document.getElementById('telephoneE').innerHTML = particulier.telephone;
                    document.getElementById('emailE').innerHTML = particulier.adresseMail;
                    document.getElementById('mdpE').innerHTML = particulier.motDePasse;
                    document.getElementById('nomfichierLogo').innerHTML = particulier.cv;
                })
            });
            $('#MdpEModal').hide();
            $('.modal-backdrop').hide();
        }

    }
 
})

//Edit on click
$('#AdresseSiegeEModal').on('show.bs.modal', function (event) {
    
    var modal = $(this)

    document.getElementById('btn-edit-adresseE').onclick = function(){  

        var error = "false"
        
        if(document.getElementById('exampleInputAdresseE').value === '') {
            alert('Impossible de modifier l adresse')
            error = "true"
    
        }
        if (document.getElementById('exampleInputAdresseE2').value === '') {
            alert('Impossible de modifier l adresse')
            error = "true"
        }

        if (document.getElementById('exampleInputAdresseE').value !== document.getElementById('exampleInputAdresseE2').value) {
            alert('Les deux valeurs saisies sont differentes')
            error = "true"
        }

        if (error === "false") {
            
            entrepriseService.editProfilAdresseSiege(localStorage.getItem('id'),document.getElementById('exampleInputAdresseE').value).then(particuliers => {
                particuliers.forEach((particulier) => {
                    document.getElementById('nomE').innerHTML = particulier.nom;
                    document.getElementById('adresseE').innerHTML = particulier.adresseDomicile;
                    document.getElementById('telephoneE').innerHTML = particulier.telephone;
                    document.getElementById('emailE').innerHTML = particulier.adresseMail;
                    document.getElementById('mdpE').innerHTML = particulier.motDePasse;
                    document.getElementById('nomfichierLogo').innerHTML = particulier.cv;
                })
            });
            $('#AdresseSiegeEModal').hide();
            $('.modal-backdrop').hide();
        }

    }
 
})

//Edit on click
$('#TelephoneEModal').on('show.bs.modal', function (event) {
    
    var modal = $(this)

    document.getElementById('btn-edit-telephoneE').onclick = function(){  

        var error = "false"
        
        if(document.getElementById('exampleInputTelephoneE').value === '') {
            alert('Impossible de modifier le numero de telephone')
            error = "true"
    
        }
        if (document.getElementById('exampleInputTelephoneE2').value === '') {
            alert('Impossible de modifier le numero de telephone')
            error = "true"
        }

        if (document.getElementById('exampleInputTelephoneE2').value !== document.getElementById('exampleInputTelephoneE').value) {
            alert('Les deux valeurs saisies sont differentes')
            error = "true"
        }

        if (error === "false") {
            
            entrepriseService.editProfilTelephone(localStorage.getItem('id'),document.getElementById('exampleInputTelephoneE').value).then(particuliers => {
                particuliers.forEach((particulier) => {
                    document.getElementById('nomE').innerHTML = particulier.nom;
                    document.getElementById('adresseE').innerHTML = particulier.adresseDomicile;
                    document.getElementById('telephoneE').innerHTML = particulier.telephone;
                    document.getElementById('emailE').innerHTML = particulier.adresseMail;
                    document.getElementById('mdpE').innerHTML = particulier.motDePasse;
                    document.getElementById('nomfichierLogo').innerHTML = particulier.cv;
                })
            });
            $('#TelephoneEModal').hide();
            $('.modal-backdrop').hide();
        }

    }
 
})








document.getElementById('btn-edit-logo').onclick = function(){  

    var error = "false"
    
    if(document.getElementById('nomfichierLogo').value === '') {
        alert('Impossible d upload le fichier')
        error = "true"

    }

    if (error === "false") {
        
        entrepriseService.editProfilLogo(localStorage.getItem('id'),document.getElementById('nomfichierLogo').value).then(entreprises => {
            entreprises.forEach((entreprise) => {
                document.getElementById('nomE').innerHTML = entreprise.nom;
                document.getElementById('adresseE').innerHTML = entreprise.adresseDomicile;
                document.getElementById('telephoneE').innerHTML = entreprise.telephone;
                document.getElementById('emailE').innerHTML = entreprise.adresseMail;
                document.getElementById('mdpE').innerHTML = entreprise.motDePasse;
                document.getElementById('nomfichierLogo').innerHTML = entreprise.logo;
            })
        });

    }

}


