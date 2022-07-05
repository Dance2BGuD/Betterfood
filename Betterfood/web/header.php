<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SandwichBar - Traditional and custom sandwiches</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="css/sanitize.css">
        <link rel="stylesheet" type="text/css" media="screen" href="css/main.css"/>
        <link rel="stylesheet" type="text/css" media="screen" href="css/login.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!--Létrehozzuk a fejlécet-->
        <header class="header js-header">
            <div class="page-wrapper">
            <a class="logo" href="index.php"><img src="images/logo.png" alt=""></a>
                <!--<div class="nav-wrapper js-nav-wrapper">
                    <nav class="nav">
                        <ul class="list">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="products.php">Sandwiches</a></li>
                            <li><a href="login.php">Admin</a></li>
                        </ul>
                    </nav>
                </div>--> 
                <div class="topnav" id="myTopnav">
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a> 
  <a href="index.php">Home</a>
  <a href="products.php">Sandwiches</a>
  <a href="profile.php">Profile</a>
  <a href="login.php" target="_blank">Admin</a>
  
</div>

<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
</div> 
        </header>
    