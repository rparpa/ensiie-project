function listSwaps() {
    return fetch('/api/swap-api.php', {
        method: 'GET',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(response => {
        return response.json();
    });
}


function listSwapsByUserMailAndIsDone(userMail, isDone) {
    return fetch('/api/swap-api.php?mail=' + userMail + '&is_done=' + isDone,
        {
            headers: {
                'Authorization': localStorage.getItem('token')
            }
        }).then(data => {
        return data.json()
    });
}

function listLast10Swaps() {
    return fetch('/api/swap-api.php?last-10=true', {
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(data => {
        return data.json()
    });
}

function getStatsSwapsLastSevenDays() {
    return fetch('/api/trocs/stats.php', {
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }).then(data => {
        return data.json()
    });
}

function updateSwap(swap) {
    return fetch('/api/trocs/update.php',
        {
            headers: {
                'Authorization': localStorage.getItem('token')
            },
            method: 'POST',
            body: JSON.stringify(swap)
        }).then(data => {
        return data.json()
    })
}

