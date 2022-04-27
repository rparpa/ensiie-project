let navDisplayed = false;

document.addEventListener("DOMContentLoaded", function () {
    let links = document.getElementsByClassName('link');
    for (let i = 0; i < links.length; i++) {
        if (links[i].href == window.location.href) {
            links[i].classList.add('active-link');
        }
    }
    if (localStorage.getItem('theme') == null ||
        localStorage.getItem('theme') == '') {
        localStorage.setItem('theme', 'dark');
    }
    applyTheme();
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

function applyTheme() {
    if (localStorage.getItem('theme') == 'dark') {
        document.getElementById('moon').classList.add('hidden');
        document.getElementById('sun').classList.remove('hidden');
        document.documentElement.style.setProperty('--background-color', '#474447');
        document.documentElement.style.setProperty('--dark-color', '#221F22');
        document.documentElement.style.setProperty('--font-color', 'white');
        document.documentElement.style.setProperty('--main-color', '#FFD866');
    } else if (localStorage.getItem('theme') == 'light') {
        document.getElementById('sun').classList.add('hidden');
        document.getElementById('moon').classList.remove('hidden');
        document.documentElement.style.setProperty('--background-color', 'white');
        document.documentElement.style.setProperty('--dark-color', '#e9e9e9');
        document.documentElement.style.setProperty('--font-color', 'black');
        document.documentElement.style.setProperty('--main-color', '#9d2292');
    }
}

function goDarkMode() {
    localStorage.setItem('theme', 'dark');
    applyTheme();
}

function goLightMode() {
    localStorage.setItem('theme', 'light');
    applyTheme();
}
