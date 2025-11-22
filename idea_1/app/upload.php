<?php
require_once "../config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$uploadMessage = null;
$uploadSuccess = false;
$uploadedFile = null;
$uploadErrorDetail = null;

function upload_error_text(int $code): string {
    return match ($code) {
        UPLOAD_ERR_INI_SIZE => "File exceeds php.ini upload_max_filesize.",
        UPLOAD_ERR_FORM_SIZE => "File exceeds MAX_FILE_SIZE directive.",
        UPLOAD_ERR_PARTIAL => "File only partially uploaded.",
        UPLOAD_ERR_NO_FILE => "No file received.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Cannot write to disk.",
        UPLOAD_ERR_EXTENSION => "Upload blocked by PHP extension.",
        default => "Unknown error (code {$code}).",
    };
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $uploadMessage = "Upload failed.";
        $uploadErrorDetail = upload_error_text($file['error']);
    } else {
        // Intentionally insecure: no validation on file type or content
        $uploadDir = dirname(__DIR__) . '/uploads/';
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                $uploadMessage = "Upload failed.";
                $uploadErrorDetail = "Unable to create upload directory.";
            }
        }

        if ($uploadErrorDetail === null && !is_writable($uploadDir)) {
            @chmod($uploadDir, 0777);
        }

        $targetPath = $uploadDir . basename($file['name']);

        if ($uploadErrorDetail === null && @move_uploaded_file($file['tmp_name'], $targetPath)) {
            $uploadMessage = "File uploaded successfully.";
            $uploadedFile = basename($file['name']);
            $uploadSuccess = true;
        } else {
            $uploadMessage = "Upload failed.";
            if ($uploadErrorDetail === null) {
                $uploadErrorDetail = "Unable to move uploaded file. Check directory permissions.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload | Vulnerable App</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="app-shell">
        <header class="app-header">
            <h1>File Upload</h1>
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
                <h2>Upload a File</h2>
                <p class="muted">
                    Submit files for processing. The system accepts any file type and stores them in the uploads directory.
                </p>
            </div>

            <?php if ($uploadMessage): ?>
                <?php $alertClass = $uploadSuccess ? 'alert-success' : 'alert'; ?>
                <div class="<?php echo $alertClass; ?>">
                    <?php echo htmlspecialchars($uploadMessage, ENT_QUOTES, 'UTF-8'); ?>
                    <?php if (!$uploadSuccess && $uploadErrorDetail): ?>
                        <br><span class="muted"><?php echo htmlspecialchars($uploadErrorDetail, ENT_QUOTES, 'UTF-8'); ?></span>
                    <?php endif; ?>
                </div>
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
    <div class="footer-anim">
        <div class="pacman"></div>
        <div class="ghost ghost-1"></div>
        <div class="ghost ghost-2"></div>
    </div>
</body>
</html>
