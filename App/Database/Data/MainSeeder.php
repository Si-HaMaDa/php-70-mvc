<?php

namespace App\Database\Data;

abstract class MainSeeder
{
    public static $table;

    public $faker = null;

    // To set the table name
    abstract public function __construct();

    abstract public function defenation();

    public function run($count = 1)
    {
        for ($i = 0; $i < $count; $i++) $this->create();

        echo "Succes: " . self::$table . " Seeded Successfully!" . PHP_EOL;
    }

    public function create($data = null)
    {
        if (is_null($data)) $data = $this->defenation();

        try {
            \App\Database\DB::object()->insert(
                self::$table,
                $data
            );
        } catch (\PDOException $e) {
            echo "Error in " . self::$table . ": " . $e->getMessage() . PHP_EOL;
        }
    }

    public function make($count = 1)
    {
        $items = [];

        for ($i = 0; $i < $count; $i++) $items = $this->create($this->defenation());

        return $items;
    }

    // get instance of faker
    public function getFaker()
    {
        if (is_null($this->faker)) $this->faker = \Faker\Factory::create();

        return $this->faker;
    }
}
