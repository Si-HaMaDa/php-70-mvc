<?php

// sql to create table IF NOT EXISTS
$sql = "ALTER TABLE users
            ADD `role` varchar(255) DEFAULT 'user' AFTER `password`,
            ADD `age` int NOT NULL AFTER `gender`
        ";
