<?php require get_view_dir('layout/header'); ?>

<div class="content">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Show User</h1>
        <a class="btn btn-secondary float-end clearfix" href="<?= make_url('/admin/users') ?>">Back to Users</a>
    </div>

    <div class="card row g-3 my-3">
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
                <label class="col-md-2">Role</label>
                <div class="col-md-10">
                    : <?= $user['role'] ?>
                </div>
            </div>

            <div class="col-12 mb-4 row">
                <label class="col-md-2">Gender</label>
                <div class="col-md-10">
                    : <?= $user['gender'] ?>
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
                    : <img class="img-thumbnail m-1" width="95%" src="<?= App\Models\User::get_image($user) ?>" alt="<?= $user['name'] ?>">
                </div>
            </div>

        </div>
    </div>

    <a class="btn btn-secondary float-end" href="<?= make_url('/admin/users') ?>">Back to Users</a>
</div>

<?php require get_view_dir('layout/footer'); ?>