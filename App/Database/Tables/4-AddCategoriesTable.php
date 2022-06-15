<?php

// sql to create table IF NOT EXISTS
$sql = "CREATE TABLE IF NOT EXISTS `categories` (
            `id` bigint UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(255) NOT NULL,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
