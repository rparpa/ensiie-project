function getAllTrocs() {
    checkAuth()
        .then(user => {
            if (user == null) {
                document.location.href = "/index.php";
            }
            add_structure(user);
            listSwaps().then(res => displaySwaps(res));
        });
}

function getAllCategories() {
    checkAuth()
        .then(user => {
            if (user == null || user['is_banned'] || !user['is_super_user']) {
                document.location.href = "/index.php";
            }
            add_structure(user);
            listCategories().then(res => displayAllCategories(res));
        });
}

function displayAllCategories(categories) {
    let categoriesHTML = "";
    if (categories.length) {
        categories.forEach(category => {
            categoriesHTML += templateAllCategories(category);
        });
    } else {
        categoriesHTML += noResultContent("Il n'y a pas de catégories existantes");
    }
    document.getElementsByClassName('all-categories-container')[0].innerHTML = categoriesHTML;
}

function addCategory(nameOfCategory) {
    let data = {"categoryName": nameOfCategory};
    checkAuth()
        .then(user => {
            if (user == null) {
                document.location.href = "/index.php";
            }
            add_structure(user);
            createCategory(data).then(response => {
                window.location.reload();
                return response.json();
            });
        })
}

function lockUnlockUser(email) {
    checkAuth()
        .then(user => {
            if (user == null) {
                document.location.href = "/index.php";
            }
            add_structure(user);
            if (user['is_super_user']) {
                updateUserToBlock(email).then(res => console.log(res));
            }
        });
}
