<?php ?>
    <h2><?= $pageTitle ?></h2>
    <a href="index.php?controller=users&action=new"><img alt="Ajouter" class="add-element" src="assets/images/add.png" /> Ajouter un utilisateur</a>

    <div class="table-responsive container-fluid">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th class="" scope="col">Id</th>
                    <th class="" scope="col">Nom</th>
                    <th class="" scope="col">Prénom</th>
                    <th class="" scope="col">Email</th>
                    <th class="" scope="col">Admin</th>
                    <th class="width32" scope="col">Modifier</th>
                    <th class="width32">Supprimer</th>
                </tr>
            </thead>
            <tbody>
            <?php if (isset($users)) :?>
                <?php foreach ($users as $user) :?>
                    <tr>
                        <td class=""><?= $user['id']; ?></td>
                        <td class=""><?= $user['last_name']; ?></td>
                        <td class=""><?= $user['first_name']; ?></td>
                        <td class=""><?= $user['email']; ?></td>
                        <td class=""><img src="../assets/images/<?= $user['is_admin']; ?>.png"></td>
                        <td class="width32"><a href="index.php?controller=users&action=edit&id=<?= $user['id']; ?>"><img class="action-img" alt="Modifier" src="assets/images/edit.png" /></a></td>
                        <td class="width32"><a href="index.php?controller=users&action=delete&id=<?= $user['id']; ?>"><img class="action-img" alt="Supprimer" src="assets/images/delete.png" /></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>