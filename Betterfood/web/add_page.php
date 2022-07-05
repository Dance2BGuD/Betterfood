<?php
include 'db_config.php';
$name = $_POST["name"];
$price = $_POST["price"];
$description = $_POST["desc"];
$piece = $_POST["piece"];
$category = $_POST["category"];


$status = 0;

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["img"]["name"]);
$img_name = basename($_FILES["img"]["name"]);
echo $img_name;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["img"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

/*// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}*/

// Check file size
if ($_FILES["img"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    $temp = explode(".", $_FILES["img"]["name"]);
   $newfilename = round(microtime(true)) . '.' . end($temp);
  if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_dir . $newfilename)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["img"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
$image = $target_dir . $newfilename;



if (isset($name) and isset($price) and isset($description) and isset($image)) {
    $sql = "INSERT INTO products (category, name, price, photo, availability, description)
    VALUES ('$category', '$name', '$price', '$image', '$piece', '$description')";
    if ($connect->query($sql) === TRUE) {
        header("Location:admin.php?edit=1");
        $status = 1;
      } else if ($status == 0) {
        //header("Location:admin.php?edit=2");
        echo "Error: " . $sql . "<br>" . $connect->error;
      }
}
?>