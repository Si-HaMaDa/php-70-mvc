<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>403 FORBIDDEN AREA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="text-center row">
            <div class=" col-md-6">
                <img src="https://conectemos.com/wp-content/uploads/2021/03/Error-403-Prohibido.png" alt="403" class="img-fluid">
            </div>
            <div class=" col-md-6 mt-5 align-self-center">
                <p class="fs-3"> <span class="text-danger">Opps!</span> <b>FORBIDDEN AREA.</b></p>
                <p class="lead">
                    Please get the permission to access this area.
                </p>
                <a href="<?= make_url(HOME_URL) ?>" class="btn btn-primary">Go Home</a>
                <a href="<?= make_url('/logout') ?>" class="btn btn-danger">Logout</a>
            </div>

        </div>
    </div>
</body>

</html>
