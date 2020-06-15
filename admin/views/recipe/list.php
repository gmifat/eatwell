<?php ?>
    <h2><?= $pageTitle ?></h2>
    <a href="index.php?controller=recipes&action=new"><img alt="Ajouter" class="add-element" src="assets/images/add.png" /> Ajouter une recette</a>

    <div class="table-responsive container-fluid">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th class="" scope="col">Nom</th>
                    <th class="" scope="col">Description</th>
                    <th class="width32" scope="col">Modifier</th>
                    <th class="width32">Supprimer</th>
                </tr>
            </thead>
            <tbody>
            <?php if (isset($recipes)) :?>
                <?php foreach ($recipes as $recipe) :?>
                    <tr>
                        <td class=""><a href="index.php?controller=recipes&action=view&id=<?= $recipe['id']; ?>"><?= $recipe['name']; ?></a></td>
                        <td class=""><?= $recipe['description']; ?></td>
                        <td class="width32"><a href="index.php?controller=recipes&action=edit&id=<?= $recipe['id']; ?>"><img class="action-img" alt="Modifier" src="assets/images/edit.png" /></a></td>
                        <td class="width32"><a href="index.php?controller=recipes&action=delete&id=<?= $recipe['id']; ?>"><img class="action-img" alt="Supprimer" src="assets/images/delete.png" /></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>