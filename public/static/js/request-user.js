function getAllUsers() {
    fetch('/api/user-api.php', {
        method: 'GET',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(response => {
        return response.json();
    }).then(res => displayAllUsers(res));
}

function displayAllUsers(users) {
    let usersHTML = "";
    if (users.length) {
        users.forEach(user => {
            usersHTML += userListTemplateInformation(user);
        });
    } else {
        usersHTML = noResultContent("Vous n'avez pas d'utilisateurs");
    }
    document.getElementsByClassName('all-users-container')[0].innerHTML = usersHTML;
}

/*function getUser() {
    fetch('/api/user-api.php', {
        method: 'GET',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(response => {
        return response.json();
    }).then(res => displayUserProfile(res));
}*/

function displayUserProfile(user) {
    let userHTML = "";
    if (user != null) {
        userHTML += userProfileTemplateAllInformation(user);
    } else {
        userHTML = noResultContent("Vous n'avez pas d'utilisateur");
    }
    document.getElementsByClassName('user-profile-container')[0].innerHTML = userHTML;
}