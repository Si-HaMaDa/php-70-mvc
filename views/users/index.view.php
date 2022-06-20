<?php require get_view_dir('layout/header'); ?>

<div class="content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Users</h1>
        <a class="btn btn-primary" href="<?= make_url('/admin/users/create') ?>"><i data-feather="plus"></i> Add User</a>
    </div>
    <form action="<?= make_url('/admin/users/delete') ?>" method="POST">
        <span>
            <label class="m-0 text-white btn btn-primary" for="select-all">
                <input type="checkbox" id="select-all" /> Select All
            </label>
        </span>
        <button class="btn btn-sm btn-danger float-end" id="confirmDelete"><i data-feather="trash-2"></i> Bulk Delete</button>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Image</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>

                    <tr id="tr-row-<?= $user['id'] ?>">
                        <td>
                            <input class="row-bulk-delete" type="checkbox" name="id[]" value="<?= $user['id'] ?>" id="input-row-<?= $user['id'] ?>" />
                        </td>
                        <td>
                            <label for="input-row-<?= $user['id'] ?>">
                                <?= $user['id'] ?>
                            </label>
                        </td>
                        <td>
                            <label for="input-row-<?= $user['id'] ?>">
                                <?= $user['name'] ?>
                            </label>
                        </td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['age'] ?></td>
                        <td>
                            <img class="img-thumbnail" width="200" src="<?= App\Models\User::get_image($user) ?>" alt="<?= $user['name'] ?>">
                        </td>
                        <td><?= $user['role'] ?></td>
                        <td>
                            <a class="p-2 btn btn-primary show" data-id="<?= $user['id'] ?>" href="<?= make_url('/admin/users/show?id=' . $user['id']) ?>">
                                <i data-feather="eye" class="material-icons opacity-10">visibility</i>
                            </a>
                            <a class="p-2 btn btn-warning edit" data-id="<?= $user['id'] ?>" href="<?= make_url('/admin/users/edit?id=' . $user['id']) ?>">
                                <i data-feather="edit" class="material-icons opacity-10">edit</i>
                            </a>
                            <a class="p-2 btn btn-danger delete" data-id="<?= $user['id'] ?>" data-name="<?= $user['name'] ?>" href="<?= make_url('/admin/users/delete?id=' . $user['id']) ?>">
                                <i data-feather="trash-2" class="material-icons opacity-10">delete</i>
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</div>

<script>
    document.getElementById('confirmDelete').addEventListener('click', function(e) {
        if (!confirm('Are you sure you want to delete these users?'))
            e.preventDefault();
    });
    document.getElementById('select-all').addEventListener('click', function(e) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = e.target.checked;
        });
    });
</script>

<?php require get_view_dir('layout/footer'); ?>