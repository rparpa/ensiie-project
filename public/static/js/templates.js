/*
Fichier qui contient les fonctions générant du HTML selon différents objets communs de notre
serveur
 */


/*
Fonction permettant d'éviter les problèmes d'injection HTML
 */
function escapeHtml(text) {
    return String(text)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

/*
Fonction affichant le message de non résultat passé en paramètre
 */
function noResultContent(message) {
    return "<div class=\"my-card my-card-100\">     \n" +
        "        <div class=\"my-card-body no-line\">\n" +
        "            <div class=\"error-div\">\n" +
        "                <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\">\n" +
        "                    <path fill=\"var(--refusal-color)\"\n" +
        "                          d=\"M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM175 208.1L222.1 255.1L175 303C165.7 312.4 165.7 327.6 175 336.1C184.4 346.3 199.6 346.3 208.1 336.1L255.1 289.9L303 336.1C312.4 346.3 327.6 346.3 336.1 336.1C346.3 327.6 346.3 312.4 336.1 303L289.9 255.1L336.1 208.1C346.3 199.6 346.3 184.4 336.1 175C327.6 165.7 312.4 165.7 303 175L255.1 222.1L208.1 175C199.6 165.7 184.4 165.7 175 175C165.7 184.4 165.7 199.6 175 208.1V208.1z\"/>\n" +
        "                </svg>\n" +
        "                <span class=\"error\">\n" +
        "                " + message + "\n" +
        "            </span>\n" +
        "            </div>\n" +
        "        </div>\n" +
        "    </div>"
}

/*
Générer le code HTML pour un item avec toutes ses informations
 */
function itemTemplateAllInformation(item) {
    let itemsHTML = "";
    itemsHTML += "<div class='item'> " +
        "<button class='trash' onclick='deleteItem(" + escapeHtml(item['id']) + ")'>" +
        "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'> " +
        "<path d='M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z'/>\n" +
        "</svg>" +
        "</button>" +
        "<div class='image'>" +
        "<img class='logo' src='/images/items/" + escapeHtml(item['picture']) + "'/>" +
        "<div class='categories' id='cat-container'>";
    if (item['categories']) {
        item['categories'].forEach(category => {
            itemsHTML += "<span class='category'>" + escapeHtml(category['name']) + "</span>";
        });
    }
    itemsHTML += "</div>";
    itemsHTML += "</div>";
    itemsHTML += "<div class='information'>";
    itemsHTML += "<h3>" + escapeHtml(item['name']) + "</h3>";
    itemsHTML += "<span class='date'>Date d'ajout: " + escapeHtml(item['creation_date']) + "</span>";
    itemsHTML += "<p>" + escapeHtml(item['description']) + "</p>";
    itemsHTML += "</div>";
    itemsHTML += "</div>";
    return itemsHTML;
}

function goToUserProfile(email) {
    document.location.href = "/user-pages/user-profile.php?email=" + email;
}

/*
Générer le code HTML pour un panneau utilisateur avec quelques unes de ses informations
 */
function userListTemplateInformation(user) {
    let usersHTML = "";
    usersHTML += '<div class="all-users-item" onclick="goToUserProfile(\'' + user['mail'] + '\')">' + // Mieux, passer directement le user, ça éviterait une requête pour rien
        '<div class="user-item-image">' +
        '<img class="logo" class="photo" src="/images/users/' + escapeHtml(user['picture']) + '"/>' +
        '</div>' +
        '<div class="user-item-infos">' +
        '<div class="all-user-item-info user-item-email">' +
        '<p> Email : ' + escapeHtml(user["mail"]) + '</p>' +
        '</div>' +
        '<div class="all-user-item-info user-item-username">' +
        '<p>Pseudo : ' + escapeHtml(user["pseudo"]) + '</p>' +
        '</div>' +
        '<div class="all-user-item-info user-item-firstname">' +
        '<p> Prénom : ' + escapeHtml(user["firstname"]) + '</p>' +
        '</div>' +
        '<div class="all-user-item-info user-item-lastname">' +
        '<p>  Nom : ' + escapeHtml(user["lastname"]) + '</p>' +
        '</div>' +
        '</div>' +
        '<div class="button-ban" onclick="banUser(\'' + user['mail'] + '\')">Bannir</div> <!-- Ne pas oublier de faire le bouton "débannir-->' +
        '</div>';
    return usersHTML;
}

/*
Générer le code HTML pour un panneau utilisateur avec quelques unes de ses informations
 */
function userProfileTemplateAllInformation(user) {
    let userHTML = "";
    userHTML += '<div class="user-profile-header">' +
        '<div class="user-profile-page-title">' +
        '<h2>Profil utilisateur :</h2>' +
        '</div>' +
        '<div class="user-profile-image">' +
        '<img class="logo" class="photo" src="/images/users/' + escapeHtml(user['picture']) + '"/>' +
        '</div>' +
        '<div class="user-profile-header-email">' +
        '<h4>Email :</h4>' +
        user['mail'] +
        '</div>' +
        '<div class="user-profile-header-username">' +
        '<h4>Pseudo :</h4>' +
        user['pseudo'] +
        '</div>' +
        '</div>' +
        '<div class="user-profile-infos">' +
        '<div class="user-profile-identite">' +
        '<div class="user-profile-infos-header">' +
        '<h4>Identité :</h4>' +
        '</div>' +
        '<div class="user-profile-infos-identite">' +
        '<div class="all-user-item-info user-item-firstname">Prénom : ' +
        user['firstname'] +
        '</div>' +
        '<div class="all-user-item-info user-item-lastname">Nom : ' +
        user['lastname'] +
        '</div>' +
        '</div>' +
        '</div>' +
        '<div class="user-profile-location">' +
        '<div class="user-profile-infos-header">' +
        '<h4>Localisation :</h4>' +
        '</div>' +
        '<div class="user-profile-street">' +
        '<p>Adresse : ' + user['street'] + '</p>' +
        '</div>' +
        '<div class="user-profile-infos-location">' +
        '<div class="user-item-city"> Ville : ' +
        user['city'] +
        '</div>' +
        '<div class="user-item-zipcode"> Code Postal : ' +
        user['zipcode'] +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '<div class="user-profile-button-ban" onclick="banUser(\'' + user['mail'] + '\')">Bannir</div> <!-- Ne pas oublier de faire le bouton "débannir-->'
    return userHTML;
}

/*
Génére le code HTML pour un objet avec quelques informations
 */
function itemTemplateShort(item) {
    let resultHTML = "";
    resultHTML += "<a class='item-link' href='objet.php?id=" + escapeHtml(item['id']) + "'>";
    resultHTML += "<img src='/images/items/" + escapeHtml(item['picture']) + "'/>";
    resultHTML += "<div class='information'>";
    resultHTML += "<h3>" + escapeHtml(item['name']) + "</h3>";
    resultHTML += "<span class='date'>Date d'ajout: " + escapeHtml(item['creation_date']) + "</span>";
    resultHTML += "<div class='categories'>"
    if (item['categories']) {
        item['categories'].forEach(category => {
            resultHTML += "<span class='category'>" + escapeHtml(category['name']) + "</span>";
        });
    }
    resultHTML += "</div>";
    resultHTML += "</div>";
    resultHTML += "<div class='user'>";
    resultHTML += "<img src='../images/users/" + escapeHtml(item['proprietary']['picture']) + "'/>";
    resultHTML += "<span>" + escapeHtml(item['proprietary']['pseudo']) + "</span>";
    resultHTML += "</div>";
    resultHTML += "</a>";
    return resultHTML;
}

/*
Fonction générant le code HTML pour un troc
 */
function swapTemplateAllInformation(swap) {
    let swapTemplateHTML = "";
    swapTemplateHTML += "<section class='my-card my-card-100'>";
    swapTemplateHTML += "<section class='my-card-header'>";
    swapTemplateHTML += getTitleSwap(swap)
    swapTemplateHTML += "</section>";
    swapTemplateHTML += "<section class='my-card-body'>";
    swapTemplateHTML += "<div class='swap-content'/>";
    swapTemplateHTML += "<div class='swap-info'/>";
    swapTemplateHTML += templateItemsSwapped(swap, false);
    swapTemplateHTML += templateUserInformation(swap['user_to']);
    swapTemplateHTML += "</div>";
    if (!swap['is_done']) {
        swapTemplateHTML += "<div class='form'>";
        swapTemplateHTML += "<div class='actions'/>";
        if (swap['user_from'] == 'toto') {
            swapTemplateHTML += "<button class='wait' disabled>EN ATTENTE</button>"
        } else {
            swapTemplateHTML += "<button class='refusal' onclick='updateSwap(" + swap['id'] + ", 2)'>REFUSER</button>";
            swapTemplateHTML += "<button class='accept' onclick='updateSwap(" + swap['id'] + ", 1)'>ACCEPTER</button>"
        }
        swapTemplateHTML += "</div>";
        swapTemplateHTML += "</div>";
    }
    swapTemplateHTML += "</div>";
    swapTemplateHTML += "</div>";
    swapTemplateHTML += "</section>";
    swapTemplateHTML += "</section>";
    return swapTemplateHTML;
}


function templateUserInformation(user) {
    let userTemplateHTML = "";
    userTemplateHTML += "<div class='user-profile'>";
    userTemplateHTML += "<div class='adress'>";
    userTemplateHTML += "<span> <span class='label'> Nom et prénom : </span> JUSSEAUME Jonathan </span>";
    userTemplateHTML += "<span> <span class='label'> Adresse : </span> 10 rue du con de la ciudad, PARIS(75007) </span>";
    userTemplateHTML += templateWishesUser(user);
    userTemplateHTML += "</div>";
    userTemplateHTML += "<div class='user'>";
    userTemplateHTML += "<img src='../images/users/" + user['picture'] + "'/>";
    userTemplateHTML += "<span>" + user + "</span>";
    userTemplateHTML += "</div>";
    userTemplateHTML += "</div>";
    return userTemplateHTML;
}

function templateWishesUser(user) {
    let wishesTemplateHTML = "";
    wishesTemplateHTML += "<div class='wishes'>";
    wishesTemplateHTML += "<span> Souhaits : </span>";
    wishesTemplateHTML += "<ul>";
    wishesTemplateHTML += "<li> Stylo </li>";
    wishesTemplateHTML += "<li class='category'>DVD</li>";
    wishesTemplateHTML += "<li class='category'>LITTERATURE</li>";
    wishesTemplateHTML += "</ul>";
    wishesTemplateHTML += "</div>";
    return wishesTemplateHTML;
}

function templateItemsSwapped(swap, wantsPseudo) {
    let itemsSwappedTemplateHTML = "";
    itemsSwappedTemplateHTML = "<div class='swap'>";
    itemsSwappedTemplateHTML += "<div class='information'>";
    itemsSwappedTemplateHTML += "<div class='objects me'/>";
    itemsSwappedTemplateHTML += "<div class='images'>";
    let sizeUserFrom = getItemsUserFrom(swap).length;
    let baseDeltaLeft = Math.max(0, 40 / Math.pow(2, sizeUserFrom - 1));
    let deltaLeft = (200 - (baseDeltaLeft * 2) - 120) / (Math.max(1, sizeUserFrom - 1));
    getItemsUserFrom(swap)?.forEach((item, index) => {
        const leftValue = baseDeltaLeft + (index * deltaLeft);
        itemsSwappedTemplateHTML += "<a style='left: " + leftValue + "px;" + (index == 0 ? "z-index:3" : "") + "' href='objet.php?id=" + item['id'] + "'>";
        itemsSwappedTemplateHTML += "<img src='/images/items/" + item['picture'] + "'/>";
        itemsSwappedTemplateHTML += "</a>";
    })
    itemsSwappedTemplateHTML += "</div>";
    if (wantsPseudo) {
        itemsSwappedTemplateHTML += "<span class='pseudo'>" + escapeHtml(swap['user_from']) + "</span>";
    } else {
        itemsSwappedTemplateHTML += "<span class='pseudo'>" + getItemsUserTo(swap)?.map(s => escapeHtml(s['name']))?.join(", ") + "</span>";
    }
    itemsSwappedTemplateHTML += "</div>";
    itemsSwappedTemplateHTML += "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path fill='var(--font-color)'\n" +
        "    d='M32 160h319.9l.0791 72c0 9.547 5.652 18.19 14.41 22c8.754 3.812 18.93 2.078 25.93-4.406l112-104c10.24-9.5 10.24-25.69 0-35.19l-112-104c-6.992-6.484-17.17-8.217-25.93-4.408c-8.758 3.816-14.41 12.46-14.41 22L351.9 96H32C14.31 96 0 110.3 0 127.1S14.31 160 32 160zM480 352H160.1L160 279.1c0-9.547-5.652-18.19-14.41-22C136.9 254.2 126.7 255.9 119.7 262.4l-112 104c-10.24 9.5-10.24 25.69 0 35.19l112 104c6.992 6.484 17.17 8.219 25.93 4.406C154.4 506.2 160 497.5 160 488L160.1 416H480c17.69 0 32-14.31 32-32S497.7 352 480 352z'/>\n" +
        "        </svg>";
    itemsSwappedTemplateHTML += "<div class='objects'/>";
    itemsSwappedTemplateHTML += "<div class='images'>";
    sizeUserFrom = getItemsUserTo(swap).length;
    baseDeltaLeft = Math.max(0, 40 / Math.pow(2, sizeUserFrom - 1));
    deltaLeft = (200 - (baseDeltaLeft * 2) - 120) / (Math.max(1, sizeUserFrom - 1));
    getItemsUserTo(swap)?.forEach((item, index) => {
        const leftValue = baseDeltaLeft + (index * deltaLeft);
        itemsSwappedTemplateHTML += "<a style='left: " + leftValue + "px;" + (index == 0 ? "z-index:3" : "") + "' href='objet.php?id=" + item['id'] + "'>";
        itemsSwappedTemplateHTML += "<img src='/images/items/" + item['picture'] + "'/>";
        itemsSwappedTemplateHTML += "</a>";
    })
    itemsSwappedTemplateHTML += "</div>";
    if (wantsPseudo) {
        itemsSwappedTemplateHTML += "<span class='pseudo'>" + escapeHtml(swap['user_to']) + "</span>";
    } else {
        itemsSwappedTemplateHTML += "<span class='pseudo'>" + getItemsUserTo(swap)?.map(s => escapeHtml(s['name']))?.join(", ") + "</span>";
    }
    itemsSwappedTemplateHTML += "</div>";
    itemsSwappedTemplateHTML += "</div>";
    itemsSwappedTemplateHTML += "</div>";
    return itemsSwappedTemplateHTML;
}

function getTitleSwap(swap) {
    let title = "<svg xmlns=\"http://www.w3.org/2000/svg\"\n" +
        "viewBox=\"0 0 512 512\">";
    if (swap['status'] == 2) {
        title += "<path fill=\"var(--refusal-color)\"\n" +
            "d=\"M32 160h319.9l.0791 72c0 9.547 5.652 18.19 14.41 22c8.754 3.812 18.93 2.078 25.93-4.406l112-104c10.24-9.5 10.24-25.69 0-35.19l-112-104c-6.992-6.484-17.17-8.217-25.93-4.408c-8.758 3.816-14.41 12.46-14.41 22L351.9 96H32C14.31 96 0 110.3 0 127.1S14.31 160 32 160zM480 352H160.1L160 279.1c0-9.547-5.652-18.19-14.41-22C136.9 254.2 126.7 255.9 119.7 262.4l-112 104c-10.24 9.5-10.24 25.69 0 35.19l112 104c6.992 6.484 17.17 8.219 25.93 4.406C154.4 506.2 160 497.5 160 488L160.1 416H480c17.69 0 32-14.31 32-32S497.7 352 480 352z\"/>\n" +
            "</svg>";
        title += "<span style='color: var(--refusal-color)'>"
        title += "Troc refusé par " + swap['user_to'] + " le: " + swap['end_date'];
    } else if (swap['status'] == 1) {
        title +=
            "<path fill=\"var(--validation-color)\"\n" +
            " d=\"M32 160h319.9l.0791 72c0 9.547 5.652 18.19 14.41 22c8.754 3.812 18.93 2.078 25.93-4.406l112-104c10.24-9.5 10.24-25.69 0-35.19l-112-104c-6.992-6.484-17.17-8.217-25.93-4.408c-8.758 3.816-14.41 12.46-14.41 22L351.9 96H32C14.31 96 0 110.3 0 127.1S14.31 160 32 160zM480 352H160.1L160 279.1c0-9.547-5.652-18.19-14.41-22C136.9 254.2 126.7 255.9 119.7 262.4l-112 104c-10.24 9.5-10.24 25.69 0 35.19l112 104c6.992 6.484 17.17 8.219 25.93 4.406C154.4 506.2 160 497.5 160 488L160.1 416H480c17.69 0 32-14.31 32-32S497.7 352 480 352z\"/>\n" +
            "</svg>";
        title += "<span style='color: var(--validation-color)'>"
        title += "Troc accepté par " + swap['user_to'] + " le: " + swap['end_date'];
    } else {
        title += "<path fill=\"var(--font-color)\"\n" +
            "d=\"M32 160h319.9l.0791 72c0 9.547 5.652 18.19 14.41 22c8.754 3.812 18.93 2.078 25.93-4.406l112-104c10.24-9.5 10.24-25.69 0-35.19l-112-104c-6.992-6.484-17.17-8.217-25.93-4.408c-8.758 3.816-14.41 12.46-14.41 22L351.9 96H32C14.31 96 0 110.3 0 127.1S14.31 160 32 160zM480 352H160.1L160 279.1c0-9.547-5.652-18.19-14.41-22C136.9 254.2 126.7 255.9 119.7 262.4l-112 104c-10.24 9.5-10.24 25.69 0 35.19l112 104c6.992 6.484 17.17 8.219 25.93 4.406C154.4 506.2 160 497.5 160 488L160.1 416H480c17.69 0 32-14.31 32-32S497.7 352 480 352z\"/>\n" +
            "</svg>";
        title += "<span>"
        title += "Troc initié par " + swap['user_from'] + " le : " + swap['creation_date'];
    }
    title += "</span>";
    return title;
}

function getItemsUserFrom(swap) {
    return swap['items'].filter(item => item['proprietary'] == swap['user_from']);
}

function getItemsUserTo(swap) {
    return swap['items'].filter(item => item['proprietary'] == swap['user_to']);
}