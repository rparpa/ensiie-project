
<!-- Footer -->
<footer id="footer">
    <?php if(isset($_SESSION['pseudo'])) echo 'Connecté en tant que : ' . $_SESSION['pseudo']; ?>
    <p class="copyright">&copy; SandwicherIIE <?php echo date("Y"); ?></p>
</footer>

<!-- BG -->
<div id="bg"></div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

</div>

</body>
</html>