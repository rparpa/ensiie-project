/*
Fichier qui contient les fonctions générant du HTML selon différents objets communs de notre
serveur
 */


/*
Fonction permettant d'éviter les problèmes d'injection HTML
 */
function escapeHtml(text) {
    return new String(text)
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
        "<button class='delete' onclick='deleteItem(" + escapeHtml(item['id']) + ")'>" +
        "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'> " +
        "<path d='M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z'/>\n" +
        "</svg>" +
        "</button>" +
        "<div class='image'>" +
        "<img class='logo' src='/images/items/" + escapeHtml(item['picture']) + "'/>" +
        "<div class='categories' id='cat-container'>";
    item['categories'].forEach(category => {
        itemsHTML += "<span class='category'>" + escapeHtml(category['name']) + "</span>";
    });
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
    item['categories'].forEach(category => {
        resultHTML += "<span class='category'>" + escapeHtml(category['name']) + "</span>";
    });
    resultHTML += "</div>";
    resultHTML += "</div>";
    resultHTML += "<div class='user'>";
    resultHTML += "<img src='../static/assets/zoro.jpg'/>";
    resultHTML += "<span>" + escapeHtml(item['proprietary']) + "</span>";
    resultHTML += "</div>";
    resultHTML += "</a>";
    return resultHTML;
}

/*
Fonction générant le code HTML pour un troc
 */
function swapTemplateAllInformation(swap) {

}