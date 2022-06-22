<?php

namespace App\Controllers;

use App\Models\User;
use App\Validations\Validations;

class UserController
{
    public function index()
    {
        $page = isset($_GET['page']) ? (abs((int) $_GET['page']) ?: 1) : 1;

        $per_page = 10;

        $start = ($page - 1) * $per_page;

        $count = (new User())->count();

        $total_pages = ceil($count / $per_page);

        $next_page = ($page + 1) > $total_pages ? $total_pages : ($page + 1);

        $users = (new User())->all('*', [$start, $per_page]);

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

            'image' => (new Validations($_FILES['image']))
                ->isFile()
                ->fileSize(600)
                ->isImage()
                ->extensionIn(['jpg', 'png', 'jpeg'])
                ->isNullable(),
        ];

        $user = check_validation_and_get_data($validated);

        $user['password'] = sha1($user['password']);

        if ($user['image']) $user['image'] = User::upload_image($user['image']);
        else unset($user['image']);

        (new User())->insert($user);

        redirect_with_msgs(
            make_url('/admin/users'),
            ['success' => 'User added successfully.']
        );
    }

    public function show()
    {
        $id = (int)$_GET['id'];

        $user = (new User())->find($id);

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

        $user = (new User())->find($id);

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

            'image' => (new Validations($_FILES['image']))
                ->isFile()
                ->fileSize(600)
                ->isImage()
                ->extensionIn(['jpg', 'png', 'jpeg'])
                ->isNullable(),
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

        if ($user['image']) $user['image'] = User::upload_image($user['image'], $id);
        else unset($user['image']);

        (new User())->update($user, ['id' => $id]);

        redirect_with_msgs(
            make_url('/admin/users'),
            ['success' => 'User updated successfully.']
        );
    }


    public function delete()
    {
        $ids =
            isset($_POST['id']) && is_array($_POST['id']) // if multiple ids are selected
            ? (array) $_POST['id'] // convert to array if not
            : [(int) $_REQUEST['id']]; // else make it an array with one id

        foreach ($ids as $id) { // loop through each id and delete
            $id = (int)$id;
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
