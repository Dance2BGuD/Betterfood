<?php
use PHPMailer\PHPMailer\PHPMailer;
include 'db_config.php';
//Az átküldött értékeket változókba olvassuk
$username_r = $_POST['username'];
$email = $_POST['email'];
$name_r = $_POST['name'];
$address_r = $_POST['address'];
$number_r = $_POST['number'];
$place_r = $_POST['place'];
$password_r = $_POST['password'];
$password_c = $_POST['password_c'];
$activation = 0;
$verification_code = rand(10,100000);
$status = 0;

$number = preg_replace('/[^0-9]/', '', $number_r );
$username = preg_replace("/[^A-Za-z0-9]/","", $username_r);
$name = preg_replace("/[^A-Za-z ]/","", $name_r);
$address = preg_replace("/[^A-Za-z0-9 ]/","", $address_r);
$place = preg_replace("/[^A-Za-z ]/","", $place_r);

if($password_c == $password_r){
$password = md5($password_r);
} else {
  $status = 4;
}

$activation_link = "http://" . $localhost . "/sandwichbar/activation.php?activation_code=" . $verification_code;

$subject = "Profile activation link:" . $activation_link . "<hr><br>Thanks for the registering. Have a nice day.";


//Megnézzük, hogy minden mező kivan-e töltve, amennyiben nincs, hibát jelez
    if (isset($username) and isset($email) and isset($name) and isset($address) and isset($place) and isset($activation) and isset($password) and isset($number) and $status == 0) {
      $sql = "SELECT email FROM profiles";
      if ($result = $connect -> query($sql)) {
        while ($row = $result -> fetch_assoc()) {
            if($email == $row['email']){
               // echo "LOGIN PASSED";
                $status = 3;
            }
          }
        }
        if ($status !== 3){
        $sql = "INSERT INTO profiles (username, email, password, name, address, city, contact, verification, activation)
        VALUES ('$username', '$email', '$password', '$name', '$address', '$place', '$number', '$verification_code', '$activation')";
        if ($connect->query($sql) === TRUE) {

          require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth   = true;
$mail->Username   = 'sandwichbarinfo@gmail.com';
$mail->Password   = 'password123+';
$mail->SMTPSecure = "tls";
$mail->Port       = 587;

//Recipients
$mail->isHTML(true);
$mail->setFrom('sandwichbarinfo@gmail.com');
$mail->addAddress($email);     // Add a recipient



$mail->Subject = ' Profile activation email (Sandwichbar)';
$mail->Body    = $subject;

$mail->send();
            $status = 1;
        }
      }
          } if ($status == 1) {
            header("Location:profile.php?sign=1");
          } else if ($status == 0) {
            header("Location:profile.php?sign=2");
          }
          else if ($status == 3) {
            header("Location:profile.php?sign=3");
          }
          else if ($status == 4) {
            header("Location:profile.php?sign=4");
          }
?>