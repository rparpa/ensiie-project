function clearErrors() {
    document.getElementById('error-name').classList.add('hidden');
    document.getElementById('error-photo').classList.add('hidden');
    document.getElementById('error-description').classList.add('hidden');
}

function checkForm() {
    let isValid = true;

    clearErrors();
    // Check id_license
    const description = document.getElementById('description').value;
    if (description.length === 0 || description.length > 240) {
        document.getElementById('error-description').classList.remove('hidden');
        isValid = false;
    }

    const name = document.getElementById('item-name').value;
    if (name.length === 0 || name.length > 50) {
        document.getElementById('error-name').classList.remove('hidden');
        isValid = false;
    }
    const [file] = document.getElementById('imgInput').files;
    if (!file) {
        document.getElementById('error-photo').classList.remove('hidden');
        isValid = false;
    }
    return isValid;
}