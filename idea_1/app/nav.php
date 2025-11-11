<?php require_once "../config.php"; ?>
<?php
$currentUser = null;
if (function_exists('current_user')) {
    $currentUser = current_user($db);
} elseif (isset($_SESSION['user_id'])) {
    $stmt = $db->prepare("SELECT id, username FROM users WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $_SESSION['user_id']]);
    $currentUser = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}
?>
<header class="app-header">
    <h1>Cisco Security Labs</h1>
    <nav class="app-nav">
        <a href="index.php">Overview</a>
        <?php if ($currentUser): ?>
            <a href="profile.php">Profile</a>
            <a href="upload.php">Upload</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </nav>
    <div class="nav-right">
        <?php if ($currentUser): ?>
            <span class="badge">Signed in as <?php echo htmlspecialchars($currentUser['username'], ENT_QUOTES, 'UTF-8'); ?></span>
            <a class="link" href="logout.php">Logout</a>
        <?php endif; ?>
    </div>
</header>

