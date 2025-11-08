<?php
require_once "../config.php";
if (!isset($_SESSION['user_id'])) {
    die("Please login.");
}
$id = (int)($_GET['id'] ?? $_SESSION['user_id']);  // IDOR vulnerability
$sql = "SELECT * FROM users WHERE id = $id;";
$row = $db->query($sql)->fetch();
if (!$row) { die("No user."); }
echo "<h2>Profile of {$row['username']}</h2>";
echo "ID: {$row['id']}<br>";
echo "Flag: {$row['flag']}<br>";
echo "<p><a href=\"upload.php\">Upload / Trigger Deserialization</a></p>";
