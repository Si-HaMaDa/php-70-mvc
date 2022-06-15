<?php

// sql to create table IF NOT EXISTS
$sql = "CREATE TABLE IF NOT EXISTS `skill_user` (
            `skill_id` bigint UNSIGNED NOT NULL,
            `user_id` bigint UNSIGNED NOT NULL,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`),
            FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
            CONSTRAINT skill_user_unique UNIQUE KEY (`skill_id`, `user_id`)
        )";
