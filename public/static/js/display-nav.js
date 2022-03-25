let navDisplayed = false;

links = document.getElementsByClassName('link');
console.log(links.length);
console.log(window.location.href);

for (let i = 0; i < links.length; i++) {
    console.log(i);
    var filename = window.location.href.split('/');
    filename = filename[filename.length - 1];
    console.log(filename);
    if (links[i].href == filename) {
        links[i].classList.add('active-link');
    }
}

function displayNav() {
    if (!navDisplayed) {
        document.getElementById('nav').classList.add('display');
        navDisplayed = true;
    } else {
        document.getElementById('nav').classList.remove('display');
        navDisplayed = false;
    }

}
