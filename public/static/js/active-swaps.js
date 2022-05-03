window.onload = loadSwaps;

let swaps = null;

function loadSwaps() {
    checkAuth()
        .then(response => {
            return response.json();
        })
        .then(user => {
            if (user == null) {
                document.location.href = "/index.php";
            } else {
                add_structure(user);
                fetch('/api/trocs/findAll.php?mail=' + parseJwt(localStorage.getItem('token'))['email'] + '&is_done=false', {
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
    let updateSwap = swaps.find(s => s['id'] === idSwap);
    updateSwap['status'] = newValue;
    fetch('/api/trocs/update.php',
        {
            headers: {
                'Authorization': localStorage.getItem('token')
            },
            method: 'POST',
            body: JSON.stringify(updateSwap)
        }).then(data => {
        return data.json()
    }).then(res => loadSwaps());
}