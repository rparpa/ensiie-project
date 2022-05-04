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
    }).then(res => displayAllCategories(res));
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
    console.log(nameOfCategory);
    let data = {"categoryName": nameOfCategory};
    fetch('/api/category-api.php', {
        headers: {
            'Authorization': localStorage.getItem('token')
        },
        method: 'POST',
        body: JSON.stringify(data)
    }).then(response => {
        window.location.reload();
        return response.json();
    })
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
