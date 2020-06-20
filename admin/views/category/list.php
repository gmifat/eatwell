<?php ?>
    <h2><?= $pageTitle ?></h2>
    <a href="index.php?controller=categories&action=new"><img alt="Ajouter" class="add-element" src="assets/images/add.png" /> Ajouter une catégorie</a>

    <div class="table-responsive container-fluid">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th class="width96" scope="col">Icône</th>
                    <th class="width32" scope="col">Vignette</th>
                    <th class="" scope="col">Nom</th>
                    <th class="" scope="col">Description</th>
                    <th class="" scope="col">Couleur</th>
                    <th class="" scope="col">Parent</th>
                    <th class="width32" scope="col">Modifier</th>
                    <th class="width32">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($categories)) :?>
                    <?php foreach ($categories as $category) :?>
                        <tr>
                            <td class="width96"><img class="width96" src="../assets/images/category/icon/<?= !empty($category['icon']) ? $category['icon'] :  'no_image.PNG' ?>"/></td>
                            <td class="width32"><img class="width32" src="../assets/images/category/thumbnail/<?= !empty($category['thumbnail']) ? $category['thumbnail'] :  'no_image.PNG' ?>"/></td>
                            <td class=""><a href="index.php?controller=categories&action=view&id=<?= $category['id']; ?>"><?= $category['name']; ?></a></td>
                            <td class=""><?= $category['description']; ?></td>
                            <td style="background-color: <?= $category['color']; ?>;"><?= $category['color']; ?></td>
                            <td class=""><a href="index.php?controller=categories&action=view&id=<?= $category['parent_id']; ?>"><?= $category['parent_name']; ?></a></td>
                            <td class="width32"><a href="index.php?controller=categories&action=edit&id=<?= $category['id']; ?>"><img class="action-img" alt="Modifier" src="assets/images/edit.png" /></a></td>
                            <td class="width32"><a href="index.php?controller=categories&action=delete&id=<?= $category['id']; ?>"><img class="action-img" alt="Supprimer" src="assets/images/delete.png" /></a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>