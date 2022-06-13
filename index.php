<?php

$request = $_GET['route'] ?? '/';

// die($request);

require './controllers/UserController.php';

$userController = new UserController();

switch ($request) {
    case '/':
        $userController->index();
        break;
    case 'add':
        $userController->add();
        break;
    case 'show':
        $userController->show();
        break;
    default:
        http_response_code(404);
        include './views/404.view.php';
        break;
}
