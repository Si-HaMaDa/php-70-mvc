<?php

namespace App\Database\Data;

class SeedSkillsData extends MainSeeder
{

    // To set the table name
    public function __construct()
    {
        self::$table = 'skills';
    }

    public function defenation()
    {
        return
            [
                'name' => $this->getFaker()->unique()->colorName,
            ];
    }
}
