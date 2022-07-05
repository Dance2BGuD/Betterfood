<?php
include 'db_config.php';
$id = $_POST["id"];

$status = 0;

if (isset($id)) {
    $sql = "DELETE FROM users WHERE id=$id";
        if ($connect->query($sql) === TRUE) {
        header("Location:admin.php?edit=5");
        $status = 1;
      } else if ($status == 0) {
        header("Location:admin.php?edit=2");
      }
}
?>