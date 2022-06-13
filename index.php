<?php

require __DIR__ . '/config.php';
require __DIR__ . '/helpers.php';
require __DIR__ . '/Database/DB.php';

// Get the method name from the URL
$route = $_SERVER['REQUEST_URI'];
// Replace the Subfolder with an empty string
$route = str_replace(SUB_DIR, '', $route);
// Remove any query params
$route = explode('?', $route)[0];
// Remove the last slash
$route = rtrim($route, '/');

require './controllers/UserController.php';

switch ($route) {
        // Start Admin User Routes
    case '/admin/users':
        (new UserController())->index();
        break;

    case '/admin/users/add':
        (new UserController())->add();
        break;

    case '/admin/users/store':
        (new UserController())->store();
        break;

    case '/admin/users/show':
        (new UserController())->show();
        break;

    case '/admin/users/edit':
        (new UserController())->edit();
        break;

    case '/admin/users/update':
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
        include './views/404.view.php';
        break;
}
