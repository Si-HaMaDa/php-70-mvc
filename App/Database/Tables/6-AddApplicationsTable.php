<?php

// sql to create table IF NOT EXISTS
$sql = "CREATE TABLE IF NOT EXISTS `applications` (
            `id` bigint UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `description` text NOT NULL,
            `views` int NOT NULL DEFAULT '0',
            `job_id` bigint UNSIGNED NOT NULL,
            `user_id` bigint UNSIGNED NOT NULL,
            `resume_id` bigint UNSIGNED DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`),
            FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
            FOREIGN KEY (`resume_id`) REFERENCES `resumes` (`id`)
        )";
