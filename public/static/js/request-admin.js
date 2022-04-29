function banUser() {
    fetch('/api/user-api.php?token=' + localStorage.getItem("token"), {
        method: 'POST',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(response => {
        return response
    });
}