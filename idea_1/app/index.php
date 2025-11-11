<?php require_once "../config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable App Playground</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="app-shell">
        <header class="app-header">
            <h1>Cisco Security Labs</h1>
            <?php $user = current_user($db); ?>
            <nav class="app-nav">
                <a href="index.php">Overview</a>
                <?php if ($user): ?>
                    <a href="profile.php">Profile</a>
                    <a href="upload.php">Upload</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                <?php endif; ?>
            </nav>
            <div class="nav-right">
                <?php if ($user): ?>
                    <span class="badge">Signed in as <?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <a class="link" href="logout.php">Logout</a>
                <?php endif; ?>
            </div>
        </header>

        <div class="card stack">
            <div>
                <h2>Security Labs in a Single Stack</h2>
                <p class="muted">
                    Explore an intentionally vulnerable application wrapped in a Cisco-inspired interface. Use it to brief teams,
                    rehearse CTF scenarios, or demonstrate how legacy flaws surface in modern customer-facing portals.
                </p>
            </div>
            <div class="card">
                <h3>Included Scenarios</h3>
                <p class="muted">
                    <span class="highlight">SQL Injection</span>,
                    <span class="highlight">IDOR</span>,
                    <span class="highlight">Unrestricted File Upload</span>
                </p>
            </div>
            <button onclick="window.location.href='login.php'">Enter Training Portal</button>
        </div>

        <p class="footer-note">Internal training artifact. Not intended for production use.</p>
    </div>
</body>
</html>
