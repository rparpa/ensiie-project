function getAllUsers() {
    checkAuth()
        .then(response => {
            return response.json();
        })
        .then(user => {
            if (user == null) {
                document.location.href = "/index.php";
            }
            add_structure(user);
            fetch('/api/user-api.php', {
                method: 'GET',
                headers: {
                    'Authorization': localStorage.getItem('token')
                }
            }).then(response => {
                return response.json();
            }).then(res => displayAllUsers(res));
        })
}

function displayAllUsers(users) {
    let usersHTML = "";
    console.log(users);
    if (users.length) {
        users.forEach(user => {
            usersHTML += userListTemplateInformation(user);
        });
    } else {
        usersHTML = noResultContent("Vous n'avez pas d'utilisateurs");
    }
    document.getElementsByClassName('all-users-container')[0].innerHTML = usersHTML;
}

function getUser(email) {
    checkAuth()
        .then(response => {
            return response.json();
        })
        .then(user => {
            if (user == null) {
                document.location.href = "/index.php";
            }
            add_structure(user);
            fetch('/api/user-api.php?email=' + email, {
                method: 'GET'
            }).then(response => {
                return response.json();
            }).then(res => displayUserProfile(res));
        })
}

function displayUserProfile(user) {
    // On reçoit le bon user
    let userHTML = "";
    if (user != null) {
        userHTML = userProfileTemplateAllInformation(user); // Renvoie le bon template pour le profil, avec les bonnes données
    } else {
        userHTML = noResultContent("Vous n'avez pas d'utilisateur");
    }
    document.getElementsByClassName('user-profile-container')[0].innerHTML = userHTML;
}