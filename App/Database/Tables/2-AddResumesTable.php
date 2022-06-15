<?php

// sql to create table IF NOT EXISTS
$sql = "CREATE TABLE IF NOT EXISTS `resumes` (
            `id` bigint UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `file` varchar(255) NOT NULL,
            `size` varchar(255) NOT NULL,
            `type` varchar(255) NOT NULL,
            `downloads` int NOT NULL DEFAULT '0',
            `user_id` bigint UNSIGNED NOT NULL,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
        );
        ALTER TABLE users
            ADD FOREIGN KEY (`resume_id`) REFERENCES `resumes` (`id`);
        ";
