<?php

?>
<div style="display: block" id="chat">
    <div class="chat">
        <table class="table" id="infos_chat">
            <?php include_once 'refresh_chat.php' ?>
        </table>
    </div>

    <form action="chat.php" method="post">
        <?php if ($authenticatorService->isAuthenticated()) {?>
            <p>
                <input type="hidden" value=<?php echo $authenticatorService->getCurrentUser()->getUsername()?> name="pseudo"/>
                <label for="message">Message</label> :  <input type="text" name="message" id="message" /><br />
                <input type="submit" value="Envoyer" />
            </p>
        <?php } ?>
    </form>
</div>


<script>
    function autoRefresh_chat()
    {
        $("#infos_chat").load('refresh_chat.php');
    }

    setInterval('autoRefresh_chat()', 5000); // refresh tab after 5 secs
</script>