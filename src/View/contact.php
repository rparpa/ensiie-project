
<div style="margin: 10em">
    <div style="margin: 0; padding: 0;">
        <form onsubmit="SendMessage()">
            <fieldset>
                <legend>Contactez-nous</legend>
                <div class="row">
                    <div class="col-md">
                        <div>
                            <label for="Name" style="margin: 0">Name<br/>
                                <input type="text" name="Name" id="Name" value="" required>
                            </label>
                        </div>
                        <div>
                            <label for="Email" style="margin: 0">Email<br/>
                                <input type="email" name="Email" id="Email" value="" required>
                            </label>
                        </div>
                        <div>
                            <label for="Subject" style="margin: 0">Subject<br/>
                                <input name="Subject" id="Subject" value="" required>
                            </label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div>
                            <label for="Message" style="margin: 0">Message<br/>
                                <textarea id="Message" name="Message" value="" rows="6" required></textarea>
                            </label>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit"">Envoyer</button>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<script>
    function SendMessage() {
        alert('Votre message a bien été transmis.')
    }


</script>