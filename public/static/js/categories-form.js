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


isCategorySelectedMap = new Map();

document.addEventListener("DOMContentLoaded", function () {
    const categories = document.getElementById('button-container').getElementsByClassName('category-button');
    for (let i = 0; i < categories.length; i++) {
        isCategorySelectedMap.set(categories[i].value, false);
    }
});

function clickCategory(buttonCategory) {
    isCategorySelectedMap.set(buttonCategory.value, !isCategorySelectedMap.get(buttonCategory.value));
    if (isCategorySelectedMap.get(buttonCategory.value)) {
        buttonCategory.style.color = 'var(--font-color)';
        buttonCategory.style.borderColor = getColorOfCategory(buttonCategory.firstChild.nodeValue);
    } else {
        buttonCategory.style.color = 'var(--disable-color)';
        buttonCategory.style.borderColor = 'var(--disable-color)';
    }
}

function getColorOfCategory(category) {
    let value = 0;
    for (let i = 0; i < category.length; i++) {
        value += category.charAt(i).charCodeAt(0);
    }
    return colors[value % colors.length];
}

function deselectCategories() {
    const categories = document.getElementById('button-container').getElementsByClassName('category-button');
    for (let i = 0; i < categories.length; i++) {
        isCategorySelectedMap.set(categories[i].value, false);
        categories[i].style.color = 'var(--disable-color)';
        categories[i].style.borderColor = 'var(--disable-color)';
    }
    if (document.getElementById('result')) {
        document.getElementById('result').classList.add('hidden');
    }
}

function applyValueCategories() {
    document.getElementById('category-selected').value = getValueCategoriesSelected();
}

function getValueCategoriesSelected() {
    let stringValue = "";
    isCategorySelectedMap.forEach((val, key) => {
        if (val) {
            stringValue+= key + "/";
        }
    });
    return stringValue;
}