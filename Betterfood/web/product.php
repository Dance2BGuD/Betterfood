<?php
include_once("db_config.php");
$sql = "SELECT * FROM products;";
$res = mysqli_query($connect, $sql);
$rescheck = mysqli_num_rows($res);



include "header.php";
?>


<section class="product-inner block">
    <div class="page-wrapper">
        <?php
            /*Ha a termék listában rákattintunk egy elemre, akkor annak az ID-je alapján az elem termék belsejét láthatjuk.
            Az ID alapján kilistázza az adatokat a kiválasztott termékről*/
            if (isset($_GET['id'])) {
                $sid=$_GET['id'];
            $sql= "SELECT * FROM products WHERE id='$sid';";
            $result=mysqli_query($connect,$sql);
            $queryres = mysqli_num_rows($result);
                if($queryres > 0){
                    while($row=mysqli_fetch_assoc($result)){
                        echo "
                            <div class=\"product-inner__container\">
                                <div class=\"row1\">
                                    <div class=\"kep\"><img class=\"size\" src=".$row['photo']."></div>
                                </div>

                                <div class=\"row2\"> 
                                    <div class=\"product-inner__title\">".$row['category']."</div>
                                    <div class=\"product-inner__subtitle\">".$row['name']."</div>
                                    <div class=\"product-inner__desc\">".$row['description']."</div>
                                    <div class=\"product-inner__price\">".$row['price']." din.</div>
                                </div>

                                <div class=\"row3\">
                                    <a class=\"product-inner__buy\" href=\"cart.php?id=".$sid."\">BUY</a>
                                </div>
                            </div>
                        ";
                    }
                }
            }
        ?>
    </div>
</section>

<?php include "footer.php"?>