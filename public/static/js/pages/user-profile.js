function getUser(email) {
    checkAuth()
        .then(user => {
            if (user == null) {
                document.location.href = "/index.php";
            }
            add_structure(user);
            getUserByMail(email).then(res => displayUserProfile(res));
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