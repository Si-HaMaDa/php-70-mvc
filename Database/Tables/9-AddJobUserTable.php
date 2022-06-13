<?php

// sql to create table IF NOT EXISTS
$sql = "CREATE TABLE IF NOT EXISTS `job_skill` (
            `job_id` bigint UNSIGNED NOT NULL,
            `skill_id` bigint UNSIGNED NOT NULL,
            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`),
            FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`),
            CONSTRAINT job_skill_unique UNIQUE KEY (`job_id`, `skill_id`)
        )";
