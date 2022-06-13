<?php

require __DIR__ . '/../models/model.php';

class UserController
{
    public function index()
    {
        $db = new DB();

        $users = $db->all('users');

        $title = 'Users';
        // var_dump($users);

        require __DIR__ . './../views/users/index.php';
    }

    public function add()
    {
        $title = 'Add Customer';

        require __DIR__ . '/../views/users/add.php';
    }

    public function save()
    {
        var_dump($_POST);
    }

    public function show()
    {
        $db = new DB();

        $id = (int)$_GET['id'];

        $user = $db->first('users', $id);

        $title = 'Show User';
        // var_dump($user);

        require __DIR__ . '/../views/users/show.php';
    }

    public function users_api()
    {
        $db = new DB();

        $users = $db->all('users');

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($users);
    }
}


/* $index_name = $_GET['method'];

$controller = new UserController();

// var_dump($controller);
// echo '<br>';

$controller->$index_name(); */
