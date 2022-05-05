function listItemsOfUser() {
    return fetch('/api/objets/findAll.php', {
        method: 'GET',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(data => {
        return data.json()
    });
}

function getItemById(id) {
    return fetch('/api/item-api.php?id=' + id, {
        method: 'GET',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(data => {
        return data.json();
    })
}

function searchItems(query) {
    return fetch(query, {
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(data => {
        return data.json()
    });
}