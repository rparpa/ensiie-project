window.onload = loadPage;

function loadPage() {
    checkAuth()
        .then(user => {
            if (user == null) {
                document.location.href = "/index.php";
            }
            add_structure(user);
        });
}

function search() {
    let categoriesSelectedString = getValueCategoriesSelected();
    categoriesSelectedString = categoriesSelectedString.substring(0, categoriesSelectedString.length - 1);
    let query = '/api/objets/search.php?';
    if (categoriesSelectedString != '') {
        query += 'categories=' + categoriesSelectedString + '&';
    }
    if (document.getElementById('search-name').value != '') {
        query += 'name=' + document.getElementById('search-name').value + '&';
    }
    query = query.substring(0, query.length - 1);
    searchItems(query)
        .then(res => displayFoundItems(res?.filter(it => it['is_swappable'])));
}

function displayFoundItems(items) {
    let resultHTML = "";
    if (items.length) {
        resultHTML += "<span class='number-result'>" + escapeHtml(items.length) + " objet(s) trouvé(s) </span>";
        resultHTML += "<section class='grid'>";
        items.forEach(item => {
            resultHTML += itemTemplateShort(item);
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
