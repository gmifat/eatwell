<link rel="stylesheet" href="assets/css/login.css">
<main class="login">
    <div class="login-container">
        <h2>Créer votre compte</h2>
        <form method="post" action="index.php?p=useraccount&action=create">
            <div class="login-name">
                <div class="login-first-name">
                    <label for="first-name">Prénom *</label>
                    <input required name="first-name" type="text" id="first-name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['first-name'] : '' ?>">
                </div>
                <div class="login-last-name">
                    <label for="last-name">Nom *</label>
                    <input required name="last-name" type="text" id="last-name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['last-name'] : '' ?>">
                </div>
            </div>
            <div class="login-email">
                <label for="email">Adresse Email *</label>
                <input required name="email" type="email" id="email" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['email'] : '' ?>">
            </div>
            <div class="login-password">
                <div class="login-password-name">
                    <label for="password">Mot de passe *</label>
                    <input name="password" type="password" id="password" minlength="8" required>
                    <span>Minimum 8 caractères</span>
                </div>
                <div class="login-password-confirm">
                    <label for="password-confirm">Confirmation mot de passe *</label>
                    <input required name="password-confirm" type="password" id="password-confirm">
                </div>
            </div>
            <div class="login-condition">
                <input required style="width: auto" type="checkbox" name="accept-condition" id="accept-condition">
                <label for="accept-condition">J'accepte les conditions générales et la politique de confidentialité. *</label>
            </div>
            <div class="login-action">
                <a href="index.php?p=useraccount&action=login">Se connecter à un compte existant</a>
                <button type="submit" class="cart-product-add">Créer votre compte</button>
            </div>
        </form>
        <div class="login-help">
            Les champs marqués d'un astérisque (*) sont obligatoires.
        </div>
    </div>
    <div class="login-image">
        <img src="assets/images/login/1.jpg">
    </div>
</main>
<hr>
<script type="text/javascript">
    let password = document.getElementById("password")
        , confirm_password = document.getElementById("password-confirm");

    function validatePassword(){
        if(password.value !== confirm_password.value) {
            confirm_password.setCustomValidity("Les mots de passes ne sont pas identiques");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>
<?php