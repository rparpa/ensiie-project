function listCategories() {
    return fetch('/api/category-api.php', {
        method: 'GET',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(response => {
        return response.json();
    })
}

function createCategory(category) {
    return fetch('/api/category-api.php', {
        headers: {
            'Authorization': localStorage.getItem('token'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        method: 'POST',
        body: JSON.stringify(category)
    })
}