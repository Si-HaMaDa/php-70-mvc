<?php require get_view_dir('layout/header'); ?>

<div class="content">

    <!-- Show Errors if exists -->
    <?php include get_view_dir('layout/parts/show-errors'); ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Skill</h1>
        <a class="btn btn-secondary float-end clearfix" href="<?= make_url('/admin/skills') ?>">Back to Skills</a>
    </div>
    <form class="card row g-3 my-3" method="post" action="<?= make_url('/admin/skills/store') ?>" enctype="multipart/form-data">
        <div class="card-body row">

            <div class="col-sm-12">
                <label for="Name" class="form-label">Name</label>
                <input type="text" class="form-control" id="Name" name="name" placeholder="" value="<?= get_old_value('name') ?>" required>
                <div class="invalid-feedback">
                    Valid name is required.
                </div>
            </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" type="submit">Save</button>
        </div>
    </form>
    <a class="btn btn-secondary float-end clearfix" href="<?= make_url('/admin/skills') ?>">Back to Skills</a>
</div>

<?php require get_view_dir('layout/footer'); ?>