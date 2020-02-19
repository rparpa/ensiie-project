<?php

?>

<form action="chat.php" method="post">
    <?php if ($authenticatorService->isAuthenticated()) {?>
    <p>
        <input type="hidden" value=<?php echo $authenticatorService->getCurrentUser()->getUsername()?> name="pseudo"/>
        <label for="message">Message</label> :  <input type="text" name="message" id="message" /><br />
        <input type="submit" value="Envoyer" />
    </p>
    <?php } ?>
</form>



<table class="table" id="infos">
    <?php include_once 'refresh_chat.php' ?>
</table>

<script type="text/javascript">
    function autoRefresh_div()
    {
        console.log(
        $("table#infos").load('refresh_chat.php'));
    }

    setInterval('autoRefresh_div()', 5000); // refresh tab after 5 secs
</script>