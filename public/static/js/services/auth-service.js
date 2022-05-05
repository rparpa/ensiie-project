function checkAuth() {
    return fetch('/api/auth/check-token.php?token=' + localStorage.getItem('token'))
        .then(response => response.json());
}