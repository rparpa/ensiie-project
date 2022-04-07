document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('imgInput').onchange = evt => {
        const [file] = document.getElementById('imgInput').files;
        document.getElementById('result').classList.add('hidden');
        if (file) {
            document.getElementById('result').src = URL.createObjectURL(file);
            document.getElementById('result').classList.remove('hidden');
        }
    }
});