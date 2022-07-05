<?php
include 'db_config.php';
$json = file_get_contents('php://input');
$REQUEST = !empty($_REQUEST) ? $_REQUEST : json_decode($json, true);

header('Content-Type: application/json; charset=UTF-8');

if(isset($REQUEST['type']) ) {
  if($REQUEST['type'] == "menu") {
    $sql= "SELECT * FROM products";
  
    if(isset($REQUEST['id'])) {
      $sql= "SELECT * FROM products WHERE id = " . $REQUEST['id'];
    }
  
    $result = $connect->query($sql);
    $row = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode(['result' => $row]);
    exit();
  }
  if($REQUEST['type'] == "createorder") {
    [
      'address' => $address,
      'number' => $number,
      'number' => $number,
      'place' => $place,
      'name' => $name,
      'price' => $price,
      'email' => $email,
      'menu_id' => $menu_id,
    ] = $REQUEST;
    $sql= "SELECT * FROM `products` WHERE id = $menu_id";
    $result = $connect->query($sql);
    $row = $result->fetch_all(MYSQLI_ASSOC)[0];
    $foodname = $row['name'];

    $sql= "INSERT INTO `orders`(`foodname`, `email`, `name`, `address`, `number`, `place`, `price`) VALUES ('$foodname','$email','$name','$address','$number','$place','$price')";

    $result = $connect->query($sql);
    $row = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode(['result' => $row]);
    exit();
  }

  if($REQUEST['type'] == "createmenu") {
    [
      'name' => $name,
      'description' => $description,
      'category' => $category,
    ] = $REQUEST;
    
    $sql= "INSERT INTO `products`(`category`, `name`, `description`, `user_created`, `photo`) VALUES ('$category','$name','$description', '1', 'images/placeholder.jpg')";

    $result = $connect->query($sql);
    $row = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode(['result' => $row]);
    exit();
  }

  if($REQUEST['type'] == "userregister") {
    [
      'username' => $username,
      'name' => $name,
      'email' => $email,
      'address' => $address,
      'city' => $city,
      'phone' => $phone,
      'password' => $password,
      'confirmPassword' => $confirmPassword,
    ] = $REQUEST;

    if (
    !(isset($username) and
    isset($email) and
    isset($name) and
    isset($address) and
    isset($city) and
    isset($phone) and
    isset($password) and
    isset($confirmPassword))) {
      echo json_encode(['error' => 'Every field must be filled!']);
      exit();
    }

    if($password != $confirmPassword) {
      echo json_encode(['error' => 'Password does not match!']);
      exit();
    }

    $sql = "SELECT id FROM profiles WHERE email = '" . $email. "'";

    $result = $connect->query($sql);

    if($result->num_rows) {
      echo json_encode(['error' => 'Email already exists!']);
      exit();
    }

    $password = md5($password);
    $sql = "INSERT INTO profiles (username, email, password, name, address, city, contact, activation)
    VALUES ('$username', '$email', '$password', '$name', '$address', '$city', '$phone', '1')";

    $result = $connect->query($sql);
    // $row = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode([]);
    exit();
  }
}

$username = $REQUEST["uname"];
$password = $REQUEST["psw"];

$password_md5 = md5($password);

if (isset($username) and isset($password_md5)) {
  $sql = "SELECT * FROM profiles WHERE username = '$username' AND password = '$password_md5'";
  if ($result = $connect -> query($sql)) {
    $row = $result->fetch_assoc();
    if(sizeof($row)) {
      session_start();
      $_SESSION["username"] = $username;

      unset($row['password']);
      unset($row['verification']);
      unset($row['activation']);
      echo json_encode(['user' =>$row]);
    } else {
      echo json_encode([]);
    }
  }
}

?>
