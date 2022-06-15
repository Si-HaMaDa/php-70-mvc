<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function index()
    {
        $users = (new User())->all();

        $title = 'Users';

        require get_view_dir('users/index');
        // require __DIR__ . './../views/users/index.php';
    }

    public function add()
    {
        $title = 'Add User';
        require get_view_dir('users/add');
        // get_view('users/add', [
        //     'title' => $title
        // ]);
        // require __DIR__ . '/../views/users/add.php';
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

        (new User())->insert($user);

        header('Location: ' . make_url('/admin/users'));
    }

    public function show()
    {
        $id = (int)$_GET['id'];

        $user = (new User())->first($id);

        $title = 'Show User';
        // var_dump($user);

        require get_view_dir('users/show');
        // get_view('users/show', [
        //     'title' => $title,
        //     'user' => $user
        // ]);
        // require __DIR__ . '/../views/users/show.php';
    }

    public function edit()
    {
        $id = (int)$_GET['id'];

        $user = (new User())->first($id);

        $title = 'Edit User';

        require get_view_dir('users/edit');
        // require __DIR__ . '/../views/users/edit.php';
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

        (new User())->update($user, ['id' => $_GET['id']]);

        header('Location: ' . make_url('/admin/users'));
    }
    public function delete()
    {
        $id = (int)$_GET['id'];

        (new User())->delete($id);

        header('Location: ' . make_url('/admin/users'));
    }

    public function users_api()
    {
        $users = (new User())->all();

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($users);
    }
}


/* $index_name = $_GET['method'];

$controller = new UserController();

// var_dump($controller);
// echo '<br>';

$controller->$index_name(); */
