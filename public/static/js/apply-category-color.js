colors = [
    '#009966',
    '#8fbc8f',
    '#3cb371',
    '#00b140',
    '#6699cc',
    '#0000ff',
    '#9400d3',
    '#330066',
    '#c21e56',
    '#cc338b',
    '#dc143c',
    '#cd5b45',
    '#eee600',
    '#ed9121',
    '#c39953'
];

document.addEventListener("DOMContentLoaded", function () {
    applyCategoriesColor();
});


function getColorOfCategory(category) {
    let value = 0;
    for (let i = 0; i < category.length; i++) {
        value += category.charAt(i).charCodeAt(0);
    }
    return colors[value % colors.length];
}

function applyCategoriesColor() {
    const categories = document.getElementsByClassName('category');
    for (let i = 0; i < categories.length; i++) {
        categories[i].style.borderColor = getColorOfCategory(categories[i].firstChild.nodeValue);
    }
}