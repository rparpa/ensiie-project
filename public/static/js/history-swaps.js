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
                fetch('/api/trocs/findAll.php?mail=' + parseJwt(localStorage.getItem('token'))['email'] +  '&is_done=true', {
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
        swapsHTML += noResultContent("Vous n'avez pas de trocs terminés");
    }
    document.getElementById('swaps-container').innerHTML = swapsHTML;
    applyCategoriesColor();
}

