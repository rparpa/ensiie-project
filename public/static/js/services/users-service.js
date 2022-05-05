function listUsers() {
    return fetch('/api/user-api.php', {
        method: 'GET',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(response => {
        return response.json();
    });
}

function getUserByMail(email) {
    return fetch('/api/user-api.php?email=' + email, {
        method: 'GET'
    }).then(response => {
        return response.json();
    })
}

function updateUserToBlock(email) {
    let data = {"lockEmail": email};
    return fetch('/api/user-api.php', {
        method: 'POST',
        headers: {
            'Authorization': localStorage.getItem('token'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(response => {
        return response.body;
    })
}