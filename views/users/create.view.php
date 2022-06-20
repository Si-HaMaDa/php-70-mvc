<?php require get_view_dir('layout/header'); ?>

<div class="content">

    <!-- Show Errors if exists -->
    <?php include get_view_dir('layout/parts/show-errors'); ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add User</h1>
        <a class="btn btn-secondary float-end clearfix" href="<?= make_url('/admin/users') ?>">Back to Users</a>
    </div>
    <form class="card row g-3 my-3" method="post" action="<?= make_url('/admin/users/store') ?>" enctype="multipart/form-data">
        <div class="card-body row">

            <div class="col-sm-12">
                <label for="Name" class="form-label">Name</label>
                <input type="text" class="form-control" id="Name" name="name" placeholder="" value="<?= get_old_value('name') ?>" required>
                <div class="invalid-feedback">
                    Valid name is required.
                </div>
            </div>

            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="<?= get_old_value('email') ?>" required>
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
            </div>

            <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                <div class="invalid-feedback">
                    Please enter a valid password.
                </div>
            </div>

            <div class="col-12">
                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="" required>
                <div class="invalid-feedback">
                    Please enter a valid password_confirmation.
                </div>
            </div>

            <div class="col-12">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" name="role" id="role" required>
                    <option <?= get_old_value('role', false) == 'user' ? 'selected' : '' ?> value="user">User</option>
                    <option <?= get_old_value('role') == 'admin' ? 'selected' : '' ?> value="admin">Admin</option>
                </select>
                <div class="invalid-feedback">
                    Valid Role is required.
                </div>
            </div>

            <div class="col-12">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" name="gender" id="gender" required>
                    <option <?= get_old_value('gender', false) == 'm' ? 'selected' : '' ?> value="m">Male</option>
                    <option <?= get_old_value('gender') == 'f' ? 'selected' : '' ?> value="f">Female</option>
                </select>
                <div class="invalid-feedback">
                    Valid Gender is required.
                </div>
            </div>

            <div class="col-12">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" placeholder="" value="<?= get_old_value('age') ?>" required>
                <div class="invalid-feedback">
                    Valid age is required.
                </div>
            </div>

            <div class="col-12">
                <label for="title" class="form-label">Job Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="" value="<?= get_old_value('title') ?>" required>
                <div class="invalid-feedback">
                    Valid title is required.
                </div>
            </div>

            <div class="col-12">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" aria-label="Image" value="<?= get_old_value('image') ?>">
                <div class="invalid-feedback">
                    Valid Image is required.
                </div>
            </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" type="submit">Save</button>
        </div>
    </form>
    <a class="btn btn-secondary float-end clearfix" href="<?= make_url('/admin/users') ?>">Back to Users</a>
</div>

<?php require get_view_dir('layout/footer'); ?>