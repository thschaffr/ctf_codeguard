<?php
require_once "../config.php";

$uploadMessage = null;
$uploadedFile = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    
    // Intentionally insecure: no validation on file type or content
    $uploadDir = '/var/www/html/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    $targetPath = $uploadDir . basename($file['name']);
    
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        $uploadMessage = "File uploaded successfully.";
        $uploadedFile = basename($file['name']);
    } else {
        $uploadMessage = "Upload failed.";
    }
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
            <h1>File Upload</h1>
            <nav class="app-nav">
                <a href="index.php">Overview</a>
                <a href="profile.php">Portal</a>
                <a href="upload.php">Upload</a>
            </nav>
        </header>

        <div class="card stack">
            <div>
                <h2>Upload a File</h2>
                <p class="muted">
                    Submit files for processing. The system accepts any file type and stores them in the uploads directory.
                </p>
            </div>

            <?php if ($uploadMessage): ?>
                <div class="alert"><?php echo htmlspecialchars($uploadMessage, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>

            <?php if ($uploadedFile): ?>
                <div class="card">
                    <p><strong>Uploaded:</strong> <span class="highlight"><?php echo htmlspecialchars($uploadedFile, ENT_QUOTES, 'UTF-8'); ?></span></p>
                    <p class="muted">Access at: <code class="highlight">/uploads/<?php echo htmlspecialchars($uploadedFile, ENT_QUOTES, 'UTF-8'); ?></code></p>
                </div>
            <?php endif; ?>

            <form method="post" enctype="multipart/form-data" class="stack">
                <label>
                    Select File
                    <input type="file" name="file" required>
                </label>
                <button type="submit">Upload</button>
            </form>
        </div>

        <p class="footer-note">Security lesson: validate file types and disable script execution in upload directories.</p>
    </div>
</body>
</html>
