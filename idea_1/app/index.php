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
        <?php include "nav.php"; ?>

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
