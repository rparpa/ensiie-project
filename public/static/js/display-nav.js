let navDisplayed = false;

document.addEventListener("DOMContentLoaded", function () {
    let links = document.getElementsByClassName('link');
    for (let i = 0; i < links.length; i++) {
        if (links[i].href == window.location.href) {
            links[i].classList.add('active-link');
        }
    }
});

function displayNav() {
    if (!navDisplayed) {
        document.getElementById('nav').classList.add('display');
        navDisplayed = true;
    } else {
        document.getElementById('nav').classList.remove('display');
        navDisplayed = false;
    }

}
