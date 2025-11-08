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
            <h1>Vulnerable App Playground</h1>
            <nav class="app-nav">
                <a href="index.php">Home</a>
                <a href="login.php">Login</a>
                <a href="upload.php">Upload</a>
            </nav>
        </header>

        <div class="card stack">
            <h2>Practice Real-World Exploits</h2>
            <p class="muted">
                This intentionally vulnerable PHP application is designed for CTF exercises and security training.
                Use it to explore common web vulnerabilities in a safe, isolated environment.
            </p>
            <div class="card">
                <h3>Available Challenges</h3>
                <ul class="muted">
                    <li><span class="highlight">SQL Injection</span> &mdash; Bypass the login form</li>
                    <li><span class="highlight">IDOR</span> &mdash; Access another user&rsquo;s profile</li>
                    <li><span class="highlight">Unsafe Deserialization</span> &mdash; Trigger command execution</li>
                </ul>
            </div>
            <button onclick="window.location.href='login.php'">Start with Login</button>
        </div>

        <p class="footer-note">For training use only. Do not deploy in production.</p>
    </div>
</body>
</html>
