<?php session_start();

require __DIR__ . '/vendor/autoload.php';

// Using needed Contollers
use App\Controllers\UserController;

// Start routing
switch (get_route()) {
        // Start Admin Routes
        // Start Admin User Routes
    case '/admin/users':
        (new UserController())->index();
        break;

    case '/admin/users/create':
        (new UserController())->create();
        break;

    case '/admin/users/store': // POST
        check_allowed_method('POST');
        (new UserController())->store();
        break;

    case '/admin/users/show':
        (new UserController())->show();
        break;

    case '/admin/users/edit':
        (new UserController())->edit();
        break;

    case '/admin/users/update': // POST
        check_allowed_method('POST');
        (new UserController())->update();
        break;

    case '/admin/users/delete':
        (new UserController())->delete();
        break;
        // End Admin User Routes

    default:
        http_response_code(404);
        get_view('404');
        break;
}
