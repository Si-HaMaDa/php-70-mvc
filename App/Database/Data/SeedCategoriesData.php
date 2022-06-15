<?php

namespace App\Database\Data;

class SeedCategoriesData extends MainSeeder
{
    // To set the table name
    public function __construct()
    {
        self::$table = 'categories';
    }

    public function defenation()
    {
        return
            [
                'name' => $this->getFaker()->unique()->country,
            ];
    }
}
