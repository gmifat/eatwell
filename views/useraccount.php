<main class="user-account">
    <a href="index.php?p=useraccount&action=disconnect">Se déconnecter</a>
    <?php if ($_SESSION['user']['is_admin'] == 1) : ?>
        <a href="./admin/index.php" target="_blank">Accès à l'admin</a>
    <?php endif; ?>
    <?php
    var_dump($_SESSION['user']); ?>
</main>