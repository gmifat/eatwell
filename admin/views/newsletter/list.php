<?php ?>
    <h2><?= $pageTitle ?></h2>
    <div class="table-responsive container-fluid">
        <form action="index.php?controller=newsletters&action=delete" method="post">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <!--<th class="width32" scope="col">Choix</th>-->
                        <th class="width32" scope="col">Email</th>
                        <th class="" scope="col">Date d'inscription</th>
                        <th class="width32">Supprimer</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if (isset($newsletters)) :?>
                        <?php foreach ($newsletters as $newsletter) :?>
                            <tr>
                                <!--<td class=""><input type="checkbox" name="newsletters[]" value="<?= $newsletter['id']; ?>"></td>-->
                                <td class=""><?= $newsletter['email']; ?></td>
                                <td class=""><?= $newsletter['registration_date']; ?></td>
                                <td class="width32"><a href="index.php?controller=newsletters&action=delete&id=<?= $newsletter['id']; ?>"><img class="action-img" alt="Supprimer" src="assets/images/delete.png" /></a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <!--<button type="submit" class="btn btn-danger btn-lg"><span class="fa fa-trash-alt"></span>
                Supprimer les éléments sélectionnés
            </button>-->
        </form>
    </div>