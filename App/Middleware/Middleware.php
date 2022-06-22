<?php

namespace App\Middleware;

use App\Models\User;

class Middleware
{
    public function __construct($checks)
    {
        $methods = is_array($checks) ? $checks : explode('|', $checks);

        foreach ($methods as $method) {

            $method_name = explode(':', $method)[0];
            $method_attribute = explode(':', $method)[1] ?? null;

            $this->$method_name($method_attribute);
        }
    }

    function check_allowed_method($method)
    {
        if ($_SERVER['REQUEST_METHOD'] == $method) return;
        http_response_code(405);
        echo "This page is only for $method requests";
        die();
    }

    public function check_login()
    {
        if (
            !isset($_SESSION['user']['is_login'])
            || !$_SESSION['user']['is_login']
        )
            redirect_with_msgs(
                make_url('/login'),
                ['error' => 'You must be logged in to access this page!']
            );
    }

    public function is_guest()
    {
        if (
            isset($_SESSION['user']['is_login'])
            && $_SESSION['user']['is_login']
        )
            redirect_with_msgs(
                make_url('/admin'),
                ['error' => 'You already logged in!']
            );
    }

    function is_admin()
    {
        $this->check_login();

        $user = (new User)->find($_SESSION['user']['user_id']);

        if ($user['role'] == 'admin') return;

        http_response_code(403);
        get_view('403');
    }
}
