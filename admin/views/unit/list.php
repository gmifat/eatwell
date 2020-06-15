<?php ?>
    <h2><?= $pageTitle ?></h2>
    <a href="index.php?controller=units&action=new"><img alt="Ajouter" class="add-element" src="assets/images/add.png" /> Ajouter une unité</a>

    <div class="table-responsive container-fluid">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th class="" scope="col">Nom</th>
                    <th class="" scope="col">Symbole</th>
                    <th class="width32" scope="col">Modifier</th>
                    <th class="width32">Supprimer</th>
                </tr>
            </thead>
            <tbody>
            <?php if (isset($units)) :?>
                <?php foreach ($units as $unit) :?>
                    <tr>
                        <td class=""><a href="index.php?controller=units&action=view&id=<?= $unit['id']; ?>"><?= $unit['name']; ?></a></td>
                        <td class=""><?= $unit['symbol']; ?></td>
                        <td class="width32"><a href="index.php?controller=units&action=edit&id=<?= $unit['id']; ?>"><img class="action-img" alt="Modifier" src="assets/images/edit.png" /></a></td>
                        <td class="width32"><a href="index.php?controller=units&action=delete&id=<?= $unit['id']; ?>"><img class="action-img" alt="Supprimer" src="assets/images/delete.png" /></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>