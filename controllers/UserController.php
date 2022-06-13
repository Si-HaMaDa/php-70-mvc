<?php

class UserController
{
    public function index()
    {
        $db = DB::object();

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

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            http_response_code(405);
            echo "GET Method not allowed";
            die();
            return;
        }

        $user = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'gender' => $_POST['gender'],
            'age' => $_POST['age'],
            'title' => $_POST['title'],
        ];

        var_dump($user);
        die();

        $db = DB::object();
        $db->insert('users', $user);

        header('Location: ' . make_url('/admin/users'));
    }

    public function show()
    {
        $db = DB::object();

        $id = (int)$_GET['id'];

        $user = $db->first('users', $id);

        $title = 'Show User';
        // var_dump($user);

        require __DIR__ . '/../views/users/show.php';
    }

    public function edit()
    {
        $id = (int)$_GET['id'];

        $user = DB::object()->first('users', $id);

        $title = 'Edit Customer';

        require __DIR__ . '/../views/users/edit.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            http_response_code(405);
            echo "This page is only for POST requests";
            die();
            return;
        }

        $user = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'gender' => $_POST['gender'],
            'age' => $_POST['age'],
            'title' => $_POST['title'],
        ];

        (DB::object())->update('users', $user, ['id' => $_GET['id']]);

        header('Location: ' . make_url('/admin/users'));
    }
    public function delete()
    {
        $id = (int)$_GET['id'];

        (DB::object())->delete('users', $id);

        header('Location: ' . make_url('/admin/users'));
    }

    public function users_api()
    {
        $users = (DB::object())->all('users');

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($users);
    }
}


/* $index_name = $_GET['method'];

$controller = new UserController();

// var_dump($controller);
// echo '<br>';

$controller->$index_name(); */
