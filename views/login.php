<link rel="stylesheet" href="assets/css/login.css">
<main class="login">
    <div class="login-container">
        <h2>Se connecter</h2>
        <form method="post" action="index.php?p=useraccount&action=login">
            <div class="login-email">
                <label for="email">Adresse Email *</label>
                <input name="email" type="email" id="email">
            </div>
            <div class="login-password-name">
                <label for="password">Mot de passe *</label>
                <input name="password" type="password" id="password">
            </div>
            <div class="login-lost-password">
                <a href="index.php?p=useraccount&action=lost">Mot de passe oublié</a>
            </div>
            <div class="login-action">
                <a href="index.php?p=useraccount&action=new">Créer un compte</a>
                <button type="submit" class="cart-product-add">Login</button>
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