<div class="card mx-auto" style="margin-top: 50px; width:300px" width="50%">
    <div class="card-header">
        <h3>Login</h3>
    </div> 
    <form class="formulaire" action="authenticate.php" method="post">
        <div class="card-body">
            
            <div class="input-group form-group">
                <div class="input-group-prepend" >
                    <span class="input-group-text">
                        <i class="fas fa-user" ></i>
                    </span>
                </div>    
                    <input type="text" name="email" id="email" required placeholder="Email">
                    <span class="error" aria-live="polite" id="errormail"></span>
            </div>
            <div class="input-group form-group">
                <div class="input-group-prepend" >
                    <span class="input-group-text">
                        <i class="fas fa-user" ></i>
                    </span>
                </div>    
                    <input type="password" name="password" id="password" required placeholder="Password">
                    <span class="error" aria-live="polite" id="errorpassword"></span>
            </div>
            
            <div class="form-group">
                    <input value="Valider" style="color: #3398FF" class="btn float-right" type="submit">
            </div>
            <div class="form-row">
                <?php if (isset($data['failedAuthent'])): ?>
                    <span class="error-message"><?= $data['failedAuthent'] ?></span>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>