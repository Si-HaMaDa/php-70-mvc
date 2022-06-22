<?php require get_view_dir('layout/header'); ?>

<div class="content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Skills</h1>
        <a class="btn btn-primary" href="<?= make_url('/admin/skills/create') ?>"><i data-feather="plus"></i> Add Skill</a>
    </div>
    <form action="<?= make_url('/admin/skills/delete') ?>" method="POST">
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($skills as $skill) : ?>

                    <tr id="tr-row-<?= $skill['id'] ?>">
                        <td>
                            <input class="row-bulk-delete" type="checkbox" name="id[]" value="<?= $skill['id'] ?>" id="input-row-<?= $skill['id'] ?>" />
                        </td>
                        <td>
                            <label for="input-row-<?= $skill['id'] ?>">
                                <?= $skill['id'] ?>
                            </label>
                        </td>
                        <td>
                            <label for="input-row-<?= $skill['id'] ?>">
                                <?= $skill['name'] ?>
                            </label>
                        </td>
                        <td>
                            <a class="p-2 btn btn-primary show" data-id="<?= $skill['id'] ?>" href="<?= make_url('/admin/skills/show?id=' . $skill['id']) ?>">
                                <i data-feather="eye" class="material-icons opacity-10">visibility</i>
                            </a>
                            <a class="p-2 btn btn-warning edit" data-id="<?= $skill['id'] ?>" href="<?= make_url('/admin/skills/edit?id=' . $skill['id']) ?>">
                                <i data-feather="edit" class="material-icons opacity-10">edit</i>
                            </a>
                            <a class="p-2 btn btn-danger delete" data-id="<?= $skill['id'] ?>" data-name="<?= $skill['name'] ?>" href="<?= make_url('/admin/skills/delete?id=' . $skill['id']) ?>">
                                <i data-feather="trash-2" class="material-icons opacity-10">delete</i>
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
    <nav aria-label="Page navigation example text-center">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="<?= make_url('/admin/skills?page=1') ?>">First</a>
            </li>

            <?php for ($i = 1; $total_pages >= $i; $i++) : ?>

                <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                    <a class="page-link " href="<?= make_url('/admin/skills?page=' . $i) ?>">
                        <?= $i ?></a>
                </li>

            <?php endfor; ?>

            <li class="page-item">
                <a class="page-link" href="<?= make_url('/admin/skills?page=' . $total_pages) ?>">Last</a>
            </li>
        </ul>
    </nav>
</div>

<script>
    document.getElementById('confirmDelete').addEventListener('click', function(e) {
        if (!confirm('Are you sure you want to delete these skills?'))
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