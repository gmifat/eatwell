<?php ?>
<!--
<nav class="navbar navbar-light bg-info">
    <a class="navbar-brand" href="#">
        <img src="assets/images/admin.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
        EatWell admin
    </a>
    <a class="nav-link navbar-dark navbar-brand" href="../index.php">Retour au site</a>
    <a class="nav-link navbar-dark navbar-brand" href="../index.php?disconnect">Déconnexion</a>
</nav>
!-->
<nav class="navbar navbar-expand-lg navbar-light bg-info">
    <a class="navbar-brand" href="#">
        <img src="assets/images/admin.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
        EatWell admin
    </a>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <?php if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && $_SESSION['user']['is_admin'] == 1) : ?>
                    <a class="nav-link " href="index.php?controller=useraccount&action=view">Bienvenue <?= $_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name'] ?></a>
                <?php endif; ?>
            </li>
        </ul>
        <span class="navbar-text">
          <a class="nav-link navbar-dark navbar-brand" href="../index.php" target="_blank">EatWell.fr<img style="width: 12px;margin: 0 0 16px 5px;" src="assets/images/out.png"></a>
            <?php if ($pageTitle != 'Admin') : ?>
                <a class="nav-link navbar-dark navbar-brand" href="index.php?disconnect">Déconnexion</a>
            <?php endif; ?>
        </span>

    </div>
</nav>