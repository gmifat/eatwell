<?php ?>
<h2><?= $pageTitle ?></h2>

<form action="index.php?controller=newsletters&action=delete" method="post"  enctype="multipart/form-data">
    <div class="form-group row">
        <input name="id" value="<?= $newsletter['id'] ?>" type="hidden">
    </div>
    <table class="table-responsive">
        <tbody>
            <tr>
                <th scope="row">Nom  :</th>
                <td><?= $newsletter['email'];?></td>
            </tr>
            <tr>
                <th scope="row">Date d'inscription  :</th>
                <td><?= $newsletter['registration_date'];?></td>
            </tr>
        </tbody>
    </table>
    <br>
    <button type="submit" class="btn btn-danger btn-lg"><span class="fa fa-trash-alt"></span>
        Supprimer
    </button>
    <a class="btn btn-info btn-lg" href="index.php?controller=newsletters&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
</form>
