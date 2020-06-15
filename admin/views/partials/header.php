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
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
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