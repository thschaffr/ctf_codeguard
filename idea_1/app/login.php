<?php
require_once "../config.php";
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $u = $_POST['user'];
    $p = $_POST['pass'];
    // SQL Injection vulnerability
    $sql = "SELECT * FROM users WHERE username = '$u' AND password = '$p';";
    foreach ($db->query($sql) as $row) {
        $_SESSION['user_id'] = $row['id'];
        header("Location: profile.php");
        exit;
    }
    echo "Bad credentials";
}
?>
<form method="post">
  User: <input name="user"><br>
  Pass: <input name="pass" type="password"><br>
  <button>Login</button>
</form>
