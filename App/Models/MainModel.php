<?php

namespace App\Models;

use App\Database\DB;
use PDO;

abstract class MainModel
{
    public $connection;

    protected $table;

    public function __construct()
    {
        $this->connection = DB::object()->connection;
        $this->table = $this->table();
    }

    abstract public function table(); // Return string "table name"

    public function all()
    {
        // SELECT * FROM table_name; 
        $query = "SELECT * FROM $this->table";
        $sql = $this->connection->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function first($id)
    {
        // SELECT column_name(s) FROM table_name WHERE id = value  
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $sql = $this->connection->prepare($query);
        $sql->bindParam(':id', $id);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function getWhere($condition)
    {
        // SELECT column_name(s) FROM table_name WHERE column_name operator value AND column_name operator value ...  
        $query = "SELECT * FROM $this->table WHERE ";

        // SELECT * FROM users WHERE id = 1 AND name = 'Alyssa Gilmore'
        foreach ($condition as $key => $value) {
            $query .= "$key = '$value' AND ";
        }
        $query = rtrim($query, ' AND ');
        $sql = $this->connection->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIdIn($ids)
    {
        // SELECT column_name(s) FROM table_name WHERE id IN (1, 2, ...) 
        $ids = implode(', ', $ids);
        $query = "SELECT * FROM $this->table WHERE id in ($ids)";
        $sql = $this->connection->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($data)
    {
        // INSERT INTO table_name (column1, column2, column3, ...) VALUES (value1, value2, value3, ...)
        $columns = implode(', ', array_keys($data));
        $values = implode("', '", array_values($data));
        $query = "INSERT INTO $this->table ($columns) VALUES ('$values')";
        // INSERT INTO table_name (name, email, password, age) VALUES ('Harry Poter', '1654546294@mail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '39')
        $sql = $this->connection->prepare($query);
        return $sql->execute();
    }

    public function update($data, $condition)
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

        $query = "UPDATE $this->table SET $updateData WHERE $whereCondition";

        $sql = $this->connection->prepare($query);
        return $sql->execute();
    }

    public function delete($id)
    {
        // DELETE FROM table_name WHERE id = value
        $query = "DELETE FROM $this->table WHERE id = $id";
        $sql = $this->connection->prepare($query);
        return $sql->execute();
    }
}
