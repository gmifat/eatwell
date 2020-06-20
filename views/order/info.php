    <h2>
        INFORMATION PERSONNELLE
    </h2>
    <hr>
    <div class="order-form-input">
        <label for="firstname">Prénom *</label>
        <input required name="firstname" type="text" id="firstname" value="<?= $_SESSION['order_inputs']['info']['firstname'] ?>">
    </div>
    <div class="order-form-input">
        <label for="lastname">Nom *</label>
        <input required name="lastname" type="text" id="lastname" value="<?= $_SESSION['order_inputs']['info']['lastname'] ?>">
    </div>
    <div class="order-form-input">
        <label for="email">Adresse Email *</label>
        <input required name="email" type="email" id="email" value="<?= $_SESSION['order_inputs']['info']['email'] ?>">
    </div>
    <div class="order-form-input">
        <label for="phonenumber">Téléphone *</label>
        <input required name="phonenumber" type="tel" id="phonenumber" value="<?= $_SESSION['order_inputs']['info']['phonenumber']?>">
    </div>