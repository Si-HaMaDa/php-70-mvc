<?php

namespace App\Controllers;

use App\Models\User;
use App\Validations\Validations;

class AuthController
{
    public function register()
    {
        require get_view_dir('auth/register');
    }

    public function do_register()
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
            make_url('/login'),
            ['success' => 'Registered successfully, You can login now!']
        );
    }

    public function login()
    {
        require get_view_dir('auth/login');
    }

    public function do_login()
    {
        $validated = [
            'email' => (new Validations($_POST['email']))
                ->notEmpty()
                ->isEmail(),

            'password' => (new Validations($_POST['password']))
                ->notEmpty()
                ->min(6)
                ->max(30)
        ];

        $user = check_validation_and_get_data($validated);

        $user['password'] = sha1($user['password']);

        $user = (new User())->firstRow($user);

        if (count($user) < 1) {
            redirect_with_msgs(
                make_url('/login'),
                ['error' => 'Email or password is incorrect!']
            );
        }

        $_SESSION['user']['is_login'] = true;
        $_SESSION['user']['user_id'] = $user['id'];
        $_SESSION['user']['user_email'] = $user['email'];
        $_SESSION['user']['login_time'] = date('Y-m-d');

        redirect_with_msgs(
            make_url('/admin'),
            ['success' => 'Logged successfully.']
        );
    }
}
