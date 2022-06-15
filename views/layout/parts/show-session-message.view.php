<!-- show error message if exists -->
<?php
if (get_session_error(false)) : ?>
    <div class="alert alert-danger my-5">
        <?= get_session_error() ?>
    </div>
<?php
endif;
?>

<!-- show success message if exists -->
<?php
if (get_session_success(false)) : ?>
    <div class="alert alert-success my-5">
        <?= get_session_success() ?>
    </div>
<?php
endif;
?>