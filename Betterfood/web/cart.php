<?php
include_once("db_config.php");
$sql = "SELECT * FROM products;";
$res = mysqli_query($connect, $sql);
$rescheck = mysqli_num_rows($res);
$email_p = "";
session_start();
if (isset($_SESSION["email_p"])){
    $email_p = $_SESSION["email_p"];
}

$email = "";
$name = "";
$address = "";
$city = "";
$contact = "";



include "header.php";
?>
<section class="main-cover main-cover-cart">
        <div class="page-wrapper">
            <div class="block-title block-title--white">Cart</div>
        </div>
</section>

<section class="cart block">
    <div class="page-wrapper">
        <div class="cart__container">
            <form action="buy.php" method="POST">
                <?php
                //Itt töltjük ki a hiányzó adatokat a rendelés befejezéséhez(lakcím, email cím stb.)
                if(isset($email_p)){
                $sql = "SELECT email, name, address, city, contact FROM profiles ";
    if ($result = $connect -> query($sql)) {
        while ($row = $result -> fetch_assoc()) {
            if($email_p == $row['email']){
                $email = $row['email'];
                $name = $row['name'];
                $address = $row['address'];
                $city = $row['city'];
                $contact = $row['contact'];
            
            }
        }
    }
}

                if (isset($_GET['id'])) {
                    $sid=$_GET['id'];
                    if($sid == 0){
                        header("Location:index.php");
                    }
                $sql= "SELECT * FROM products WHERE id='$sid';";
                $result=mysqli_query($connect,$sql);
                $queryres = mysqli_num_rows($result);
                    if($queryres > 0){
                        //Az itt bevitt adatokat továbbítjuk a buy.php-nak, ahol ellenőrízni fogja, hogy minden "rendben" van-e
                        while($row=mysqli_fetch_assoc($result)){
                            echo"<div id=\"mand\">*These fields are required!</div>";
                            echo "
                                <label>Foodname:</label><input readonly name=\"foodname\" type=\"text\" value=\"".$row['name']."\">
                                <label>E-mail:*</label><input id=\"email\" name=\"email\" type=\"text\" value=\"".$email."\" required>
                                <label>Name:*</label><input id=\"name\" name=\"name\" type=\"text\" value=\"".$name."\" required>
                                <label>Address:*</label><input id=\"address\" name=\"address\" type=\"text\" value=\"".$address."\" required>
                                <label>City, country:*</label><input id=\"place\" name=\"place\" type=\"text\" value=\"".$city."\" required>
                                <label>Contact number:*</label><input id=\"number\" name=\"number\" type=\"text\" maxlength='15' value=\"".$contact."\" required>
                                <label>Price:</label><input readonly name=\"price\" type=\"text\" value=\"".$row['price']."\">
                                <button type=\"submit\" class=\"cart__button\">ORDER</button>
                            ";
                        }
                    }
                }
                ?>
            </form>
            <?php
            if (isset($_GET['id'])) {
                $sid=$_GET['id'];
            $sql= "SELECT * FROM products WHERE id='$sid';";
            $result=mysqli_query($connect,$sql);
            $queryres = mysqli_num_rows($result);
                if($queryres > 0){
                    while($row=mysqli_fetch_assoc($result)){
                        echo "<img src=\"".$row['photo']."\" class=\"cart__picture\">";
                    }
                }
            }
            ?>
        </div>
        
    </div>
</section>
<script type="text/javascript" src="js/cart.js"></script>
<?php include "footer.php"?>