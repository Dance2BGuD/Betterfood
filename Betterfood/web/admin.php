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

include "header_admin.php";
?>
    <div class="backend_menu">
     <a href="admin.php?menu=sandwiches">Sandwiches</a>
     <a href="admin.php?menu=users">Users</a>
     <a href="admin.php?menu=orders">Orders</a>
     <a href="logout.php">Logout</a>
     </div>
          <div class="admin_content">
    <?php
                //received errors from login
                session_start();
                $status = 0;
                if (isset($_SESSION["username"])){
                    $user = $_SESSION["username"];
                    $status = 1;
                    echo "<span style='color: green; font-size: 15px'>Logged in: $user</span><br><br>";
                    if (isset($_GET['edit'])){
                        $edit_err = $_GET['edit'];
                        }
                        else {
                            $edit_err = "";
                        }
                        if($edit_err == 1){
                            echo "<span style='color: green; font-size: 15px'>Sandwich saved!</span>";
                        }
                        if($edit_err == 2){
                            echo "<span style='color: crimson; font-size: 15px'>Sandwich not saved!</span>";
                        }
                        if($edit_err == 3){
                            echo "<span style='color: green; font-size: 15px'>User added!</span>";
                        }
                        if($edit_err == 4){
                            echo "<span style='color: green; font-size: 15px'>User edited!</span>";
                        }
                        if($edit_err == 5){
                            echo "<span style='color: green; font-size: 15px'>User deleted!</span>";
                        }
                    if (isset($_GET['menu'])){
                        $menu = $_GET['menu'];
                        }
                        else {
                            $menu = "";
                        }
                        if (isset($_GET['id_delete'])){
                            $delete = $_GET['id_delete'];
                            $sql = "DELETE FROM products WHERE id=$delete";
                            if ($connect->query($sql) === TRUE) {
                                echo "<br>Sandwich deleted successfully";
                            } else {
                                echo "<br><span style='color: crimson; font-size: 15px'>Error deleting sandwich: </span>" . $connect->error;
                            }
                            }
                            else {
                                $delete = "";
                            }

                            if (isset($_GET['user_delete'])){
                                $user_delete = $_GET['user_delete'];
                                $sql = "DELETE FROM users WHERE id=$user_delete";
                                if ($connect->query($sql) === TRUE) {
                                    echo "<br>User deleted successfully";
                                } else {
                                    echo "<br><span style='color: crimson; font-size: 15px'>Error deleting sandwich: </span>" . $connect->error;
                                }
                                }
                                else {
                                    $user_delete = "";
                                }

                                if (isset($_GET['order_delete'])){
                                    $order_delete = $_GET['order_delete'];
                                    $sql = "DELETE FROM orders WHERE id=$order_delete";
                                    if ($connect->query($sql) === TRUE) {
                                        echo "<br>Order deleted successfully";
                                    } else {
                                        echo "<br><span style='color: crimson; font-size: 15px'>Error deleting sandwich: </span>" . $connect->error;
                                    }
                                    }
                                    else {
                                        $order_delete = "";
                                    }
                            if (isset($_GET['id_edit'])){
                                $edit = $_GET['id_edit'];
                                $sql = "SELECT id, category, name, price, photo, description FROM products";
                                $result = $connect->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        if($row["id"] == $edit){
                                         echo "<form action='edit_page.php' method='post'>
                                         <label for='id'>Sandwich ID:</label><br>
                                         <input type='text' id='id' name='id' value='" . $row['id'] . "' readonly><br>
                                         <label for='name'>Sandwich name:</label><br>
                                         <input type='text' id='name' name='name' value='" . $row['name'] . "'><br>
                                         <label for='price'>Price:</label><br>
                                         <input type='text' id='price' name='price' value='" . $row['price'] . "'><br>
                                         <label for='desc'>Description:</label><br>
                                         <textarea id='desc' name='desc' rows='10' cols='50'>
                                         " . $row['description'] . "</textarea><br><br>
                                         <input class='login__button' type='submit' value='Save'>
                                       </form>";
                                        }
                                    }
                                  } else {
                                    echo "0 results";
                                  }
                            }
                            else {
                                $edit = "";
                            }

                            if (isset($_GET['user_edit'])){
                                $user_edit = $_GET['user_edit'];
                                $sql = "SELECT id, username FROM users";
                                $result = $connect->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        if($row["id"] == $user_edit){
                                         echo "<form action='edit_user.php' method='post'>
                                         <label for='id'>ID:</label><br>
                                         <input type='text' id='id' name='id' value='" . $row['id'] . "' readonly><br>
                                         <label for='name'>Username:</label><br>
                                         <input type='text' id='name' name='username' value='" . $row['username'] . "'><br>
                                         <label for='pwd'>Password:</label><br>
                                         <input type='password' id='pwd' name='password' minlength='4'><br><br>
                                         <input class='login__button' type='submit' value='Save'>
                                       </form>";
                                        }
                                    }
                                  } else {
                                    echo "0 results";
                                  }
                            }
                            else {
                                $user_edit = "";
                            }
                            if (isset($_GET['add_sandwich'])){
                                $add_sandwich = $_GET['add_sandwich'];
                                echo "<form action='add_page.php' method='post' enctype='multipart/form-data'>
                                         <label for='category'>Sandwich category:</label><br>
                                         <select name='category' id='category'>
                                         <option value='Traditional'>Traditional</option>
                                         <option value='Custom'>Custom</option>
                                         </select><br><br>
                                         <label for='name'>Sandwich name:</label><br>
                                         <input type='text' id='name' name='name' value=''><br>
                                         <label for='price'>Price:</label><br>
                                         <input type='text' id='price' name='price' value=''><br><br>
                                         <label for='img'>Select image:</label>
                                         <input type='file' id='img' name='img' accept='image/*'><br><br>
                                         <label for='piece'>Availability:</label><br>
                                         <input type='number' id='piece' name='piece' value=''><br><br>
                                         <label for='desc'>Description:</label><br>
                                         <textarea id='desc' name='desc' rows='10' cols='50'></textarea><br><br>
                                         <input class='login__button' type='submit' value='Add'>
                                         <input class='login__button' type='reset' value='Cancel'><br>
                                       </form>";
                            }
                            else {
                                $add_sandwich = "";
                            }
                            if (isset($_GET['add_user'])){
                                $add_sandwich = $_GET['add_user'];
                                echo "<form action='add_user.php' method='post' enctype='multipart/form-data'>
                                         <label for='name'>Username:</label><br>
                                         <input type='text' id='name' name='username' value='' ><br><br>
                                         <label for='pwd'>Password:</label><br>
                                         <input type='password' id='pwd' name='password' minlength='4'><br><br>
                                         <input class='login__button' type='submit' value='Add'>
                                         <input class='login__button' type='reset' value='Cancel'>
                                       </form>";
                            }
                            else {
                                $add_sandwich = "";
                            }
                        if($menu == "sandwiches"){
                                                        ?>
                            <div class="sandwiches">
                            <a href="admin.php?add_sandwich=1"><i class="fas fa-plus-square fa-lg"></i></a>
                            <table class="tables">
                            <tr>
                            <th>ID</th>
                            <th>Sandwich</th>
                            <th>Category</th> 
                            <th>Price</th>
                            <th>Actions</th>
                           </tr>
                                <?php
                            $sql = "SELECT id, category, name, price, photo, description FROM products";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["category"] . "</td><td>" . $row["price"] . " RSD</td><td><a href='admin.php?id_edit=" . $row["id"] . "'><i class='fas fa-edit'></i></a>  <a href='admin.php?id_delete=" . $row["id"] . "'><i class='fas fa-trash'></i></a></td></tr>";
  }
} else {
  echo "0 results";
}
?>
                        </div>
</table>
                            <?php
                        }
                        if($menu == "users"){
                            ?>
                            <div class="sandwiches">
                            <a href="admin.php?add_user=1"><i class="fas fa-plus-square fa-lg"></i></a>
                            <table class="tables">
                            <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Actions</th>
                           </tr>
                                <?php
                            $sql = "SELECT id, username FROM users";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["username"]. "</td><td>" . "<a href='admin.php?user_edit=" . $row["id"] . "'><i class='fas fa-edit'></i></a>  <a href='admin.php?user_delete=" . $row["id"] . "'><i class='fas fa-trash'></i></a></td></tr>";
  }
} else {
  echo "0 results";
}
?>
                        </div>
</table>
                            <?php
                        }
                        if($menu == "orders"){
                            ?>
                            <div class="sandwiches">
                            <table class="tables">
                            <tr>
                            <th>ID</th>
                            <th>Foodname</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact Number</th>
                            <th>Place</th>
                            <th>Price</th>
                            <th>Actions</th>
                           </tr>
                                <?php
                            $sql = "SELECT id, foodname, email, name, address, number, place, price FROM orders";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["foodname"]. "</td><td>" . $row["email"]. "</td><td>" . $row["name"]. "</td><td>" . $row["address"]. "</td><td>" . $row["number"]. "</td><td>" . $row["place"]. "</td><td>" . $row["price"]. "</td><td>" . "<a href='admin.php?order_delete=" . $row["id"] . "'><i class='fas fa-trash'></i></a></td></tr>";
  }
} else {
  echo "0 results";
}
?>
                        </div>
</table>
                            <?php
                        }
                }
                else if ($status ==0){
                    header("Location:login.php?error=1");
                }
                ?>
     </div>