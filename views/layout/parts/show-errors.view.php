<!-- show error if exists -->
<?php
if (isset($_SESSION['errors'])) : ?>
    <div class="alert alert-danger my-5">
        <!-- loop and show errors -->
        <?php foreach ($_SESSION['errors'] as $key => $error) : ?>
            <p>
                <?= $key ?>:
                <br>
                <?= $error ?>
            </p>
        <?php endforeach; ?>
    </div>
<?php
    // Remove errors from session
    unset($_SESSION['errors']);
endif;
?>