<?php require get_view_dir('layout/header'); ?>

<div class="content">

    <!-- Show Errors if exists -->
    <?php include get_view_dir('layout/parts/show-errors'); ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit User</h1>
        <a class="btn btn-secondary float-end clearfix" href="<?= make_url('/admin/users') ?>">Back to Users</a>
    </div>
    <form class="card row g-3 my-3" method="post" action="<?= make_url('/admin/users/update?id=' . $user['id']) ?>" enctype="multipart/form-data">
        <div class="card-body row">

            <div class="col-sm-12">
                <label for="Name" class="form-label">Name</label>
                <input type="text" class="form-control" id="Name" name="name" placeholder="" value="<?= get_old_value('name') ?? $user['name'] ?>" required>
                <div class="invalid-feedback">
                    Valid name is required.
                </div>
            </div>

            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="<?= get_old_value('email') ?? $user['email'] ?>">
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
            </div>

            <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="">
                <div class="invalid-feedback">
                    Please enter a valid password.
                </div>
            </div>

            <div class="col-12">
                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="">
                <div class="invalid-feedback">
                    Please enter a valid password_confirmation.
                </div>
            </div>

            <div class="col-12">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" name="role" id="role" required>
                    <option <?= (get_old_value('role', false) ?? $user['role']) == 'user' ? 'selected' : '' ?> value="user">User</option>
                    <option <?= (get_old_value('role') ?? $user['role']) == 'admin' ? 'selected' : '' ?> value="admin">Admin</option>
                </select>
                <div class="invalid-feedback">
                    Valid Role is required.
                </div>
            </div>

            <div class="col-12">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" name="gender" id="gender" placeholder="Gender" value="<?= $user['gender'] ?>" required>
                    <option <?= (get_old_value('gender', false) ?? $user['gender']) == 'm' ? 'selected' : '' ?> value="m">Male</option>
                    <option <?= (get_old_value('gender') ?? $user['gender']) == 'f' ? 'selected' : '' ?> value="f">Female</option>
                </select>
                <div class="invalid-feedback">
                    Valid Gender is required.
                </div>
            </div>

            <div class="col-12">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" placeholder="Age" value="<?= get_old_value('age') ?? $user['age'] ?>" required="">
                <div class="invalid-feedback">
                    Valid age is required.
                </div>
            </div>

            <div class="col-12">
                <label for="title" class="form-label">Job Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Job Title" value="<?= get_old_value('title') ?? $user['title'] ?>" required="">
                <div class="invalid-feedback">
                    Valid title is required.
                </div>
            </div>
            
            <div class="col-12">
                <label for="skills" class="form-label">Your Skills</label>
                <select class="form-select" name="skills[]" id="skills" multiple required>
                    <?php foreach ($skills as $skill) : ?>
                        <option <?= in_array($skill['id'], $user['skills']) ? 'selected' : '' ?> value="<?= $skill['id'] ?>"><?= $skill['name'] ?></option>
                    <?php endforeach; ?>
                    <?php get_old_value('skills') ?>
                </select>
                <div class="invalid-feedback">
                    Valid Skill is required.
                </div>
            </div>


            <div class="col-12">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" aria-label="Image" value="<?= get_old_value('image') ?>">
                <img class="img-thumbnail" width="50%" src="<?= App\Models\User::get_image($user) ?>" alt="<?= $user['title'] ?>">
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