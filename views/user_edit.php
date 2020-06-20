<main class="user-edit-info">
    <h2>
        INFORMATION PERSONNELLE
    </h2>
    <hr>
    <form method="post" action="index.php?p=useraccount&action=edit">
        <input name="id" value="<?= $user['id'] ?>" type="hidden">
        <div class="order-form-input">
            <label for="first_name">Prénom *</label>
            <input required name="first_name" type="text" id="first_name" value="<?= $user['first_name'] ?>">
        </div>
        <div class="order-form-input">
            <label for="last_name">Nom *</label>
            <input required name="last_name" type="text" id="last_name" value="<?= $user['last_name'] ?>">
        </div>
        <div class="order-form-input">
            <label for="email">Adresse Email *</label>
            <input required name="email" type="email" id="email" value="<?= $user['email'] ?>">
        </div>
        <div class="order-form-input">
            <label for="phone_number">Téléphone</label>
            <input name="phone_number" type="tel" id="phone_number" value="<?= $user['phone_number']?>">
        </div>

        <div class="order-form-input">
            <label for="password">Mot de passe * (Minimum 8 caractères)</label>
            <input name="password" type="password" id="password" minlength="8">
        </div>
        <div class="order-form-input">
            <label for="password-confirm">Confirmation mot de passe *</label>
            <input name="password-confirm" type="password" id="password-confirm">
        </div>
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
        <br>
        <h2>
            ADRESSE DE LIVRAISON
        </h2>
        <hr>
        <input name="delivery_address_id" value="<?= $user['delivery_address_id'] ?>" type="hidden">
        <div class="order-form-input">
            <label for="street_name">Adresse *</label>
            <input required name="street_name" type="text" id="street_name" value="<?= $user['delivery_address']['street_name'] ?>">
        </div>
        <div class="order-form-input">
            <label for="complementary_address_1">Complément d'adresse</label>
            <input placeholder="complément d'adresse" name="complementary_address_1" type="text" id="complementary_address_1" value="<?= $user['delivery_address']['complementary_address_1'] ?>">
        </div>
        <div class="order-form-input">
            <label for="complementary_address_2"></label>
            <input placeholder="complément d'adresse 2" name="complementary_address_2" type="text" id="complementary_address_2" value="<?= $user['delivery_address']['complementary_address_2']?>">
        </div>
        <div class="order-form-input">
            <label for="city">Ville *</label>
            <input required name="city" type="text" id="city" value="<?= $user['delivery_address']['city']?>">
        </div>
        <div class="order-form-input">
            <label for="postal_code">Code postale *</label>
            <input required name="postal_code" type="text" minlength="5" maxlength="5"  id="postal_code" value="<?= $user['delivery_address']['postal_code'] ?>">
        </div>
        <div class="order-form-input-check">
            <input id="user-address-invoice" name="address-invoice" type="checkbox" id="address-invoice" <?= $user['delivery_address']['address-invoice'] == 1  ? 'checked' : '' ?>>
            <label for="address-invoice">Utiliser la même adresse de livraison pour la facturation</label>
        </div>
        <br>
        <div class="user-address-billing">
            <h2>
                ADRESSE DE FACTURATION
            </h2>
            <hr>
            <input name="billing_address_id" value="<?= $user['billing_address_id'] ?>" type="hidden">
            <div class="order-form-input">
                <label for="billing-address">Adresse *</label>
                <input name="billing-address" type="text" id="billing-address" value="<?= $user['billing_address']['street_name'] ?>">
            </div>
            <div class="order-form-input">
                <label for="billing-complementary_address_1">Complément d'adresse</label>
                <input placeholder="complément d'adresse" name="billing-complementary_address_1" type="text" id="billing-complementary_address_1" value="<?= $user['billing_address']['complementary_address_1'] ?>">
            </div>
            <div class="order-form-input">
                <label for="billing-complementary_address_2"></label>
                <input placeholder="complément d'adresse 2" name="billing-complementary_address_2" type="text" id="billing-complementary_address_2" value="<?= $user['billing_address']['complementary_address_2']?>">
            </div>
            <div class="order-form-input">
                <label for="billing-city">Ville *</label>
                <input name="billing-city" type="text" id="billing-city" value="<?= $user['billing_address']['city']?>">
            </div>
            <div class="order-form-input">
                <label for="billing-postal_code">Code postale *</label>
                <input name="billing-postal_code" type="text" minlength="5" maxlength="5"  id="billing-postal_code" value="<?= $user['billing_address']['postal_code'] ?>">
            </div>
        </div>
        <input class="bottom" type="submit" value="Sauvegarder">
    </form>
</main>