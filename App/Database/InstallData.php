<?php

require_once './../../vendor/autoload.php';

echo '...' . PHP_EOL;

// Set the seeders you need to run
(new App\Database\Data\SeedCategoriesData())->run(20);
(new App\Database\Data\SeedSkillsData())->run(20);
(new App\Database\Data\SeedUsersData())->run(20);

echo '...' . PHP_EOL;
