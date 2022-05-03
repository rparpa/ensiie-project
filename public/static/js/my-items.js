window.onload = loadItems;

function loadItems() {
    checkAuth()
        .then(response => {
            return response.json();
        })
        .then(user => {
            if (user == null) {
                document.location.href = "/index.php";
            } else {
                add_structure(user);
                fetch('/api/objets/findAll.php', {
                    method: 'GET',
                    headers: {
                        'Authorization': localStorage.getItem('token')
                    }
                }).then(data => {
                    return data.json()
                }).then(res => displayItems(res?.filter(it => it['is_swappable'])));
            }
        });

}

function displayItems(items) {
    let itemsHTML = "";
    if (items.length) {
        items.forEach(item => {
            itemsHTML += itemTemplateAllInformation(item);
        });
    } else {
        itemsHTML += noResultContent("Vous n'avez pas d'objets");
        document.getElementById('items-container').classList.remove('grid');
    }
    document.getElementById('items-container').innerHTML = itemsHTML;
    applyCategoriesColor();
}

function deleteItem(idItem) {
    fetch('/api/objets/delete.php?id=' + idItem, {
        method: 'DELETE'
    }).then(() => {
        loadItems();
    });
}