<?php
require_once "../config.php";
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $_POST['user'];
    $p = $_POST['pass'];
    $hashed = md5($p); // Reversible hash stored in database
    // SQL Injection vulnerability
    $sql = "SELECT * FROM users WHERE username = '$u' AND password = '$hashed';";
    foreach ($db->query($sql) as $row) {
        $_SESSION['user_id'] = $row['id'];
        header("Location: profile.php");
        exit;
    }
    $error = "Invalid credentials. Try again.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Vulnerable App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="app-shell">
        <header class="app-header">
            <h1>Access Console</h1>
            <nav class="app-nav">
                <a href="index.php">Overview</a>
                <a href="login.php">Portal</a>
                <a href="upload.php">Labs</a>
            </nav>
        </header>

        <div class="card">
            <h2>Authenticate</h2>
            <p class="muted">
                Provide credentials to continue into the internal lab workspace. Monitor the request lifecycle to understand
                how this surface validates access.
            </p>

            <?php if ($error): ?>
                <div class="alert"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>

            <form method="post" class="stack">
                <label>
                    Username
                    <input name="user" placeholder="Enter username" autocomplete="username" required>
                </label>
                <label>
                    Password
                    <input name="pass" type="password" placeholder="Enter password" autocomplete="current-password" required>
                </label>
                <button type="submit">Continue</button>
            </form>
        </div>

        <p class="footer-note">Intentionally vulnerable. Handle with caution.</p>
    </div>
</body>
</html>
