function checkAuth() {
    return fetch('/api/auth-api.php?token=' + localStorage.getItem('token'),
        {
            method: 'GET'
        })
        .then(response => response.json());
}