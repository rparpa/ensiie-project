window.onload = loadSwaps;

let swaps = null;

function loadSwaps() {
    fetch('/api/trocs/findAll.php?mail=toto&is_done=true').then(data => {
        return data.json()
    }).then(res => {
        swaps = res;
        displaySwaps(res);
    });
}

function displaySwaps(swaps) {
    let swapsHTML = "";
    if (swaps.length) {
        swaps.forEach(swap => {
            swapsHTML += swapTemplateAllInformation(swap);
        });
    } else {
        swapsHTML += noResultContent("Vous n'avez pas de trocs terminés");
    }
    document.getElementById('swaps-container').innerHTML = swapsHTML;
    applyCategoriesColor();
}

