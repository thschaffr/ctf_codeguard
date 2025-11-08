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
                <a href="index.php">Overview</a>
                <a href="login.php">Portal</a>
                <a href="upload.php">Labs</a>
            </nav>
        </header>

        <div class="card stack">
            <div>
                <h2>Security Labs in a Single Stack</h2>
                <p class="muted">
                    A polished training environment built with classic vulnerabilities. Inspect the flows, observe the responses,
                    and document the impact. Every screen keeps the original behaviors intact.
                </p>
            </div>
            <div class="card">
                <h3>Included Scenarios</h3>
                <p class="muted">
                    <span class="highlight">SQL Injection</span>,
                    <span class="highlight">IDOR</span>,
                    <span class="highlight">Unsafe Deserialization</span>
                </p>
            </div>
            <button onclick="window.location.href='login.php'">Open the Portal</button>
        </div>

        <p class="footer-note">For controlled environments only. Crafted to mirror a modern product experience.</p>
    </div>
</body>
</html>
