function getAllTrocs() {
    checkAuth()
        .then(response => {
            return response.json();
        })
        .then(user => {
            if (user == null) {
                document.location.href = "/index.php";
            }
            add_structure(user);
            fetch('/api/trocs/findAll.php', {
                method: 'GET',
                headers: {
                    'Authorization': localStorage.getItem('token')
                }
            }).then(response => {
                return response.json();
            }).then(res => displaySwaps(res));
        });
}

function getAllCategories() {
    checkAuth()
        .then(response => {
            return response.json();
        })
        .then(user => {
            if (user == null) {
                document.location.href = "/index.php";
            }
            add_structure(user);
            fetch('/api/category-api.php', {
                method: 'GET',
                headers: {
                    'Authorization': localStorage.getItem('token')
                }
            }).then(response => {
                return response.json();
            }).then(res => displayAllCategories(res));
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
        .then(response => {
            return response.json();
        })
        .then(user => {
            if (user == null) {
                document.location.href = "/index.php";
            }
            add_structure(user);
            fetch('/api/category-api.php', {
                headers: {
                    'Authorization': localStorage.getItem('token'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                method: 'POST',
                body: JSON.stringify(data)
            }).then(response => {
                window.location.reload();
                return response.json();
            });
        })
}

function banUser(email) {
    checkAuth()
        .then(response => {
            return response.json();
        })
        .then(user => {
            if (user == null) {
                document.location.href = "/index.php";
            }
            add_structure(user);
            if (user['is_super_user']) {
                fetch('/api/user-api.php?email=' + email, {
                    method: 'POST',
                    headers: {
                        'Authorization': localStorage.getItem('token')
                    }
                }).then(response => {
                    return response.json();
                });
            }
        });
}
