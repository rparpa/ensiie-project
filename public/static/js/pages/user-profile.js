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
    let userHTML = "";
    if (user != null) {
        userHTML = userProfileTemplateAllInformation(user);
    } else {
        userHTML = noResultContent("Vous n'avez pas d'utilisateur");
    }
    document.getElementsByClassName('user-profile-container')[0].innerHTML = userHTML;
}