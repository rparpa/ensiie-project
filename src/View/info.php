<?php

?>

<div class="info">
    <table class="table" id="infos_info">
        <?php include_once 'refresh_info.php' ?>
    </table>
</div>



<script>
    function autoRefresh_info()
    {
        $("#infos_info").load('refresh_info.php');
    }

    setInterval('autoRefresh_info()', 5000); // refresh tab after 5 secs
</script>