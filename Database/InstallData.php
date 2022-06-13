<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/DB.php';

$db = DB::object();

$files = glob(__DIR__ . '/Tables/*.php');

echo '...' . PHP_EOL;
foreach ($files as $file) {
    if (!is_file(__DIR__ . '/Data/' . $file)) continue;

    require_once __DIR__ . '/Data/' . $file;
    try {
        //code...
        $db->connection->exec($sql);
        echo "Table $file created\n";
    } catch (\Throwable $th) {
        echo "Error: Table $file created\n";
        //throw $th;
    }
}
echo '...' . PHP_EOL;
