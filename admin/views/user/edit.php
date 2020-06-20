<h2><?= $pageTitle ?></h2>
<form method="post" action="index.php?controller=users&action=edit">
    <input name="id" value="<?= $user['id'] ?>" type="hidden">
    <div class="form-group row">
        <label class="col-sm-3" for="last_name">Nom *</label>
        <input class="col-sm-9" name="last_name" type="text" id="last_name" value="<?= $user['last_name'] ?>">
    </div>
    <div class="form-group row">
        <label class="col-sm-3" for="first_name">Prénom *</label>
        <input class="col-sm-9" name="first_name" type="text" id="first_name" value="<?= $user['first_name'] ?>">
    </div>
    <div class="form-group row">
        <label class="col-sm-3" for="email">Adresse Email *</label>
        <input class="col-sm-9" name="email" type="email" id="email" value="<?= $user['email'] ?>">
    </div>
    <div class="form-group row">
        <label class="col-sm-3" for="password">Mot de passe *</label>
        <input class="col-sm-9" name="password" type="password" id="password" minlength="8">
        <span class="col-sm-3 text-muted" >Minimum 8 caractères</span>
    </div>
    <div class="form-group row">
        <label class="col-sm-3" for="password-confirm">Confirmation mot de passe *</label>
        <input class="col-sm-9" name="password-confirm" type="password" id="password-confirm">
    </div>
    <div class="form-group row">
        <label class="col-sm-3" for="is_admin">Est un Administrateur ?</label>
        <select class="col-sm-9" name="is_admin" id="is_admin">
            <option value="0" <?= $user['is_admin'] == 0 ? 'selected' : '' ?>>Non</option>
            <option value="1" <?= $user['is_admin'] == 1 ? 'selected' : '' ?>>Oui</option>
        </select>
    </div>
    <button type="submit" class="btn btn-secondary btn-lg"><span class="fa fa-save"></span>
        Modifier
    </button>
    <a class="btn btn-info btn-lg" href="index.php?controller=users&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
</form>
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