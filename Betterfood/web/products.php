<?php
include "header.php";

require_once 'db_config.php';


$sql_str = "";

//A keresőt itt hozzuk létre
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $connect->real_escape_string($_GET['search']);
    $search_arr = explode(' ', $search);
    foreach ($search_arr as $key => $value) {
        if(mb_strlen($value) <= 2) {
            unset($search_arr[$key]); 
        }
    }
    if (isset($search_arr) && !empty($search_arr)) {
        $where = array();
        foreach ($search_arr as $key => $value) {
            $where[] = "WHERE name LIKE '%$value%' OR category LIKE '%$value%'"; //A kereső a név, vagya gyártó alapján listázza az elemeket
        }
        $sql_str .= implode(' OR ', $where);
    }
}else {
  if (isset($_GET['filter'])&& !empty($_GET['filter'])) {
    if ($_GET['filter']!="*") {
    $search = $connect->real_escape_string($_GET['filter']);
    $search_arr = explode(' ', $search); // explode search string to "words"
    if (isset($search_arr) && !empty($search_arr)) {
        $where = array();
        foreach ($search_arr as $key => $value) {
            $where[] = "WHERE category LIKE '%$value%'"; //Egy selecttel szűrjük az elemek listáját a meghatározott gyártók alapján
        }
      $sql_str .= implode('', $where);
    }
  }else {
    $sql_str = "";
  }
  }
}

//Kilistázzuk az elemeket a termékek táblából
if (isset($sql_str)) {
    $sql = "SELECT id, category, name, price, photo, availability FROM products " . $sql_str;
    if ($result = $connect -> query($sql)) {
        while ($row = $result -> fetch_assoc()) {
            $products[] = $row;
        }
    }
}
?>

    <section class="main-cover main-cover-products">
        <div class="page-wrapper">
            <div class="block-title block-title--white">Sandwich list</div>
        </div>
    </section>
    <section class="product-list block">
    <div class="order-info">
<?php

if (isset($_GET['buy']))
$buy = $_GET['buy'];
else
$buy = "";

if ($buy == "1")
echo "<span style='color: green; font-size: 20px'>Sandwich ordered! Check your mail.</span>";
if ($buy == "2")
echo "<span style='color: crimson; font-size: 20px'>Something went wrong! Please repeat again!</span>";

?>
</div>
        <div class="page-wrapper">
            <form class="product-search" method="get">
                <!--A select filter, a gyártó alapján-->
                <select class="select-css" name="filter" onchange="this.form.submit()">
                  <option value="" selected hidden disabled>
                  Category
                  </option>
                  <option value="Traditional">
                  Traditional sandwiches
                  </option>
                  <option value="Custom">
                  Custom sandwiches
                  </option>
                  <option value="*">
                    All sandwiches
                  </option>
                </select>
                <!--A kereső a gyártó és a típus alapján-->
                <input placeholder="Search" name="search" type="text">
                <button type="submit">Search</button>
            </form>
            <div class="product-list__content">
                <?php
                    //A kilistázott elemek kiíratása
                    if (!empty($products)) {
                        foreach ($products as $key => $value) {
                            $id=$value['id'];
                            echo '
                            <a class="product-list__item" href="product.php?id='.$id.'">
                                <div class=product-list__item-container>
                                    <div class="product-list__picture"><img src="'.$value['photo'].'" alt=""></div>
                                    <div class="product-list__subtitle">'.$value['name'].'</div>
                                    <div class="product-list__price">'.$value['price'].' din.</div>
                                    <object><a class="product-list__buy" href="cart.php?id='.$id.'">BUY</a></object>
                                </div>
                            </a>';
                        }
                    }
                    else {
                        //Ha egy terméket se talál, hibát ír ki
                        echo '<p class="products-error"> Sandwiches are not found </p>';
                    }
                ?>
            </div>
        </div>
    </section>


<?php include "footer.php"?>
