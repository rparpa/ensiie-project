

window.onload = loadPage;

function loadPage() {
    checkAuth()
        .then(response => {
            return response.json();
        })
        .then(isConnected => {
            if (!isConnected) {
                document.location.href = "/index.php";
            }
        });
}

isItemSelectedMap = new Map();


document.addEventListener("DOMContentLoaded", function () {
    const items = document.getElementById('button-item-container').getElementsByClassName('item-button');
    for (let i = 0; i < items.length; i++) {
        isItemSelectedMap.set(items[i].value, false);
    }
});

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
            stringValue+= key + "/";
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
    // Check id_license
    const items = document.getElementById('items-selected').value;
    if (items.length == 0) {
        document.getElementById('error-item').classList.remove('hidden');
        isValid = false;
    } else {
        // On rajoute l'item de la query de base
        const urlParams = new URLSearchParams(window.location.search);
        document.getElementById('items-selected').value = getValueItemsSelected() + urlParams.get('id');
    }
    console.log(document.getElementById('items-selected').value);
    return isValid;
}