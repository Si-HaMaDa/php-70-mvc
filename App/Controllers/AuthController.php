<?php

namespace App\Controllers;

class AuthController
{
    public function register()
    {
        require get_view_dir('auth/register');
    }

    public function login()
    {
        require get_view_dir('auth/login');
    }
}
