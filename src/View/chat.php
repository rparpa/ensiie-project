<?php
use Db\Connection;
use Service\AuthenticatorService;
use User\UserHydrator;
use User\UserRepository;
use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;

$userHydrator = new UserHydrator();
$userRepository = new UserRepository(Connection::get(), $userHydrator);
$authenticatorService = new AuthenticatorService($userRepository);
$organizationHydrator = new OrganizationHydrator();
$organizationRepository = new organizationRepository(Connection::get(), $organizationHydrator);
$user = $authenticatorService->getCurrentUser();
?>
<div id="chat">
    <?php
    if ($authenticatorService->isAuthenticated()) {
        $org = $organizationRepository->fetchByUser($authenticatorService->getCurrentUserId());
        if ($org != null) {
    ?>
            <div class="chat">
                <table class="table" id="infos_chat">
                    <?php include_once 'refresh_chat.php' ?>
                </table>
            </div>
            <div class="card ">
                <form id="form-chat-add-message">
                    <div class="card-header">
                        <h5>Message</h5>
                    </div>
                    <div class="card-body">
                        <input type="hidden" value=<?php echo $authenticatorService->getCurrentUser()->getUsername() ?> name="pseudo" id="pseudo" />
                        <textarea class="form-control" rows="3" name="message" id="message" required></textarea>
                        <input value="Envoyer" style="color: #3398FF" class="btn float-right" type="submit">
                    </div>
                </form>
            </div>
    <?php }
    } ?>
</div>

<script>
    $(function() {
        $('#form-chat-add-message').submit(function(event) {
            // cancels the form submission
            event.preventDefault();
            $.get({
                url: "chat.php",
                data: {
                    pseudo: $('#pseudo').val(),
                    message: $('#message').val()
                },
                success: function() {
                    $('#message').val("");
                    autoRefresh_chat();
                }
            })
        })
    })
</script>