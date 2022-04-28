window.onload = loadSwaps;

let swaps = null;

function loadSwaps() {
    checkAuth()
        .then(response => {
            return response.json();
        })
        .then(isConnected => {
            if (!isConnected) {
                document.location.href = "/index.php";
            } else {
                fetch('/api/trocs/findAll.php?mail=toto&is_done=false', {
                    headers: {
                        'Authorization': localStorage.getItem('token')
                    }
                }).then(data => {
                    return data.json()
                }).then(res => {
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
        swapsHTML += noResultContent("Vous n'avez pas de trocs en cours");
    }
    document.getElementById('swaps-container').innerHTML = swapsHTML;
    applyCategoriesColor();
}


function updateSwap(idSwap, newValue) {
    let updateSwap = swaps.find(s => s['id'] == idSwap);
    updateSwap['status'] = newValue;
    console.log(updateSwap);
    fetch('/api/trocs/update.php',
        {
            method: 'POST',
            body: JSON.stringify(updateSwap)
        }).then(data => {
        return data.json()
    }).then(res => loadSwaps());
}