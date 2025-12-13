<?php
/**
 * Database initialization script
 * Generates Argon2id password hashes at build time
 */

$db = new PDO('sqlite:/var/www/html/app.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create users table
$db->exec("
    CREATE TABLE users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT,
        password TEXT,
        flag TEXT
    );
");

// Users with their plaintext passwords - hashed with Argon2id
// Note: secret_user has DISABLED as password to prevent login
$users = [
    ['alex', 'alexgoestociscolive', 'FLAG{alex_should_parameterize}'],
    ['secret_user', 'DISABLED', 'FLAG{whose_data_is_it_anyway}'],
    ['bob', 'bobpass', ''],
    ['charlie', 'charliepass', ''],
];

$stmt = $db->prepare("INSERT INTO users (username, password, flag) VALUES (:username, :password, :flag)");

foreach ($users as [$username, $plainPassword, $flag]) {
    // Keep DISABLED as-is, hash all other passwords
    if ($plainPassword === 'DISABLED') {
        $hashedPassword = 'DISABLED';
    } else {
        $hashedPassword = password_hash($plainPassword, PASSWORD_ARGON2ID);
    }
    $stmt->execute([
        ':username' => $username,
        ':password' => $hashedPassword,
        ':flag' => $flag,
    ]);
}

echo "Database initialized with " . count($users) . " users using Argon2id password hashing.\n";

