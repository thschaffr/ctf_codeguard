<?php
require_once "../config.php";
if (!isset($_SESSION['user_id'])) {
    die("Please login.");
}
$id = (int)($_GET['id'] ?? $_SESSION['user_id']);  // IDOR vulnerability
$sql = "SELECT * FROM users WHERE id = $id;";
$row = $db->query($sql)->fetch();
if (!$row) { die("No user."); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Vulnerable App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="app-shell">
        <header class="app-header">
            <h1>User Profile</h1>
            <nav class="app-nav">
                <a href="index.php">Overview</a>
                <a href="profile.php">Portal</a>
                <a href="upload.php">Labs</a>
            </nav>
        </header>

        <div class="card stack">
            <div>
                <h2><?php echo htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8'); ?></h2>
                <p class="muted">
                    Session context is active. Observe the calls that populate this dashboard to map enforced and missing controls.
                </p>
            </div>
            <div class="card">
                <p><strong>User ID:</strong> <span class="highlight"><?php echo $row['id']; ?></span></p>
                <p><strong>Flag:</strong> <span class="highlight"><?php echo htmlspecialchars($row['flag'], ENT_QUOTES, 'UTF-8'); ?></span></p>
            </div>
            <button onclick="window.location.href='upload.php'">Upload Files</button>
        </div>

        <p class="footer-note">Security lesson: enforce access control on every request.</p>
    </div>
    <!-- Analyst note: the profile endpoint trusts any ?id= parameter. -->
</body>
</html>
