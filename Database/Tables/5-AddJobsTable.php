<?php

// sql to create table IF NOT EXISTS
$sql = "CREATE TABLE IF NOT EXISTS `jobs` (
            `id` bigint UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `title` varchar(255) NOT NULL,
            `description` text NOT NULL,
            `salary` int DEFAULT NULL,
            `statu` enum('open','closed','pending') NOT NULL,
            `views` int NOT NULL DEFAULT '0',
            `category_id` bigint UNSIGNED NOT NULL,
            `user_id` bigint UNSIGNED NOT NULL,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
            FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
        )";
