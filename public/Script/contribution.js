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