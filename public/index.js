// Détection du support
if(localStorage.getItem('id') == "1" || localStorage.getItem('id') == "2") {
    document.getElementById("navbarDropdown").style.display = "block";
    document.getElementById("connexion").style.display = "none";
    document.getElementById("inscription").style.display = "none";
}
if(localStorage.getItem('id') == "1") {
    document.getElementById("contribution").style.display = "none";
}
else if (localStorage.getItem('id') == "2") {
    document.getElementById("offres").style.display = "none";
}
else {
    document.getElementById("deconnexion").style.display = "none";
}

document.getElementById('btnChercher').onclick = function() {
    alert('Rien pour le moment')
}