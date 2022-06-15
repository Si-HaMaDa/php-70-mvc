<?php

namespace App\Database;

use PDO;
use PDOException;

class DB
{
    // singletone class
    public $connection;

    /**
     * The Singleton's instance is stored in a static field.
     * You'll see how this works in a moment.
     */
    private static $my_object = null;

    /**
     * The Singleton's constructor should always be private to prevent direct
     * construction calls with the `new` operator.
     */
    protected function __construct()
    {
        try {
            // new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
            $this->connection = new PDO(
                DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME,
                DB_USER_NAME,
                DB_PASSWORD
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "<h1>Conecction Error:<br>" . $e->getMessage() . "</h1>" . PHP_EOL;
            die();
        }
    }

    /**
     * Singletons should not be cloneable.
     */
    protected function __clone()
    {
    }

    /**
     * Singletons should not be restorable from strings.
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function object()
    {
        if (self::$my_object == null) {
            self::$my_object = new static();
        }
        return self::$my_object;
    }

    public function all($table)
    {
        // SELECT * FROM table_name; 
        $query = "SELECT * FROM $table";
        $sql = $this->connection->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function first($table, $id)
    {
        // SELECT column_name(s) FROM table_name WHERE id = value  
        $query = "SELECT * FROM $table WHERE id = :id";
        $sql = $this->connection->prepare($query);
        $sql->bindParam(':id', $id);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function getWhere($table, $condition)
    {
        // SELECT column_name(s) FROM table_name WHERE column_name operator value AND column_name operator value ...  
        $query = "SELECT * FROM $table WHERE ";

        // SELECT * FROM users WHERE id = 1 AND name = 'Alyssa Gilmore'
        foreach ($condition as $key => $value) {
            $query .= "$key = '$value' AND ";
        }
        $query = rtrim($query, ' AND ');
        $sql = $this->connection->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIdIn($table, $ids)
    {
        // SELECT column_name(s) FROM table_name WHERE id IN (1, 2, ...) 
        $ids = implode(', ', $ids);
        $query = "SELECT * FROM $table WHERE id in ($ids)";
        $sql = $this->connection->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($table, $data)
    {
        // INSERT INTO table_name (column1, column2, column3, ...) VALUES (value1, value2, value3, ...)
        $columns = implode(', ', array_keys($data));
        $values = implode("', '", array_values($data));
        $query = "INSERT INTO $table ($columns) VALUES ('$values')";
        // INSERT INTO table_name (name, email, password, age) VALUES ('Harry Poter', '1654546294@mail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '39')
        $sql = $this->connection->prepare($query);
        return $sql->execute();
    }

    public function update($table, $data, $condition)
    {
        // UPDATE table_name SET column1 = value1, column2 = value2, ... WHERE condition;
        $updateData = '';
        foreach ($data as $key => $value) {
            $updateData .= "$key = '$value', ";
        }
        $updateData = rtrim($updateData, ', ');

        $whereCondition = '';
        foreach ($condition as $key => $value) {
            $whereCondition .= "$key = '$value' AND ";
        }
        $whereCondition = rtrim($whereCondition, ' AND ');

        $query = "UPDATE $table SET $updateData WHERE $whereCondition";

        $sql = $this->connection->prepare($query);
        return $sql->execute();
    }

    public function delete($table, $id)
    {
        // DELETE FROM table_name WHERE id = value
        $query = "DELETE FROM $table WHERE id = $id";
        $sql = $this->connection->prepare($query);
        return $sql->execute();
    }
}
