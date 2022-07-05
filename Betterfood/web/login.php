<?php
require_once 'db_config.php';
session_start();
if (isset($_SESSION["username"])){
    header("Location:admin.php");
}

$connect = new mysqli(HOST,USER,PASS,DATABASE);
if($connect -> connect_errno) {
    echo $connect -> connect__error;
}

//A három legdrágább telefont listázzuk ki a főoldalon, az adatbázisunkból
$sql = "SELECT id, category, name, price, photo, availability FROM products ORDER BY price desc limit 3";
if ($result = $connect -> query($sql)) {
    while ($row = $result -> fetch_assoc()) {
        $products[] = $row;
    }
}

include "header_admin.php";
?>

    <section class="product-list block">
        <div class="page-wrapper">
        <form class="loginform" action="login_page.php" method="post">
  <div class="imgcontainer">
    Login<br>
    <?php
                //received errors from login
                if (isset($_GET['error']))
                    $error = $_GET['error'];
                else
                    $error = "";

                if ($error == "1")
                    echo "<span style='color: crimson; font-size: 15px'>Wrong username or password!</span>";
                /*if ($l == "2")
                    echo "<span style='color: crimson; font-size: 15px'>Wrong username or password!</span>";
                if ($l == "3")
                    echo "<span style='color: crimson; font-size: 15px'>Activate your account!</span>";*/
                ?>
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input class="logininput" type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input class="logininput" type="password" placeholder="Enter Password" name="psw" required>

    <button class="loginbutton" type="submit">Login</button>
    <button class="loginbutton" type="reset" class="button">Cancel</button>
  </div>

 <!-- <div class="container" style="background-color:#f1f1f1">
  <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div> -->
</form>
        </div>
    </section>

<?php include "footer.php"?>