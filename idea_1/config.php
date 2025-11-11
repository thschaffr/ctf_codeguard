<?php
$db = new PDO("sqlite:" . __DIR__ . "/app.db");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
session_start();

function current_user(PDO $db): ?array {
    if (!isset($_SESSION['user_id'])) {
        return null;
    }
    $stmt = $db->prepare("SELECT id, username FROM users WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $_SESSION['user_id']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
}
