<?php

require __DIR__ . '/config.php';
// Get the method name from the URL
$route = $_SERVER['REQUEST_URI'];
// Replace the Subfolder with an empty string
$route = str_replace(SUB_FOLDER, '', $route);
// Remove query params
$route = explode('?', $route)[0];
// Remove the last slash
$route = rtrim($route, '/');

require './controllers/UserController.php';

switch ($route) {
    case '/admin/users':
        (new UserController())->index();
        break;
    case '/admin/users/add':
        (new UserController())->add();
        break;
    case '/admin/users/show':
        (new UserController())->show();
        break;
    default:
        http_response_code(404);
        include './views/404.view.php';
        break;
}
