// Page nécessaire au bon fonctionnement de mes-trocs.php
window.onload = loadSwaps;
let swaps = null;

function loadSwaps() {
    checkAuth()
        .then(user => {
            if (user == null) {
                document.location.href = "/index.php";
            } else {
                add_structure(user);
                listSwapsByUserMailAndIsDone(parseJwt(localStorage.getItem('token'))['email'], false)
                    .then(res => {
                        swaps = res;
                        deleteNotificationsByUserMail(parseJwt(localStorage.getItem('token'))['email'])
                            .then(notifications => {
                                displaySwaps(res, notifications);
                            });
                    });
            }
        });
}

function displaySwaps(swaps, notifications) {
    let swapsHTML = "";
    if (swaps.length) {
        swaps.forEach(swap => {
            swapsHTML += swapTemplateAllInformation(swap, notifications);
        });
    } else {
        swapsHTML += noResultContent("Vous n'avez pas de trocs en cours");
    }
    document.getElementById('swaps-container').innerHTML = swapsHTML;
    applyCategoriesColor();
}


function clickUpdateSwap(idSwap, newValue) {
    let swapToUpdate = swaps.find(s => s['id'] === idSwap);
    swapToUpdate['status'] = newValue;
    updateSwap(swapToUpdate)
        .then(() => loadSwaps());
}