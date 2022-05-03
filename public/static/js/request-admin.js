function getAllTrocs() {
    fetch('/api/trocs/findAll.php', {
        method: 'GET',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(response => {
        return response.json();
    }).then(res => displaySwaps(res));
}

function getAllCategories() {
    fetch('/api/category-api.php', {
        method: 'GET',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(response => {
        return response.json();
    }).then(res => displayAllCategories(res)); // PAS DISPLAY SWAP QU IL FAUT UTILISER
}

function displayAllCategories(categories) {
    let categoriesHTML = "";
    if (categories.length) {
        categories.forEach(category => {
            categoriesHTML += templateAllCategories(category);
        });
    } else {
        categoriesHTML += noResultContent("Il n'y a pas de trocs en cours");
    }
    document.getElementsByClassName('all-categories-container')[0].innerHTML = categoriesHTML;
}

function banUser(email) {
    fetch('/api/user-api.php?email=' + email, {
        method: 'POST',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(response => {
        return response.json();
    });
}
