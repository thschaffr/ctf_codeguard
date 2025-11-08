<?php
require_once "../config.php";
require_once "../classes/Deserializable.php";

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $data = $_POST['data'];
    // Unsafe deserialization vulnerability
    $obj = unserialize(base64_decode($data));
    echo "Deserialized!<br>";
    echo "<pre>";
    var_dump($obj);
    echo "</pre>";
}
?>
<form method="post">
  Base64-serialized object:<br>
  <textarea name="data" rows="6" cols="60"></textarea><br>
  <button>Submit</button>
</form>
