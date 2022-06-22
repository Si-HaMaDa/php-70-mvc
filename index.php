<?php session_start();

require __DIR__ . '/vendor/autoload.php';

// Using needed Contollers
use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Middleware\Middleware;

// Start routing
switch (get_route()) {


        // Auth routes
    case '/register':
        new Middleware(['is_guest']);
        (new AuthController())->register();
        break;

    case '/do-register': // POST
        new Middleware(['is_guest', 'check_allowed_method:POST']);
        (new AuthController())->do_register();
        break;

    case '/login':
        new Middleware('is_guest');
        (new AuthController())->login();
        break;

    case '/do-login': // POST
        new Middleware('is_guest|check_allowed_method:POST');
        (new AuthController())->do_login();
        break;

    case '/logout':
        new Middleware('check_login');
        (new AuthController())->logout();
        break;

        // Start Admin Routes

    case '/admin':
        new Middleware('is_admin');
        $user = (new AdminController())->index();
        break;

        // Start Admin User Routes
    case '/admin/users':
        new Middleware('is_admin');
        (new UserController())->index();
        break;

    case '/admin/users/create':
        new Middleware('is_admin');
        (new UserController())->create();
        break;

    case '/admin/users/store': // POST
        new Middleware('is_admin|check_allowed_method:POST');
        (new UserController())->store();
        break;

    case '/admin/users/show':
        new Middleware('is_admin');
        (new UserController())->show();
        break;

    case '/admin/users/edit':
        new Middleware('is_admin');
        (new UserController())->edit();
        break;

    case '/admin/users/update': // POST
        new Middleware('is_admin|check_allowed_method:POST');
        (new UserController())->update();
        break;

    case '/admin/users/delete':
        new Middleware('is_admin');
        (new UserController())->delete();
        break;
        // End Admin User Routes

    default:
        http_response_code(404);
        get_view('404');
        break;
}
