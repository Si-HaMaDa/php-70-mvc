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
        // get_view('users/index', [
        //     'users' => $users,
        //     'title' => $title,
        // ]);
    }

    public function create()
    {
        $title = 'Add User';

        require get_view_dir('users/create');
        // get_view('users/create', [
        //     'title' => $title,
        // ]);
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
                ->max(30)
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

        redirect_with_msgs(
            make_url('/admin/users'),
            ['success' => 'User added successfully.']
        );
    }

    public function show()
    {
        $id = (int)$_GET['id'];

        $user = (new User())->first($id);

        if (!$user)
            redirect_with_msgs(make_url('/admin/users'), ['error' => 'User not found.']);

        $title = 'Show User';

        require get_view_dir('users/show');
        // get_view('users/show', [
        //     'user' => $user,
        //     'title' => $title,
        // ]);
    }

    public function edit()
    {
        $id = (int)$_GET['id'];

        $user = (new User())->first($id);

        if (!$user)
            redirect_with_msgs(make_url('/admin/users'), ['error' => 'User not found.']);

        $title = 'Edit User';

        require get_view_dir('users/edit');
        // get_view('users/create', [
        //     'title' => $title,
        // ]);
    }

    public function update()
    {
        $id = (int)$_GET['id'];

        $validated = [
            'name' => (new Validations($_POST['name']))
                ->notEmpty()
                ->isName(),

            'email' => (new Validations($_POST['email']))
                ->notEmpty()
                ->isEmail(),

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

        if ($_POST['password']) {
            $validated['password'] = (new Validations($_POST['password']))
                ->notEmpty()
                ->min(6)
                ->max(30)
                ->confirmed($_POST['password_confirmation']);
        }

        $user = check_validation_and_get_data($validated);

        $user['password'] = sha1($user['password']);

        (new User())->update($user, ['id' => $id]);

        redirect_with_msgs(
            make_url('/admin/users'),
            ['success' => 'User updated successfully.']
        );
    }


    public function delete()
    {
        if (is_array($_POST['id'])) {
            foreach ($_POST['id'] as $id) {
                $id = (int)$id;
                (new User())->delete($id);
            }
        } else {
            $id = (int)$_GET['id'];
            (new User())->delete($id);
        }

        redirect_with_msgs(
            make_url('/admin/users'),
            ['success' => 'User deleted successfully.']
        );
    }

    public function users_api()
    {
        $users = (new User())->all();

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($users);
    }
}
