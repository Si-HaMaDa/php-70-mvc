<?php

namespace App\Models;

class User extends MainModel
{
    // protected $table = 'users';
    public function table()
    {
        return 'users';
    }
}
