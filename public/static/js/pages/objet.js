window.onload = loadPage;

function loadPage() {
    const urlParams = new URLSearchParams(window.location.search);
    let id = -1;
    id = urlParams.get('id');
    checkAuth()
        .then(user => {
            if (user == null) {
                document.location.href = "/index.php";
            }
            add_structure(user);
            getItemById(id).then(item => {
                listItemsOfUser().then(userItems => {
                    // On enlève le formulaire si notre utilisateur est celui qui possède l'objet
                    if (user['email'] == item['proprietary']['email']) {
                        document.getElementById('form-my-card').remove();
                    } else {
                        add_form(userItems?.filter(it => it['is_swappable']));
                        const items = document.getElementById('button-item-container').getElementsByClassName('item-button');
                        for (let i = 0; i < items.length; i++) {
                            isItemSelectedMap.set(items[i].value, false);
                        }
                    }
                    document.getElementById('grid').innerHTML = templateItemWithAllInformations(item);
                    applyCategoriesColor();
                });
            });
        });
}

isItemSelectedMap = new Map();

function clickItem(buttonCategory) {
    isItemSelectedMap.set(buttonCategory.value, !isItemSelectedMap.get(buttonCategory.value));
    if (isItemSelectedMap.get(buttonCategory.value)) {
        buttonCategory.classList.add('selected');
    } else {
        buttonCategory.classList.remove('selected');
    }
}

function deselectCategories() {
    const items = document.getElementById('button-item-container').getElementsByClassName('item-button');
    for (let i = 0; i < items.length; i++) {
        isItemSelectedMap.set(items[i].value, false);
        items[i].classList.remove('selected');
    }
    document.getElementById('items-selected').value = '';
}

function applyValueItems() {
    document.getElementById('items-selected').value = getValueItemsSelected();
}

function getValueItemsSelected() {
    let stringValue = "";
    isItemSelectedMap.forEach((val, key) => {
        if (val) {
            stringValue += key + "/";
        }
    });
    return stringValue;
}

function clearErrors() {
    document.getElementById('error-item').classList.add('hidden');
}

function checkForm() {
    let isValid = true;
    clearErrors();
    const items = document.getElementById('items-selected').value;
    if (items.length == 0) {
        document.getElementById('error-item').classList.remove('hidden');
        isValid = false;
    } else {
        // On rajoute l'item de la query de base
        const urlParams = new URLSearchParams(window.location.search);
        document.getElementById('items-selected').value = getValueItemsSelected() + urlParams.get('id');
    }
    document.getElementById('token').value = localStorage.getItem('token');
    return isValid;
}

function add_form(items) {
    let htmlForm = '<section class="my-card-header">\n' +
        '        <svg xmlns="http://www.w3.org/2000/svg"\n' +
        '             viewBox="0 0 512 512">\n' +
        '            <path fill="var(--font-color)"\n' +
        '                  d="M32 160h319.9l.0791 72c0 9.547 5.652 18.19 14.41 22c8.754 3.812 18.93 2.078 25.93-4.406l112-104c10.24-9.5 10.24-25.69 0-35.19l-112-104c-6.992-6.484-17.17-8.217-25.93-4.408c-8.758 3.816-14.41 12.46-14.41 22L351.9 96H32C14.31 96 0 110.3 0 127.1S14.31 160 32 160zM480 352H160.1L160 279.1c0-9.547-5.652-18.19-14.41-22C136.9 254.2 126.7 255.9 119.7 262.4l-112 104c-10.24 9.5-10.24 25.69 0 35.19l112 104c6.992 6.484 17.17 8.219 25.93 4.406C154.4 506.2 160 497.5 160 488L160.1 416H480c17.69 0 32-14.31 32-32S497.7 352 480 352z"/>\n' +
        '        </svg>\n' +
        '        <span>Proposer un échange</span>\n' +
        '    </section>';
    htmlForm += '<section class="my-card-body">\n' +
        '        <form class="form" onSubmit="applyValueItems();return checkForm()" method="POST"\n' +
        '              action="../actions/create-swap.php">\n' +
        '            <div class="input">\n' +
        '                <label>Vos objets</label>\n' +
        '                <span class="error hidden"\n' +
        '                      id="error-item">Vous devez séléctionner au moins un objet</span>\n' +
        '                <div id="button-item-container">';
    items?.forEach(item => {
        htmlForm += '<button class="item-button" type="button" value="' + escapeHtml(item['id']) + '" onclick="clickItem(this)">';
        htmlForm += '<span class="name">' + escapeHtml(item['name']) + '</span>';
        htmlForm += '<img src="/images/items/' + escapeHtml(item['picture']) + '"/>';
        htmlForm += '<div class="categories" id="cat-container">';
        item['categories']?.forEach(cat => {
            htmlForm += "<span class='category'>" + escapeHtml(cat['name']) + "</span>";
        });
        htmlForm += '</div>';
        htmlForm += '</button>';
    });
    htmlForm += '</div>';
    htmlForm += '</div>\n' +
        '    <input type="hidden" id="items-selected" name="items-selected"/>\n' +
        '    <input type="hidden" id="token" name="token"/>' +
        '    <div class="actions">\n' +
        '        <button type="reset" onClick="deselectCategories();clearErrors()">EFFACER</button>\n' +
        '        <button type="submit">DEMANDER UN TROC</button>\n' +
        '    </div>\n' +
        '</form>\n' +
        '</section>';

    document.getElementById('form-my-card').innerHTML = htmlForm;
}