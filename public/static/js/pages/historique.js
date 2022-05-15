window.onload = loadSwaps;

let swaps = null;

function loadSwaps() {
    checkAuth()
        .then(user => {
            if (user == null) {
                document.location.href = "/index.php";
            } else {
                add_structure(user);
                listSwapsByUserMailAndIsDone(parseJwt(localStorage.getItem('token'))['email'], true)
                    .then(res => {
                        swaps = res;
                        displaySwaps(res);
                    });
            }
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

