function listItemsOfUser() {
    return fetch('/api/items.php', {
        method: 'GET',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(data => {
        return data.json()
    });
}

function getItemById(id) {
    return fetch('/api/items.php?id=' + id, {
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

function deleteItemById(idItem) {
    return fetch('/api/items.php?id=' + idItem, {
        method: 'DELETE',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    })
}