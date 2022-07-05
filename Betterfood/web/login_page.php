<?php
include 'db_config.php';
$username = $_POST["uname"];
$password = $_POST["psw"];

$password_md5 = md5($password);

//echo $username;
//echo $password_md5;
$status = 0;

if (isset($username) and isset($password_md5)) {
    $sql = "SELECT username,  password FROM users ";
    if ($result = $connect -> query($sql)) {
        while ($row = $result -> fetch_assoc()) {
            if($username == $row['username'] and $password_md5 == $row['password']){
               // echo "LOGIN PASSED";
               header("Location:admin.php?acces=$username");
               session_start();
               $_SESSION["username"] = $username;
                $status = 1;
            }
            else if ($status == 0){
                header("Location:login.php?error=1");
            }
        }
    }
    else if ($status == 0){
        header("Location:login.php?error=1");
    }
}
else if ($status == 0){
    header("Location:login.php?error=1");
}

?>
