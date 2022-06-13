<?php

define('DB_TYPE', "mysql");
define('DB_HOST', "localhost");
define('DB_USER_NAME', "root");
define('DB_PASSWORD', "root");
define('DB_NAME', "php70");

class DB
{
    public $connection;
    public function __construct()
    {
        // new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
        $this->connection = new PDO(
            DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME,
            DB_USER_NAME,
            DB_PASSWORD
        );
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
