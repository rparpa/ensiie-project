window.onload = loadItems;

function loadItems() {
    checkAuth()
        .then(user => {
            if (user == null) {
                document.location.href = "/index.php";
            } else {
                add_structure(user);
                listItemsOfUser().then(res => displayItems(res?.filter(it => it['is_swappable'])));
            }
        });

}

function displayItems(items) {
    let itemsHTML = "";
    if (items.length) {
        items.forEach(item => {
            itemsHTML += itemTemplateAllInformationWithoutUser(item);
        });
    } else {
        itemsHTML += noResultContent("Vous n'avez pas d'objets");
        document.getElementById('items-container').classList.remove('grid');
    }
    document.getElementById('items-container').innerHTML = itemsHTML;
    applyCategoriesColor();
}

function deleteItem(idItem) {
    deleteItemById(idItem).then(() => {
        loadItems();
    });
}