function listNotificationsOfConnectedUser() {
    return fetch('/api/notifications/findAll.php', {
        method: 'GET',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(data => {
        return data.json()
    });
}

function deleteNotificationsByUserMail(userMail) {
    return fetch('/api/notifications/delete.php?mail=' + userMail, {
        method: 'DELETE',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(data => {
        return data.json()
    })
}

