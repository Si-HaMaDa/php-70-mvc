<?php require get_view_dir('layout/header') ?>

<div class="content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Customer</h1>
    </div>
    <form class="card row g-3 my-3" method="post" action="<?= make_url('/admin/users/update?id=' . $user['id']) ?>">
        <div class="card-body row">
            <div class="col-sm-12">
                <label for="Name" class="form-label">Name</label>
                <input type="text" class="form-control" id="Name" name="name" placeholder="" value="<?= $user['name'] ?>" required>
                <div class="invalid-feedback">
                    Valid first name is required.
                </div>
            </div>

            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="<?= $user['email'] ?>">
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
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" name="gender" id="gender" placeholder="Gender" value="<?= $user['gender'] ?>" required>
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                </select>
                <div class="invalid-feedback">
                    Valid Gender is required.
                </div>
            </div>

            <div class="col-12">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" placeholder="Age" value="<?= $user['age'] ?>" required="">
                <div class="invalid-feedback">
                    Valid age is required.
                </div>
            </div>

            <div class="col-12">
                <label for="title" class="form-label">Job Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Job Title" value="<?= $user['title'] ?>" required="">
                <div class="invalid-feedback">
                    Valid title is required.
                </div>
            </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" type="submit">Save</button>
        </div>
    </form>
</div>

<?php require get_view_dir('layout/footer') ?>