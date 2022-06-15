<?php

namespace App\Database\Data;

class SeedUsersData extends MainSeeder
{

    public function __construct()
    {
        self::$table = 'users';
    }

    public function defenation()
    {
        return
            [
                'name' => $this->getFaker()->unique()->name,
                'email' => $this->getFaker()->unique()->safeEmail,
                'password' => sha1('password'),
                'gender' => $this->getFaker()->randomElement(['m', 'f']),
                'age' => random_int(12, 60),
                'title' => $this->getFaker()->unique()->jobTitle,
                'image' => $this->getFaker()->imageUrl,
            ];
    }

    public function run($count = 1)
    {
        $admin = \App\Database\DB::object()->getWhere(self::$table, ['email' => 'admin@admin.com']);
        if (!empty($admin)) {
            echo "Admin Already there..." . PHP_EOL;
        } else {
            $this->create(
                [
                    'name' => 'admin',
                    'email' => 'admin@admin.com',
                    'password' => sha1('password'),
                    'gender' => 'm',
                    'title' => 'Web Developer',
                ]
            );
            echo "An Admin User has been created!" . PHP_EOL;
            echo "Email: admin@admin.com" . PHP_EOL;
            echo "Pass: password" . PHP_EOL;
            echo "..." . PHP_EOL;
        }

        parent::run($count);
    }
}
