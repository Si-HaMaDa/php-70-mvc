<?php session_start();

require __DIR__ . '/vendor/autoload.php';

// Using needed Contollers
use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\UserController;

// Start routing
switch (get_route()) {


        // Auth routes
    case '/register':
        is_guest();
        (new AuthController())->register();
        break;

    case '/do-register': // POST
        is_guest();
        check_allowed_method('POST');
        (new AuthController())->do_register();
        break;

    case '/login':
        is_guest();
        (new AuthController())->login();
        break;

    case '/do-login': // POST
        is_guest();
        check_allowed_method('POST');
        (new AuthController())->do_login();
        break;

    case '/logout':
        check_login();
        (new AuthController())->logout();
        break;

        // Start Admin Routes

    case '/admin':
        check_login();
        $user = (new AdminController())->index();
        break;

        // Start Admin User Routes
    case '/admin/users':
        check_login();
        (new UserController())->index();
        break;

    case '/admin/users/create':
        check_login();
        (new UserController())->create();
        break;

    case '/admin/users/store': // POST
        check_login();
        check_allowed_method('POST');
        (new UserController())->store();
        break;

    case '/admin/users/show':
        check_login();
        (new UserController())->show();
        break;

    case '/admin/users/edit':
        check_login();
        (new UserController())->edit();
        break;

    case '/admin/users/update': // POST
        check_login();
        check_allowed_method('POST');
        (new UserController())->update();
        break;

    case '/admin/users/delete':
        check_login();
        (new UserController())->delete();
        break;
        // End Admin User Routes

    default:
        http_response_code(404);
        get_view('404');
        break;
}
