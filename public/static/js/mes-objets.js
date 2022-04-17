window.onload = loadItems;

function loadItems() {
    fetch('/api/objets/findAll.php').then(data => {
        return data.json()
    }).then(res => displayItems(res));
}

function displayItems(items) {
    console.log(items);
    let itemsHTML = "";
    items.forEach(item => {
        itemsHTML += "<div class='item'> " +
            "<button class='delete' onclick='deleteItem(" + escapeHtml(item['id']) + ")'>" +
            "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'> " +
            "<path d='M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z'/>\n" +
            "</svg>" +
            "</button>" +
            "<div class='image'>" +
            "<img class='logo' src='/images/items/" + escapeHtml(item['picture']) + "'/>" +
            "<div class='categories' id='cat-container'>";
        item['categories'].forEach(category => {
            itemsHTML += "<span class='category'>" + escapeHtml(category['name']) + "</span>";
        });
        itemsHTML += "</div>";
        itemsHTML += "</div>";
        itemsHTML += "<div class='information'>";
        itemsHTML += "<h3>" + escapeHtml(item['name']) + "</h3>";
        itemsHTML += "<span class='date'>Date d'ajout: " + escapeHtml(item['creation_date']) + "</span>";
        itemsHTML += "<p>" + escapeHtml(item['description']) + "</p>";
        itemsHTML += "</div>";
        itemsHTML += "</div>";
    });
    document.getElementById('items-container').innerHTML = itemsHTML;
    const categories = document.getElementsByClassName('category');
    for (let i = 0; i < categories.length; i++) {
        categories[i].style.borderColor = getColorOfCategory(categories[i].firstChild.nodeValue);
    }
}

function deleteItem(idItem) {
    fetch('/api/objets/delete.php?id=' + idItem, {
        method: 'DELETE'
    }).then(data => {
        loadItems();
    });
}