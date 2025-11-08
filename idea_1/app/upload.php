<?php
require_once "../config.php";
require_once "../classes/Deserializable.php";

$decoded = null;
$objectDump = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST['data'];
    // Unsafe deserialization vulnerability
    $decoded = base64_decode($data);
    $obj = unserialize($decoded);
    ob_start();
    var_dump($obj);
    $objectDump = ob_get_clean();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload | Vulnerable App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="app-shell">
        <header class="app-header">
            <h1>Unsafe Deserialization Lab</h1>
            <nav class="app-nav">
                <a href="index.php">Overview</a>
                <a href="profile.php">Portal</a>
                <a href="upload.php">Labs</a>
            </nav>
        </header>

        <div class="card stack">
            <div>
                <h2>Craft a Payload</h2>
                <p class="muted">
                    Paste a base64-encoded PHP serialized object. If the object contains a <code class="highlight">$cmd</code>
                    property, the application will execute it during <code class="highlight">__wakeup()</code>.
                </p>
            </div>

            <form method="post" class="stack">
                <label>
                    Base64 Serialized Object
                    <textarea name="data" rows="6" placeholder="Paste your payload here" required><?php echo isset($_POST['data']) ? htmlspecialchars($_POST['data'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
                </label>
                <button type="submit">Deserialize Payload</button>
            </form>

            <?php if ($decoded !== null): ?>
                <div class="card">
                    <h3>Decoded Payload (raw)</h3>
                    <pre class="muted"><?php echo htmlspecialchars($decoded, ENT_QUOTES, 'UTF-8'); ?></pre>
                </div>
            <?php endif; ?>

            <?php if ($objectDump !== null): ?>
                <div class="card">
                    <h3>Deserialized Object</h3>
                    <pre class="muted"><?php echo htmlspecialchars($objectDump, ENT_QUOTES, 'UTF-8'); ?></pre>
                </div>
            <?php endif; ?>
        </div>

        <p class="footer-note">Security lesson: never deserialize untrusted input.</p>
    </div>
</body>
</html>
