<?php ?>
<h2><?= $pageTitle ?></h2>

<form action="index.php?controller=newsletters&action=delete_all" method="post"  enctype="multipart/form-data">
    <table class="table table-hover">
        <thead class="thead-light">
        <tr>
            <th class="width32" scope="col">Email</th>
            <th class="" scope="col">Date d'inscription</th>
        </tr>
        </thead>
        <tbody>

        <?php if (isset($newsletters)) :?>
            <?php foreach ($newsletters as $newsletter) :?>
                <tr>
                    <input name="id" value="<?= $newsletter['id'] ?>" type="hidden">
                    <td class=""><?= $newsletter['email']; ?></td>
                    <td class=""><?= $newsletter['registration_date']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
    <br>
    <button type="submit" class="btn btn-danger btn-lg"><span class="fa fa-trash-alt"></span>
        Supprimer tout
    </button>
    <a class="btn btn-info btn-lg" href="index.php?controller=newsletters&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
</form>
