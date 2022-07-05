<?php
require_once 'db_config.php';
session_start();
if (isset($_SESSION["username_profile"])){
    header("Location:profile.php");
}

$connect = new mysqli(HOST,USER,PASS,DATABASE);
if($connect -> connect_errno) {
    echo $connect -> connect__error;
}
include "header.php";
?>

    <section class="product-list block">
        <div class="page-wrapper">
        <?php
      if (isset($_GET['acces']) or isset($_SESSION["username_p"])) {
        $login_p = $_SESSION["username_p"];
        echo $login_p;
        echo "<br><a href='logout.php'><span style='color: crimson'>Logout</span></a>";
        }
        else {
            ?>
  <div class="imgcontainer">
    Login<br>
    <span style='font-size: 18px'>If you not have account. Sign Up <a href="profile.php?registrate=1"><span style='color: crimson'>here</span></a>!</span><br>
    <?php
                //received errors from login
                if (isset($_GET['activation']))
                    $active = $_GET['activation'];
                else
                    $active = "";

                if ($active == "1")
                    echo "<span style='color: green; font-size: 15px'>Activation complete! Now you can Log in.</span>";
                if ($active == "2")
                    echo "<span style='color: crimson; font-size: 15px'>Activation went wrong! Repeat agian.</span>";

                    if (isset($_GET['sign']))
                    $sign = $_GET['sign'];
                else
                    $sign = "";

                if ($sign == "1")
                    echo "<span style='color: green; font-size: 15px'>Registration completed! Activation link send to the mail address.</span>";
                if ($sign == "2")
                    echo "<span style='color: crimson; font-size: 15px'>Something went wrong! Please repeat again.</span>";
                    if ($sign == "3")
                    echo "<span style='color: crimson; font-size: 15px'>Email is registered! Please repeat again with another email.</span>";
                    if ($sign == "4")
                    echo "<span style='color: crimson; font-size: 15px'>Passwords are not same! Please repeat again.</span>";

                if (isset($_GET['error']))
                    $error = $_GET['error'];
                else
                    $error = "";

                if ($error == "1")
                    echo "<span style='color: green; font-size: 15px'>Registration completed! Activation link send to the mail address.</span>";
                if ($error == "2")
                    echo "<span style='color: crimson; font-size: 15px'>Something went wrong! Please repeat again.</span>";
                    if ($error == "3")
                    echo "<span style='color: crimson; font-size: 15px'>Account not activated!</span>";
                ?>
  </div>

  <div class="container">
      <?php
      if (isset($_GET['acces']) or isset($_SESSION["username_p"])) {
        $login_p = $_SESSION["username_p"];
        echo $login_p;
        }
      //received errors from login
      if (isset($_GET['registrate'])) {
      $registrate = $_GET['registrate'];
      echo "
      <form class='loginform' action='registration.php' method='post' enctype='multipart/form-data'>
      <span style='font-size: 22px'>Sign Up</span><br>
      <p><span style='color: crimson'>*</span> - These fields are required!</p>
      <br><label>Username:<span style='color: crimson'>*</span> </label><input class=\"logininput\" name=\"username\" type=\"text\" required><br>
          <label>E-mail:<span style='color: crimson'>*</span> </label><input id=\"email\" class=\"logininput\" name=\"email\" type=\"text\" required>
          <label>Name:<span style='color: crimson'>*</span> </label><input id=\"name\" class=\"logininput\" name=\"name\" type=\"text\" required><br>
          <label>Password:<span style='color: crimson'>*</span> </label><input id=\"password\" class=\"logininput\" name=\"password\" type=\"password\" required><br>
          <label>Confirm password:<span style='color: crimson'>*</span> </label><input id=\"password_c\" class=\"logininput\" name=\"password_c\" type=\"password\" required><br>
          <label>Address:<span style='color: crimson'>*</span> </label><input id=\"address\" class=\"logininput\" name=\"address\" type=\"text\" required><br>
          <label>City, country:<span style='color: crimson'>*</span> </label><input id=\"place\" class=\"logininput\" name=\"place\" type=\"text\" required><br>
          <label>Contact number:<span style='color: crimson'>*</span> </label><input id=\"number\" class=\"logininput\" name=\"number\" type=\"text\" maxlength='15' required><br>
          <button type=\"submit\" class=\"cart__button\">SIGN UP</button>
          <button type=\"reset\" class=\"cart__button\">CANCEL</button>
          </form>
      ";
      }
      else {
      ?>
              <form class="loginform" action="login_profile.php" method="post">
    <label for="uname"><b>Username</b></label>
    <input class="logininput" type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input class="logininput" type="password" placeholder="Enter Password" name="psw" required>

    <button class="loginbutton" type="submit">Login</button>
    <button class="loginbutton" type="reset" class="button">Cancel</button>
    </form>
  </div>

 <!-- <div class="container" style="background-color:#f1f1f1">
  <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div> -->
<?php
      }
    }
      ?>
        </div>
    </section>

<?php include "footer.php"?>