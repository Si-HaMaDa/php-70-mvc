<?php

// sql to create table IF NOT EXI
$sql = "CREATE TABLE IF NOT EXISTS `users` (
            `id` bigint UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(255) NOT NULL,
            `email` varchar(255) UNIQUE NOT NULL,
            `password` varchar(255) NOT NULL,
            `resume_id` bigint UNSIGNED DEFAULT NULL,
            `gender` enum('m','f') NOT NULL,
            `title` varchar(255) NOT NULL,
            `image` varchar(255) NOT NULL DEFAULT 'avatar.png',
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
