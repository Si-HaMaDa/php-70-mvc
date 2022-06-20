<?php

namespace App\Controllers;

class AdminController
{
    public function index()
    {
        $title = 'Dashboard';

        require get_view_dir('admin/index');
    }
}
