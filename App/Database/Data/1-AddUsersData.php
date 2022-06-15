<?php

use App\Database\DB;

require_once __DIR__ . '/../../../vendor/autoload.php';

$db = DB::object();

if ($db->getWhere('users', ['email' => 'admin@admin.com'])) {
    echo "Admin user alraedy exist\n";
} else {
    $db->insert('users', [
        'name' => 'admin',
        'email' => 'admin@admin.com',
        'password' => sha1('password'),
        'role' => 'admin',
        'gender' => 'm',
        'age' => 50,
        'title' => 'Wedsite Manager',
    ]);
    echo "Admin user created\n";
}

try {
    for ($i = 0; $i < 10; $i++) {
        $db->insert('users', [
            'name' => $i . time(),
            'email' => $i . time() . '@admin.com',
            'password' => sha1('password'),
            'gender' => ['m', 'f'][random_int(0, 1)],
            'age' => random_int(20, 60),
            'title' => 'Web Developer',
        ]);
    }
    echo "Succes: UsersSeeder Seeded Successfully!" . PHP_EOL;
} catch (\Throwable $th) {
    echo "Error in UsersSeeder: " . $e->getMessage() . PHP_EOL;
    //throw $th;
}
