<?php require get_view_dir('layout/header'); ?>

<div class="content">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Show Skill</h1>
        <a class="btn btn-secondary float-end clearfix" href="<?= make_url('/admin/skills') ?>">Back to Skills</a>
    </div>

    <div class="card row g-3 my-3">
        <div class="card-body row">

            <div class="col-12 mb-4 row">
                <label class="col-md-2">ID</label>
                <div class="col-md-10">
                    : <?= $skill['id'] ?>
                </div>
            </div>

            <div class="col-12 mb-4 row">
                <label class="col-md-2">Name</label>
                <div class="col-md-10">
                    : <?= $skill['name'] ?>
                </div>
            </div>

        </div>
    </div>

    <a class="btn btn-secondary float-end" href="<?= make_url('/admin/skills') ?>">Back to Skills</a>
</div>

<?php require get_view_dir('layout/footer'); ?>