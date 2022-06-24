<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Database\DB;

echo '...' . PHP_EOL;

// list only php files in the directory and reqiure them

/* First Way */
$tables = scandir(__DIR__ . '/Tables/');
foreach ($tables as $table) {
    if (!is_file(__DIR__ . '/Tables/' . $table)) continue;

    require __DIR__ . '/Tables/' . $table;
    try {
        DB::object()->connection->exec($sql);
        echo "Succes: Table " . basename($table, '.php') . " Created Succesfully!" . PHP_EOL;
    } catch (\PDOException $e) {
        echo "Error in $table: " . $e->getMessage() . PHP_EOL;
    }
}


/* Another way  */

/* // reqiure the files
$tables = glob(__DIR__ . '/Tables/*.php');
foreach ($tables as $table) {
    require $table;
    try {
        DB::object()->connection->exec($sql);
        echo "Succes: Table " . basename($table, '.php') . " Created Succesfully!" . PHP_EOL;
    } catch (PDOException $e) {
        echo "Error in " . basename($table, '.php') . ": " . $e->getMessage() . PHP_EOL;
    }
} */


echo '...' . PHP_EOL;
