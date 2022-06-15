<?php

require __DIR__ . '/vendor/autoload.php';

use App\Controllers\UserController;

switch (get_route()) {
        // Start Admin User Routes
    case '/admin/users':
        (new UserController())->index();
        break;

    case '/admin/users/add':
        (new UserController())->add();
        break;

    case '/admin/users/store': // POST
        check_allowed_methods('POST');
        (new UserController())->store();
        break;

    case '/admin/users/show':
        (new UserController())->show();
        break;

    case '/admin/users/edit':
        (new UserController())->edit();
        break;

    case '/admin/users/update': // POST
        check_allowed_methods('POST');
        (new UserController())->update();
        break;

    case '/admin/users/delete':
        (new UserController())->delete();
        break;
        // END Admin User Routes

        // Start admin Jobs Routes
        // END admin Jobs Routes

    default:
        http_response_code(404);
        get_view('404');
        break;
}
