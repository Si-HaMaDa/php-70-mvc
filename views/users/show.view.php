<?php require get_view_dir('layout/header') ?>

<div class="content">
    <div class="card row g-3 my-3" method="post">
        <div class="card-body row">

            <div class="col-12 mb-4 row">
                <label class="col-md-2">ID</label>
                <div class="col-md-10">
                    : <?= $user['id'] ?>
                </div>
            </div>

            <div class="col-12 mb-4 row">
                <label class="col-md-2">Name</label>
                <div class="col-md-10">
                    : <?= $user['name'] ?>
                </div>
            </div>

            <div class="col-12 mb-4 row">
                <label class="col-md-2">Email</label>
                <div class="col-md-10">
                    : <?= $user['email'] ?>
                </div>
            </div>

            <div class="col-12 mb-4 row">
                <label class="col-md-2">Age</label>
                <div class="col-md-10">
                    : <?= $user['age'] ?>
                </div>
            </div>

            <div class="col-12 mb-4 row">
                <label class="col-md-2">Created At</label>
                <div class="col-md-10">
                    : <?= $user['created_at'] ?>
                </div>
            </div>

            <div class="col-12 mb-4 row">
                <label class="col-md-2">Updated At</label>
                <div class="col-md-10">
                    : <?= $user['updated_at'] ?>
                </div>
            </div>

            <div class="col-12 mb-4 row">
                <label class="col-md-2">Image</label>
                <div class="col-md-10">
                    : <img width="50%" src="<?= App\Models\User::get_image($user) ?>" alt="" srcset="">
                </div>
            </div>

        </div>
    </div>
</div>

<?php require get_view_dir('layout/footer') ?>