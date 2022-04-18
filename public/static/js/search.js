


function search() {
    let categoriesSelectedString = getValueItemsSelected();
    categoriesSelectedString = categoriesSelectedString.substring(0, categoriesSelectedString.length - 1);
    console.log(categoriesSelectedString);
    let query = '/api/objets/search.php?';
    if (categoriesSelectedString != '') {
        query += 'categories=' + categoriesSelectedString + '&';
    }
    if (document.getElementById('search-name').value != '') {
        query += 'name=' + document.getElementById('search-name').value + '&';
    }
    query = query.substring(0, query.length - 1);
    fetch(query).then(data => {
        return data.json()
    }).then(res => displayFoundItems(res));
}

function displayFoundItems(items) {
    let resultHTML = "";
    if (items.length) {
        resultHTML += "<span class='number-result'>" + escapeHtml(items.length) + " objet(s) trouvé(s) </span>";
        resultHTML += "<section class='item-list'>";
        items.forEach(item => {
            resultHTML += "<a class='item-link' href='objet.php?id=" + escapeHtml(item['id']) + "'>";
            resultHTML += "<img src='/images/items/" + escapeHtml(item['picture']) + "'/>";
            resultHTML += "<div class='information'>";
            resultHTML += "<h3>" + escapeHtml(item['name']) + "</h3>";
            resultHTML += "<span class='date'>Date d'ajout: " + escapeHtml(item['creation_date']) + "</span>";
            resultHTML += "<div class='categories'>"
            item['categories'].forEach(category => {
                resultHTML += "<span class='category'>" + escapeHtml(category['name']) + "</span>";
            });
            resultHTML += "</div>";
            resultHTML += "</div>";
            resultHTML += "<div class='user'>";
            resultHTML += "<img src='../static/assets/zoro.jpg'/>";
            resultHTML += "<span>" + escapeHtml(item['proprietary']) + "</span>";
            resultHTML += "</div>";
            resultHTML += "</a>";
        });
        resultHTML += "</section>";
    } else {
        resultHTML += noResultContent("Il n'y a pas d'objets correspondants à votre recherche");
    }
    document.getElementById('results').innerHTML = resultHTML;
    applyCategoriesColor();
}

function clearResults() {
    document.getElementById('results').innerHTML = '';
}
