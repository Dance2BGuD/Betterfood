<?php
require_once 'db_config.php';

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
include "header.php";
?>
    <section class="hero">
        <div class="page-wrapper">
            <div class="hero-text">Sandwich Bar</div>
        </div>
    </section>

    <section class="product-list block">
        <div class="page-wrapper">
            <div class="block-title-sandwich">Sandwiches</div>
            <div class="product-list__content">
                <?php
                //Sima kilistázás az adatbázisból
                    if (!empty($products)) {
                        foreach ($products as $key => $value) {
                            $id=$value['id'];
                            echo '
                            <a class="product-list__item" href="product.php?id='.$id.'">
                                <div class=product-list__item-container>
                                    <img src="'.$value['photo'].'" class="product-list__picture" alt="">
                                    <div class="product-list__title">'.$value['category'].'</div>
                                    <div class="product-list__subtitle">'.$value['name'].'</div>
                                    <div class="product-list__price">'.$value['price'].' din.</div>
                                    <object><a class="product-list__buy" href="cart.php?id='.$id.'">BUY</a></object>
                                </div>
                            </a>';
                        }
                    }
                    else {
                        echo '<p class="products-error"> Products not found </p>';
                    }
                ?>
            </div>
        </div>
    </section>

<?php include "footer.php"?>