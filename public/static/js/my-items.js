window.onload = loadItems;

function loadItems() {
    checkAuth()
        .then(response => {
            return response.json();
        })
        .then(isConnected => {
            if (!isConnected) {
                document.location.href = "/index.php";
            } else {
                fetch('/api/objets/findAll.php', {
                    headers: {
                        'Authorization': localStorage.getItem('token')
                    }
                }).then(data => {
                    return data.json()
                }).then(res => displayItems(res));
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