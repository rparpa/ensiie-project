function listNotificationsOfConnectedUser() {
    return fetch('/api/notifications.php', {
        method: 'GET',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(data => {
        return data.json()
    });
}

function deleteNotificationsByUserMail(userMail) {
    return fetch('/api/notifications.php?mail=' + userMail, {
        method: 'DELETE',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(data => {
        return data.json()
    })
}

