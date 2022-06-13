<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Customer</h1>
    </div>
    <form class="card row g-3 my-3" method="post">
        <div class="card-body row">
            <div class="col-sm-6">
                <label for="firstName" class="form-label">First name</label>
                <input type="text" class="form-control" id="firstName" name="firstname" placeholder="" value="" required="">
                <div class="invalid-feedback">
                    Valid first name is required.
                </div>
            </div>

            <div class="col-sm-6">
                <label for="lastName" class="form-label">Last name</label>
                <input type="text" class="form-control" id="lastName" name="lastname" placeholder="" value="" required="">
                <div class="invalid-feedback">
                    Valid last name is required.
                </div>
            </div>

            <div class="col-12">
                <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
            </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" type="submit">Save</button>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>