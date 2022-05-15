function checkAuth() {
    return fetch('/api/auth.php?token=' + localStorage.getItem('token'),
        {
            method: 'GET'
        })
        .then(response => response.json());
}