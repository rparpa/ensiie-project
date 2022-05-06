let lookedUser = null;

function getUser(email) {
    checkAuth()
        .then(user => {
            if (user == null) {
                document.location.href = "/index.php";
            }
            add_structure(user);
            getUserByMail(email).then(res => {
                lookedUser = res;
                displayUserProfile(user);
            });
        })
}

function displayUserProfile(myUser) {
    let userHTML = "";
    if (lookedUser != null) {
        userHTML = userProfileTemplateAllInformation(lookedUser, myUser);
    } else {
        userHTML = noResultContent("Vous n'avez pas d'utilisateur");
    }
    document.getElementsByClassName('user-profile-container')[0].innerHTML = userHTML;
}

function lockUnlockUser(email) {
    checkAuth()
        .then(user => {
            if (user == null) {
                document.location.href = "/index.php";
            }
            add_structure(user);
            if (user['is_super_user']) {
                updateUserToBlock(email).then(res => {
                    if (lookedUser != null) {
                        lookedUser = res;
                        document.getElementsByClassName('user-profile-container')[0].innerHTML = "";
                        displayUserProfile(user);
                    }
                });
            }
        });
}