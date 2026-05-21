<?php

$config = require __DIR__ . '/config/db.php';

$host = $config['host'];
$port = $config['port'];
$database = $config['dbname'];
$username = $config['username'];
$password = $config['password'];

try {
    $pdo = new PDO("mysql:host={$host};port={$port}", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$database}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    $pdo->exec("USE `{$database}`;");

    $pdo->exec("CREATE TABLE IF NOT EXISTS `users` (
        `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255) NOT NULL,
        `email` VARCHAR(255) NOT NULL UNIQUE,
        `password` VARCHAR(255) NOT NULL,
        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP NULL DEFAULT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    $pdo->exec("CREATE TABLE IF NOT EXISTS `listings` (
        `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
        `title` VARCHAR(255) NOT NULL,
        `description` TEXT NOT NULL,
        `salary` VARCHAR(255) NULL,
        `requirements` TEXT NULL,
        `benefits` TEXT NULL,
        `tags` VARCHAR(255) NULL,
        `company` VARCHAR(255) NULL,
        `address` VARCHAR(255) NULL,
        `city` VARCHAR(255) NULL,
        `state` VARCHAR(255) NULL,
        `phone` VARCHAR(100) NULL,
        `email` VARCHAR(255) NULL,
        `user_id` INT(11) UNSIGNED NULL,
        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP NULL DEFAULT NULL,
        PRIMARY KEY (`id`),
        INDEX (`user_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    echo "Database and tables were created or already exist.\n";
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    exit(1);
}

