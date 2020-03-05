        </div>

        <footer>

        </footer>
    </body>
</html>



<?php if (ENVIRONMENT == 'development') : ?>
    <div class="mt50">
        <hr>
        <div class="container">
            <div class="card bg-light px10 mb10"><?php echo $this->benchmark->elapsed_time(); ?> secondes / <?php echo $this->benchmark->memory_usage(); ?></div>
        </div>
    </div>
    <?php $this->output->enable_profiler(FALSE); ?>
    <?php pre($_POST); ?>
    <?php pre($_COOKIE); ?>
    <?php pre($_SESSION); ?>
<?php endif; ?>

<script>

</script>
