<h2><?= $pageTitle ?></h2>

<form action="index.php?controller=users&action=delete" method="post"  enctype="multipart/form-data">
    <div class="form-group row">
        <input name="id" value="<?= $user['id'] ?>" type="hidden">
    </div>
    <table class="table-responsive">
        <tbody>
        <tr>
            <th scope="row">Nom  :</th>
            <td><?= $user['last_name'];?></td>
        </tr>
        <tr>
            <th scope="row">Prénom  :</th>
            <td><?= $user['first_name'];?></td>
        </tr>
        <tr>
            <th scope="row">Email  :</th>
            <td><?= $user['email'];?></td>
        </tr>
        <tr>
            <th scope="row">Téléphone  :</th>
            <td><?= $user['phone_number'];?></td>
        </tr>
        <tr>
            <th scope="row">Administrateur ? :</th>
            <td><img src="../assets/images/<?= $user['is_admin'];?>.png"></td>
        </tr>
        </tbody>
    </table>
    <br>
    <button type="submit" class="btn btn-danger btn-lg"><span class="fa fa-trash-alt"></span>
        Supprimer
    </button>
    <a class="btn btn-info btn-lg" href="index.php?controller=users&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
</form>
