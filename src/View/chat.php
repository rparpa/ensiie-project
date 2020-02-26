<div style="display: block" id="chat">
    <div class="chat">
        <table class="table" id="infos_chat">
            <?php include_once 'refresh_chat.php' ?>
        </table>
    </div>
    <div class="card mx-auto" style="margin-top: 50px; width:300px" width="50%">
        <form action="chat.php" method="post">
            <?php if ($authenticatorService->isAuthenticated()) {?>
                    <div class="card-header">
                        <h5>Message</h5>
                    </div>
                    <div class="card-body" >

                     <div type="hidden" value=<?php echo $authenticatorService->getCurrentUser()->getUsername()?> name="pseudo"/>
                    <!-- <input placeholder="Message" type="text" name="message" id="message" /><br /> -->
                    <textarea class="form-control" rows="3" name="message" id="message" ></textarea>
                    <input value="Envoyer" style="color: #3398FF" class="btn float-right" type="submit">

                    </div>
                </div>
            <?php } ?>
        </form>
    </div>
</div>


