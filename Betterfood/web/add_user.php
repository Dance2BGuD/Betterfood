<?php>
include 'db_config.php';
$username = $_POST["username"];
$password = $_POST["password"];

$password_md5 = md5($password);

$status = 0;

if (isset($username) and isset($password_md5)) {
    $sql = "INSERT INTO users (username, password)
    VALUES ('$username', '$password_md5')";
    if ($connect->query($sql) === TRUE) {
        header("Location:admin.php?edit=3");
        $status = 1;
      } else if ($status == 0) {
        //header("Location:admin.php?edit=2");
        echo "Error: " . $sql . "<br>" . $connect->error;
      }
}


?>