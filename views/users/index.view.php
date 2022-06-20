<?php

require get_view_dir('layout/header'); ?>

<div class="content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Users</h1>
        <a class="btn btn-primary" href="<?= make_url('/admin/users/create') ?>">Add User</a>
    </div>
    <form action="<?= make_url('/admin/users/delete') ?>" method="POST">
        <span>
            <input type="checkbox" id="select-all" />
            <label for="select-all">Select All</label>
        </span>
        <button class="btn btn-sm btn-danger float-end" id="confirmDelete">Bulk Delete</button>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>

                    <tr>
                        <td>
                            <input type="checkbox" name="id[]" value="<?= $user['id'] ?>" id="user-<?= $user['id'] ?>" />
                        </td>
                        <td>
                            <label for="user-<?= $user['id'] ?>">
                                <?= $user['id'] ?>
                            </label>
                        </td>
                        <td>
                            <label for="user-<?= $user['id'] ?>">
                                <?= $user['name'] ?>
                            </label>
                        </td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['age'] ?></td>
                        <td>
                            <img width="200" src="<?= App\Models\User::get_image($user) ?>" alt="" srcset="">
                        </td>
                        <td>
                            <a class="btn btn-primary" href="<?= make_url('/admin/users/show?id=' . $user['id']) ?>">
                                <img src="https://cdn-icons-png.flaticon.com/512/709/709612.png" alt="Show" width="15">
                            </a>
                            <a class="btn btn-warning" href="<?= make_url('/admin/users/edit?id=' . $user['id']) ?>">
                                <img src="https://cdn-icons-png.flaticon.com/512/1159/1159633.png" alt="Edit" width="15">
                            </a>
                            <a class="btn btn-danger" href="<?= make_url('/admin/users/delete?id=' . $user['id']) ?>">
                                <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" alt="Delete" width="15">
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