<?php
include 'db_config.php';
$name = $_POST["name"];
$price = $_POST["price"];
$description = $_POST["desc"];
$id = $_POST["id"];

$status = 0;

if (isset($name) and isset($price) and isset($description) and isset($id)) {
    $sql = "UPDATE products SET name='$name', price='$price', description='$description' WHERE id='$id'";
    if ($connect->query($sql) === TRUE) {
        header("Location:admin.php?edit=1");
        $status = 1;
      } else if ($status == 0) {
        header("Location:admin.php?edit=2");
      }
}
?>