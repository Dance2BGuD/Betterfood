<?php
use PHPMailer\PHPMailer\PHPMailer;
include 'db_config.php';
//Az átküldött értékeket változókba olvassuk
$foodname = $_POST['foodname'];
$email = $_POST['email'];
$name = $_POST['name'];
$address = $_POST['address'];
$number_c = $_POST['number'];
$place = $_POST['place'];
$price = $_POST['price'];

$number = preg_replace('/[^0-9]/', '', $number_c );

$subject = "Foodname:" . $foodname . "<br>Name:" . $name . "<br>Address:" . $address . "<br>Contact number:" . $number . "<br>Place:" . $place . "<br>Price:" . $price . "<hr><br>Thanks for the ordering. Have a nice day.";


//Megnézzük, hogy minden mező kivan-e töltve, amennyiben nincs, hibát jelez
    if (isset($foodname) and isset($email) and isset($name) and isset($address) and isset($place) and isset($price) and isset($number)) {
        $sql = "INSERT INTO orders (foodname, email, name, address, number, place, price)
        VALUES ('$foodname', '$email', '$name', '$address', '$number', '$place', '$price')";
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



$mail->Subject = 'Order verification (Sandwichbar)';
$mail->Body    = $subject;

$mail->send();
            header("Location:products.php?buy=1");
            $status = 1;
          } else if ($status == 0) {
            header("Location:products.php?buy=2");
          }
    }
?>