<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Users</h1>
        <a class="btn btn-primary" href="./../controllers/add-user.php">Add User</a>
    </div>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>

                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['age'] ?></td>
                    <td>
                        <a class="btn btn-primary" href="./../controllers/show-user.php?id=<?= $user['id'] ?>">
                            <img src="https://cdn-icons-png.flaticon.com/512/709/709612.png" alt="Show" width="15">
                        </a>
                        <a class="btn btn-warning" href="./../controllers/edit-user.php?id=<?= $user['id'] ?>">
                            <img src="https://cdn-icons-png.flaticon.com/512/1159/1159633.png" alt="Edit" width="15">
                        </a>
                        <a class="btn btn-danger" href="./../controllers/delete-user.php?id=<?= $user['id'] ?>">
                            <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" alt="Delete" width="15">
                        </a>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>