function listNotificationsOfConnectedUser() {
    return fetch('/api/notification-api.php', {
        method: 'GET',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(data => {
        return data.json()
    });
}

function deleteNotificationsByUserMail(userMail) {
    return fetch('/api/notification-api.php?mail=' + userMail, {
        method: 'DELETE',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(data => {
        return data.json()
    })
}

