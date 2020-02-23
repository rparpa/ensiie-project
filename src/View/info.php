<div class="info">
    <table class="table" id="infos">
        <?php include_once 'chat/refresh_info.php' ?>
    </table>
</div>



<script>
    function autoRefresh_div()
    {
        $("#infos").load('refresh_info.php');
    }

    setInterval('autoRefresh_div()', 1000); // refresh tab after 5 secs
</script>