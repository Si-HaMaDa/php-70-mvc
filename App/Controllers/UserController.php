<?php

namespace App\Controllers;

use App\Models\User;
use App\Validations\Validations;

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
        $validated = [
            'name' => (new Validations($_POST['name']))
                ->notEmpty()
                ->isName(),

            'email' => (new Validations($_POST['email']))
                ->notEmpty()
                ->isEmail(),

            'password' => (new Validations($_POST['password']))
                ->notEmpty()
                ->min(6)
                ->max(25)
                ->confirmed($_POST['password_confirmation']),

            'role' => (new Validations($_POST['role']))
                ->notEmpty()
                ->isIn(['user', 'admin']),

            'gender' => (new Validations($_POST['gender']))
                ->notEmpty()
                ->isIn(['m', 'f']),

            'age' => (new Validations($_POST['age']))
                ->notEmpty()
                ->isInteger(),

            'title' => (new Validations($_POST['title']))
                ->notEmpty()
                ->isName(),
        ];

        $user = check_validation_and_get_data($validated);

        $user['password'] = sha1($user['password']);

        (new User())->insert($user);

        redirect_with_msg(
            make_url('/admin/users'),
            ['success' => 'User added successfully']
        );
    }

    public function show()
    {
        $id = (int)$_GET['id'];

        $user = (new User())->first($id);

        if (!$user)
            redirect_with_msg(
                make_url('/admin/users'),
                ['error' => 'User not found']
            );

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

        $validated = [
            'name' => (new Validations($_POST['name']))
                ->notEmpty()
                ->isName(),

            'email' => (new Validations($_POST['email']))
                ->notEmpty()
                ->isEmail(),

            'gender' => (new Validations($_POST['gender']))
                ->notEmpty()
                ->isIn(['m', 'f']),

            'role' => (new Validations($_POST['role']))
                ->notEmpty()
                ->isIn(['user', 'admin']),

            'age' => (new Validations($_POST['age']))
                ->notEmpty()
                ->isInteger(),

            'title' => (new Validations($_POST['title']))
                ->notEmpty()
                ->isName(),
        ];

        if ($_POST['password'])
            $validated['password'] = (new Validations($_POST['password']))
                ->notEmpty()
                ->min(6)
                ->max(25)
                ->confirmed($_POST['password_confirmation']);

        $user = check_validation_and_get_data($validated);

        (new User())->update($user, ['id' => $_GET['id']]);

        redirect_with_msg(
            make_url('/admin/users'),
            ['success' => 'User updated successfully']
        );
    }
    public function delete()
    {
        if (is_array($_GET['id'])) {
            foreach ($_GET['id'] as $id) {
                $id = (int)$id;
                (new User())->delete($id);
            }
        } else {
            $id = (int)$_GET['id'];
            (new User())->delete($id);
        }

        redirect_with_msg(
            make_url('/admin/users'),
            ['success' => 'User deleted successfully']
        );
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
