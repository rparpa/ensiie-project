// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    window.addEventListener('load', function() {
        var form = document.getElementById('needs-validation');
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
        }, false);
    }, false);
})();