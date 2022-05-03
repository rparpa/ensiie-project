function checkAuth() {
    return fetch('/api/auth/check-token.php?token=' + localStorage.getItem('token'));
}

function isAdmin() {
    // Fais une requete getUserStatus puis redirige vers l'accueil si false, sinon redirige vers page admin
}