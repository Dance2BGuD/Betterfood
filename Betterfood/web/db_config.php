<?php 
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DATABASE', 'betterfood');

$localhost = "192.168.31.150";


//Létrehozzuk a csatlakozást
$connect = new mysqli(HOST,USER,PASS,DATABASE);
if($connect -> connect_errno) {
    echo $connect -> connect__error;
}

$connect->set_charset('utf8');
?>