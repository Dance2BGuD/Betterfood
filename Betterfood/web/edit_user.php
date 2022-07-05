<?php
include 'db_config.php';
$username = $_POST["username"];
$password = $_POST["password"];
$password_md5 = md5($password);
$id = $_POST["id"];

$status = 0;

if (isset($username) and isset($password_md5)) {
    $sql = "UPDATE users SET username='$username', password='$password_md5' WHERE id='$id'";
    if ($connect->query($sql) === TRUE) {
        header("Location:admin.php?edit=4");
        $status = 1;
      } else if ($status == 0) {
        header("Location:admin.php?edit=2");
      }
}
?>