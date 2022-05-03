function getAllTrocs() {
    fetch('/api/trocs/findAll.php', {
        method: 'GET',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(response => {
        return response.json();
    }).then(res => displaySwaps(res));
}

function displaySwaps(swaps) {
    let swapsHTML = "";
    if (swaps.length) {
        swaps.forEach(swap => {
            swapsHTML += swapTemplateAllInformation(swap);
        });
    } else {
        swapsHTML += noResultContent("Il n'y a pas de trocs en cours");
    }
    document.getElementsByClassName('all-swaps-container')[0].innerHTML = swapsHTML;
    applyCategoriesColor();
}

function getAllCategories() {
    fetch('/api/trocs/findAll.php', {
        method: 'GET',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(response => {
        return response.json();
    }).then(res => displaySwaps(res)); // PAS DISPLAY SWAP QU IL FAUT UTILISER
}

function banUser(email) {
    fetch('/api/user-api.php?email=' + email, {
        method: 'POST',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(response => {
        return response.json();
    });
}
