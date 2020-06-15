<?php if (isset ($_SESSION['messages_ok'])) : ?>
    <div class="alert alert-success" role="alert">
        <?php foreach ($_SESSION['messages_ok'] as $message) : ?>
            <?= $message ; ?><br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (isset ($_SESSION['messages_ko'])) : ?>
    <div class="alert alert-danger" role="alert">
        <?php foreach ($_SESSION['messages_ko'] as $message) : ?>
            <?= $message ; ?><br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>