<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/DB.php';

$db = DB::object();

// list only php files in the directory and reqiure them
$files = scandir(__DIR__ . '/Tables');

echo '...' . PHP_EOL;
foreach ($files as $file) {
    if (!is_file(__DIR__ . '/Tables/' . $file)) continue;

    require_once __DIR__ . '/Tables/' . $file;
    try {
        $db->connection->exec($sql);
        echo "Succes: Table " . basename($file, '.php') . " Created Succesfully!\n";
    } catch (\Throwable $th) {
        echo "Error in " . basename($file, '.php') . ": " . $e->getMessage() . "\n";
    }
}
echo '...' . PHP_EOL;


/* Another way  */

/* // reqiure the files
$files = glob(__DIR__ . '/Tables/*.php');
foreach ($files as $file) {
    require $file;
    try {
        DB::object()->connection->exec($sql);
        echo "Succes: Table " . basename($file, '.php') . " Created Succesfully!" . PHP_EOL;
    } catch (PDOException $e) {
        echo "Error in " . basename($file, '.php') . ": " . $e->getMessage() . PHP_EOL;
    }
} */
