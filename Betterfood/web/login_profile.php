<?php
include 'db_config.php';
$username = $_POST["uname"];
$password = $_POST["psw"];

$password_md5 = md5($password);

//echo $username;
//echo $password_md5;
$status = 0;

if (isset($username) and isset($password_md5)) {
    $sql = "SELECT username, email, password, activation FROM profiles ";
    if ($result = $connect -> query($sql)) {
        while ($row = $result -> fetch_assoc()) {
            if($username == $row['username'] and $password_md5 == $row['password']){
                if($row['activation'] == 1){
               // echo "LOGIN PASSED";
               header("Location:profile.php?acces=$username");
               session_start();
               $_SESSION["email_p"] = $row['email'];
               $_SESSION["username_p"] = $username;
                $status = 1;
                }
                else {
                    $status = 2;
                }
            }
            if ($status == 0){
                header("Location:profile.php?error=2");
            }
        }
    }
    if ($status == 0){
        header("Location:profile.php?error=2");
    }
}
if ($status == 0){
    header("Location:profile.php?error=2");
}
if ($status == 2){
    header("Location:profile.php?error=3");
}

?>
