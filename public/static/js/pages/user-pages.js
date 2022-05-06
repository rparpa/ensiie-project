function getAllUsers() {
    checkAuth()
        .then(user => {
            if (user == null || user['is_banned']) {
                document.location.href = "/index.php";
            } else if (!user['is_super_user']) {
                document.location.href = "/user-pages/accueil.php";
            }
            add_structure(user);
            listUsers().then(res => displayAllUsers(res));
        })
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

