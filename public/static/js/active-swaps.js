window.onload = loadSwaps;

function loadSwaps() {
    fetch('/api/trocs/findAll.php?mail=toto&is_done=false').then(data => {
        return data.json()
    }).then(res => displaySwaps(res));
}

function displaySwaps(swaps) {
    console.log(swaps);
    let swapsHTML = "";
    if (swaps.length) {
        swaps.forEach(swap => {
            swapsHTML += swapTemplateAllInformation(swap);
        });
    } else {
        swapsHTML += noResultContent("Vous n'avez pas de trocs en cours");
    }
    document.getElementById('swaps-container').innerHTML = swapsHTML;
    applyCategoriesColor();
}