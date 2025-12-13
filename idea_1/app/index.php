<?php require_once "../config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable App Playground</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="app-shell">
        <header class="app-header">
            <h1>Security is a Vibe</h1>
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

        <div class="stack">
            <div>
                <h2>CodeGuard Challenge: The Intern's Legacy</h2>
                <p class="muted">
                    Meet "Security is a Vibe" — the passion project of our newest junior developer, Alex. Alex is brilliant, enthusiastic, and completely convinced that "if it works, it's secure." 
                </p>
                <p class="muted">
                    He built this platform to showcase modern rapid development, but in his haste, he left behind some classic vulnerabilities. Your mission is to step into the role of a Senior Security Engineer: audit Alex's code, exploit the flaws to prove the risk, and then patch them to secure the stack.
                </p>
            </div>
            <div class="card">
                <h3>Powered by Project CodeGuard</h3>
                <p class="muted">
                    Learn more about secure coding practices at 
                    <a href="https://project-codeguard.org/" target="_blank" class="highlight">project-codeguard.org</a>
                </p>
            </div>
            <button onclick="window.location.href='login.php'">Enter Training Portal</button>
        </div>

        <p class="footer-note">Built with passion for you. Security is a vibe!</p>
    </div>
</body>
</html>
