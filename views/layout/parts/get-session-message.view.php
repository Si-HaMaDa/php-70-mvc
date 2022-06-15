<?php if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-success my-5">
        <?= $_SESSION['success'] ?>
        <?php unset($_SESSION['success']) ?>
    </div>
<?php endif; ?>

<?php if (get_error_message(false)) : ?>
    <div class="alert alert-danger my-5">
        <?= get_error_message() ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['errors'])) : ?>
    <div class="alert alert-danger my-5">
        <?php
        foreach ($_SESSION['errors'] as $key => $error) {

            echo $key . ':<br>';
            echo $error . '<br><br>';
        }
        ?>
        <?php unset($_SESSION['errors']) ?>
    </div>
<?php endif; ?>