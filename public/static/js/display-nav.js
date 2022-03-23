let navDisplayed = false;

function displayNav() {
    if (!navDisplayed) {
        document.getElementById('nav').classList.add('display');
        navDisplayed = true;
    } else {
        document.getElementById('nav').classList.remove('display');
        navDisplayed = false;
    }

}
