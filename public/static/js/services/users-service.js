function listUsers() {
    return fetch('/api/users.php', {
        method: 'GET',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(response => {
        return response.json();
    });
}

function getUserByMail(email) {
    return fetch('/api/users.php?email=' + email, {
        headers: {
            'Authorization': localStorage.getItem('token')
        },
        method: 'GET'
    }).then(response => {
        return response.json();
    });
}

function updateUserToBlock(email) {
    let data = {"lockEmail": email};
    return fetch('/api/users.php', {
        method: 'POST',
        headers: {
            'Authorization': localStorage.getItem('token'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(response => {
        return response.body;
    });
}