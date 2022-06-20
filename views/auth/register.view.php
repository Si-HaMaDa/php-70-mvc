<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Register</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <script>
        const FULL_URL = "<?= FULL_URL ?>";
    </script>

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/5.0/examples/sign-in/signin.css" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin">

        <!-- Show Errors if exists -->
        <?php include get_view_dir('layout/parts/show-errors'); ?>
        <?php include get_view_dir('layout/parts/show-session-message'); ?>

        <form method="POST" action="<?= make_url('/do-register') ?>" class="">
            <img class="mb-4" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please sign UP</h1>

            <div class="form-floating m-2">
                <input type="text" class="form-control" id="name" name="name" value="<?= get_old_value('name') ?>" placeholder="Name">
                <label for="name">Name</label>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-floating m-2">
                <input type="email" class="form-control" id="email" name="email" value="<?= get_old_value('email') ?>" placeholder="name@example.com">
                <label for="email">Email address</label>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-floating m-2">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="password">Password</label>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-floating m-2">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="password_confirmation">
                <label for="password_confirmation">Password Confirmation</label>
            </div>

            <div class="form-floating m-2">
                <select class="form-select" name="gender" id="gender" required>
                    <option selected disabled value="">Select Gender</option>
                    <option <?= get_old_value('gender', false) == 'm' ? 'selected' : '' ?> value="m">Male</option>
                    <option <?= get_old_value('gender') == 'f' ? 'selected' : '' ?> value="f">Female</option>
                </select>
                <label for="gender" class="form-label">Gender</label>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-floating m-2">
                <input type="number" class="form-control" id="age" name="age" value="<?= get_old_value('age') ?>" placeholder="21">
                <label for="age">Age</label>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-floating m-2">
                <input type="text" class="form-control" id="title" name="title" value="<?= get_old_value('title') ?>" placeholder="21">
                <label for="title">Title</label>
                <div class="invalid-feedback"></div>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign UP</button>
            <p class="mt-4 mb-3 text-muted">&copy; 2017–2022</p>
            <p class="m-1 mb-3 text-muted">
                Have an account?! <a href="<?= make_url('/login') ?>">Login Now!</a>
            </p>
        </form>
    </main>

    <!-- Jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script src="<?= make_url('/assets/js/check-email.js') ?>"></script>

</body>

</html>